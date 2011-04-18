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
?>
<p class="button"><a href="<?php echo BASE_URL.'messages/new'; ?>" ><img src="<?php echo ICONS_URI; ?>add-page-32.png" align="middle" alt="<?php echo __('Compose new message'); ?>" title="<?php echo __('Compose new message'); ?>" /> <?php echo __('Compose new message'); ?></a></p>
<p class="button"><a href="<?php echo BASE_URL.'messages'; ?>" ><img src="<?php echo ICONS_URI; ?>file-folder-32.png" align="middle" alt="<?php echo __('Inbox'); ?>" title="<?php echo __('Inbox'); ?>" /> <?php echo __('Inbox'); ?></a></p>
<?php /* p class="button"><a href="<?php echo BASE_URL.'messages/sent'; ?>" ><img src="<?php echo ICONS_URI; ?>file-folder-32.png" align="middle" alt="<?php echo __('Archive'); ?>" title="<?php echo __('Archive'); ?>" /> <?php echo __('Archive'); ?></a></p */ ?>
<p class="button"><a href="<?php echo BASE_URL.'messages/sent'; ?>" ><img src="<?php echo ICONS_URI; ?>file-folder-32.png" align="middle" alt="<?php echo __('Sent messages'); ?>" title="<?php echo __('Sent messages'); ?>" /> <?php echo __('Sent messages'); ?></a></p>
