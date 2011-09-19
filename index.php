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
if (!defined('IN_CMS')) {
    exit();
}

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
Plugin::setInfos(array(
            'id' => 'messages',
            'title' => __('Messages'),
            'description' => __('Provides an in-site messaging system.'),
            'version' => '0.0.3',
            'license' => 'GPLv3',
            'author' => 'Martijn van der Kleijn',
            'website' => 'http://www.wolfcms.org/',
            'update_url' => 'http://www.wolfcms.org/plugin-versions.xml',
            'require_wolf_version' => '0.7.5'
        ));

if (Plugin::isEnabled('messages')) {

    Plugin::addController('messages', __('Messages'), 'admin_view', true);

    // Load models.
    AutoLoader::addFolder(PLUGINS_ROOT . '/messages/models');

    // Setup nice routes to the message plugin.
    /*
    Dispatcher::addRoute(array(
                '/acuser' => '/plugin/messages/acUser',
                '/messages' => '/plugin/messages/inbox',
                '/messages/sent' => '/plugin/messages/sent',
                '/messages/new' => '/plugin/messages/compose',
                '/delete/message/:num' => '/plugin/messages/delete/$1',
                '/message/:num' => '/plugin/messages/message/$1'
            ));
*/
    // Setup admin routes to the message plugin. TEMP?
    Dispatcher::addRoute(array(
                '/'.ADMIN_DIR.'/messages/acuser/:any' => '/plugin/messages/ac_user/$1',
                '/'.ADMIN_DIR.'/messages' => '/plugin/messages/inbox',
                '/'.ADMIN_DIR.'/messages/sent' => '/plugin/messages/sent',
                '/'.ADMIN_DIR.'/messages/new' => '/plugin/messages/compose',
                '/'.ADMIN_DIR.'/delete/message/:num' => '/plugin/messages/delete/$1',
                '/'.ADMIN_DIR.'/message/:num' => '/plugin/messages/message/$1'
            ));
}