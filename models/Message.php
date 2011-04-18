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
class Message extends Record {
    const TABLE_NAME = 'message';

    public $id;
    public $from_id;
    public $from_name;
    public $from_username;
    public $to_id;
    public $to_name;
    public $to_username;
    public $body;
    public $subject;
    public $read_by_to;
    public $read_by_from;
    public $archived_by_to;
    public $archived_by_from;
    public $is_draft;
    public $created_on;
    public $updated_on;
    public $sent_on;
    public $created_by_id;
    public $updated_by_id;
    
    public function beforeInsert() {
        $this->created_on = date('Y-m-d H:i:s');
        $this->sent_on = date('Y-m-d H:i:s');
        
        return true;
    }

    public function extract() {
        return substr($this->body, 0, 25) . '...';
    }

    public static function relativeDateTime($datetime) {
        $today = strtotime(date('Y-m-d H:i:s'));
        $time = strtotime($datetime);

        $relminutes = ($time - $today) / 60;
        $relhours = ($time - $today) / 3600;
        $reldays = ($time - $today) / 86400;
        $relmonths = ($time - $today) / (86400 * 30);
        
        if ($relminutes < 0 && $relminutes > -10) {
            if ($relminutes > -2) {
                return __('A moment ago');
            } else if ($relminutes <= 2) {
                return __('Several minutes ago');
            }
        }
        
        if ($relhours < 0 && $relhours > -1) {
            return __('About an hour ago.');
        }
        
        if ($relhours < 0 && $relhours > -5) {
            return __('A few hours ago.');
        }

        if ($reldays >= 0 && $reldays < 1) {
            return __('Today');
        } else if ($reldays >= 1 && $reldays < 2) {
            return __('Tomorrow');
        } else if ($reldays >= -1 && $reldays < 0) {
            return __('Yesterday');
        }

        if (abs($reldays) < 7) {
            if ($reldays > 0) {
                $reldays = floor($reldays);
                return 'In ' . $reldays . ' day' . ($reldays != 1 ? 's' : '');
            } else {
                $reldays = floor(abs($reldays));
                return $reldays . ' day' . ($reldays != 1 ? 's' : '') . ' ago';
            }
        }
        
        if (abs($reldays) > 30 && abs($relmonths) < 7) {
            if ($relmonths > 0) {
                $relmonths = floor($relmonths);
                return 'In ' . $relmonths . ' month' . ($relmonths != 1 ? 's' : '');
            } else {
                $relmonths = floor(abs($relmonths));
                $rel = $relmonths . ' month' . ($relmonths != 1 ? 's' : '') . ' ago';
                if ($reldays < -30) {
                    $reldays = floor(abs($reldays+($relmonths * 30)));
                    $rel .= ', ' . $reldays . ' day' . ($reldays != 1 ? 's' : '') . ' ago';
                }
                return $rel;
            }
        }

        if (abs($reldays) < 182) {
            return date('l, j F', $time ? $time : time());
        } else {
            return date('l, j F, Y', $time ? $time : time());
        }
    }

    // VARIABLE ACCESS FUNCTIONS
    public function id() {
        return $this->id;
    }

    public function fromId() {
        return $this->from_id;
    }

    public function fromName() {
        return $this->from_name;
    }

    public function fromUsername() {
        return $this->from_username;
    }

    public function toId() {
        return $this->to_id;
    }

    public function toName() {
        return $this->to_name;
    }

    public function toUsername() {
        return $this->to_username;
    }

    public function body() {
        return $this->body;
    }

    public function subject() {
        return $this->subject;
    }

    public function readByTo() {
        return (boolean) $this->read_by_to;
    }

    public function readByFrom() {
        return (boolean) $this->read_by_from;
    }

    public function archivedByTo() {
        return (boolean) $this->archived_by_to;
    }

    public function archivedByFrom() {
        return (boolean) $this->archived_by_from;
    }

    /**
     * Returns true if the message is a draft.
     *
     * @return boolean True if draft, otherwise false.
     */
    public function isDraft() {
        return (boolean) $this->is_draft;
    }

    public function createdOn() {
        
    }

    public function createdById() {
        
    }

    public function updatedOn() {
        
    }

    public function updatedById() {
        
    }
    
    public function sentOn() {
        return $this->sent_on;
    }
}