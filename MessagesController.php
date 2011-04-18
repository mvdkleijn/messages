<?php
/*
 * Messages plugin - for Wolf CMS. <http://www.wolfcms.org>
 * Copyright (C) 2011 Martijn van der Kleijn <martijn.niji@gmail.com>
 *
 * This file is part of the Messages plugin for Wolf CMS. It is licensed under
 * the terms of the GNU GPLv3 license.
 * Please see license.txt for the full license text.
 */

/* Security measure */
if (!defined('IN_CMS')) { exit(); }

/**
 * The messages plugin allows you to provide an in-cms messaging system.
 *
 * @package Plugins
 * @subpackage messages
 *
 * @author Martijn van der Kleijn <martijn.niji@gmail.com>
 * @copyright Martijn van der Kleijn, 2011
 * @license http://www.gnu.org/licenses/gpl.html GPLv3 license
 */

/**
 * Use this SkeletonController and this skeleton plugin as the basis for your
 * new plugins if you want.
 */
class MessagesController extends PluginController {

    public function __construct() {
        AuthUser::load();
        
        $this->setLayout('backend');
        $this->assignToLayout('sidebar', new View('../../plugins/messages/views/sidebar'));
    }

    public function index() {
        $this->inbox();
    }
    
    public function inbox() {
        $messages = array();
        
        $where = 'to_id=? ORDER BY sent_on DESC';
        $messages = Message::findAllFrom('Message', $where, array(AuthUser::getId()));
        
        $this->display('messages/views/inbox', array('messages' => $messages));
    }
    
    public function sent() {
        $messages = array();
        
        $where = 'from_id=? ORDER BY sent_on DESC';
        $messages = Message::findAllFrom('Message', $where, array(AuthUser::getId()));
        
        $this->display('messages/views/inbox', array('messages' => $messages));
    }

    public function message($id) {
        $message = Message::findByIdFrom('Message', $id);
        
        if ($message !== false) {
            if ($message->toId() != AuthUser::getId() && $message->fromId() != AuthUser::getId()) {
                $message = __('That is not your message to view.');
            
                $this->display('messages/views/error', array('message' => $message));                
            }
            else {
                $author = User::findById($message->fromId());
                
                $this->display('messages/views/message', array('message' => $message,
                    'author' => $author
                    ));
            }
        }
        else {
            $message = __('We are unable to find that message.');
            
            $this->display('messages/views/error', array('message' => $message));
        }
    }
    
    public function compose() {
        if (isset($_POST['message'])) {
            $data = $_POST['message'];
            $msg = new Message();

            $to = User::findBy('username', html_encode($data['recipient']));
            if ($to === false) {
                $this->display('messages/views/error', array('message' => 'Unable to find the user you requested.'));
            }
            
            $msg->to_id = $to->id;
            $msg->to_username = $to->username;
            $msg->to_name = $to->name;
            
            $msg->from_id = AuthUser::getId();
            $msg->from_username = AuthUser::getUserName();
            $msg->from_name = AuthUser::getRecord()->name;
            
            $msg->subject = html_encode($data['subject']);
            $msg->body = html_encode($data['body']);
            
            $msg->save();
            
            $this->display('messages/views/error', array('message' => 'The message was delivered.'));
        }
        else {
            $this->display('messages/views/compose');
        }
    }
    
    public function delete($id) {
        $msg = Message::findByIdFrom('Message', $id);
        
        if ($id === false) {
            $this->display('messages/views/error', array('message' => 'The message could not be found.'));
        }
        
        if ($msg->fromId() == AuthUser::getId() || $msg->toId() == AuthUser::getId()) {
            $msg->delete();
            $this->inbox();
        }
        else {
            $this->inbox();
        }
    }
    
    public function acUser() {
        if (!AuthUser::isLoggedIn()) {
            // Lets return an empty array for non-logged in users to prevent snooping.
            echo json_encode(array());
        }
        
        $username = $_GET['query'];
        
        $found = Record::findAllFrom('User', "username LIKE '%".html_encode($username)."%'");
        $options = array();
        
        foreach ($found as $user) {
            $options[] = $user->username;
        }
        
        $ret = array('query' => html_encode($username),
                     'suggestions' => $options
                    );
        
        echo json_encode($ret);
    }

    public function documentation() {
        $this->display('messages/views/documentation');
    }

    function settings() {
        /** You can do this...
        $tmp = Plugin::getAllSettings('messages');
        $settings = array('my_setting1' => $tmp['setting1'],
                          'setting2' => $tmp['setting2'],
                          'a_setting3' => $tmp['setting3']
                         );
        $this->display('messages/views/settings', $settings);
         *
         * Or even this...
         */

        $this->display('messages/views/settings', Plugin::getAllSettings('messages'));
    }
}