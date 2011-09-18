<h1><?php echo $message->subject(); ?></h1>
<div class="messages">
    <div class="avatar">
        <img alt="avatar" height="32" src="https://secure.gravatar.com/avatar.php?gravatar_id=<?php echo md5($author->email);?>&amp;default=<?php echo URL_PUBLIC; ?>wolf/admin/images/user.png&amp;size=32" width="32" />
    </div>
    <div class="messages-message">
        <ul class="message-actions">
            <a href="<?php echo BASE_URL.'delete/message/'.$message->id(); ?>"><img src="<?php echo ICONS_URI; ?>delete-16.png" alt="Delete message" title="Delete message" /></a>
        </ul>
        <p class="message-meta">
            <a href="<?php echo BASE_URL.'message/'.$message->id(); ?>">message</a>
            from
            <strong><?php /* a href="/~<?php echo $message->fromUsername(); ?>" */?><?php echo $message->fromName(); ?><?php // /a ?></strong>
            to
            <strong>me</strong>
            <?php echo Message::relativeDateTime($message->sentOn()); ?>
        </p>
        <p class="message-body">
            <?php echo $message->body(); ?>
        </p>
    </div>
</div> 