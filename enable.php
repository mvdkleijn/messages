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
/*
 * Any code below gets executed each time the plugin is enabled.
 */

$PDO = Record::getConnection();
$driver = strtolower($PDO->getAttribute(Record::ATTR_DRIVER_NAME));

// Setup table structure
if ($driver == 'mysql') {
    $PDO->exec("CREATE TABLE IF NOT EXISTS ".TABLE_PREFIX."message (
        id int(11) unsigned NOT NULL auto_increment,
        from_id int(11) unsigned NOT NULL default '0',
        from_name varchar(100) default NULL,
        from_username varchar(40) NOT NULL,
        to_id int(11) unsigned NOT NULL default '0',
	    to_name varchar(100) default NULL,
        to_username varchar(40) NOT NULL,
        body text default '',
        subject text default '',
	    read_by_to tinyint(1) unsigned NOT NULL default '0',
        read_by_from tinyint(1) unsigned NOT NULL default '0',
        archived_by_to tinyint(1) unsigned NOT NULL default '0',
        archived_by_from tinyint(1) unsigned NOT NULL default '0',
        is_draft tinyint(1) unsigned NOT NULL default '1',
	    created_on datetime default NULL,
        updated_on datetime default NULL,
        sent_on datetime default NULL,
        created_by int(11) unsigned NOT NULL default '0',
        updated_by int(11) unsigned NOT NULL default '0',
	    PRIMARY KEY  (id),
	    KEY created_on (created_on)
	  ) ENGINE=MyISAM  DEFAULT CHARSET=utf8");

    /*
    $PDO->exec("INSERT INTO ".TABLE_PREFIX."message 
            (id, from_id, from_name, from_username, to_id, to_name, to_username, body,
            subject, is_draft, created_on, created_by, sent_on)
            VALUES (1, 1, 'Administrator', 'admin', 1, 'Administrator', 'admin',
            'This is just a simple test message... please disregard.', 'Test message', 0,
            '2011-02-01 20:00:00', 1, '2011-02-01 20:00:00');");

    $PDO->exec("INSERT INTO ".TABLE_PREFIX."message 
            (id, from_id, from_name, from_username, to_id, to_name, to_username, body,
            subject, is_draft, created_on, created_by, sent_on)
            VALUES (2, 2, 'Test user', 'test', 1, 'Administrator', 'admin',
            'Another simple test message... please disregard again.', 'Another test message', 0,
            '2011-04-02 20:00:00', 1, '2011-04-02 20:00:00');");

    $PDO->exec("INSERT INTO ".TABLE_PREFIX."message 
            (id, from_id, from_name, from_username, to_id, to_name, to_username, body,
            subject, is_draft, created_on, created_by, sent_on)
            VALUES (3, 2, 'Test user', 'test', 2, 'Test user', 'test',
            'Another simple test message... please disregard again.', 'Another test message', 0,
            '2011-04-02 20:00:00', 1, '2011-04-02 20:00:00');");
     * 
     */
}
else if ($driver == 'sqlite') {
    
}
