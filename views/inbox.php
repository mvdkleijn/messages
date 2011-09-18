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
?>

<h1><?php echo $title; ?></h1>

    <table class="index" cellpadding="0" cellspacing="0" border="0">
        <thead>
            <tr>
                <th></th>
                <th>Who</th>
                <th>What</th>
                <th>When</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!count($messages) > 0) { ?>
            <tr>
                <td colspan="4"><?php echo __('No messages were found.');?></td>
            </tr>
            <?php } ?>
            <?php foreach ($messages as $message) { ?>
            <tr>
                <td>
                    <?php /* input type="checkbox" name="message_ids[]" value="<?php echo $message->id(); ?>" / */ ?>
                </td>
                <td>
                    <?php if (AuthUser::getId() == $message->fromId()) { ?>
                    <?php echo __('Me');?>,
                    <?php } else { ?>
                    <?php /* a href="/~<?php echo $message->fromUsername(); ?>"><?php echo $message->fromName(); ?></a>, */?>
                    <?php echo $message->fromName(); ?>,
                    <?php } ?>
                    <?php if (AuthUser::getId() == $message->toId()) { ?>
                    <?php echo __('Me');?>
                    <?php } else { ?>
                    <?php /*a href="/~<?php echo $message->toUsername(); ?>"><?php echo $message->toName(); ?></a>*/?>
                    <?php echo $message->toName(); ?>
                    <?php } ?>
                </td>
                <td>
                    <a href="<?php echo BASE_URL.'message/'.$message->id(); ?>"><?php echo $message->subject(); ?></a> - 
                    <span>
                        <?php echo $message->extract(); ?>
                    </span>
                </td>
                <td>
                    <?php echo Message::relativeDateTime($message->sentOn()); ?>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
<?php /*    
    <div>
        <p>Select 
            <a href="#">All Messages</a>, 
            <a href="#">All unread messages</a>
        </p>
        <select name="requested_action">
            <!--option value="read">Read</option>
            <option value="unread">Unread</option-->
            <!--option value="archive">Archive</option-->
            <option value="delete">Delete</option>
            <!--option value="draft">Draft</option-->
        </select>
        <input type="submit" value="Apply to selected messages" />
    </div>
</form>
 * 
 */ ?>