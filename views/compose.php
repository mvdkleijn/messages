<h1><?php echo $title; ?></h1>
<form action="<?php echo BASE_URL.'messages/new'; ?>" class="new_message" id="new_message" method="post">
    <table>
        <tr>
            <th><label for="message_recipients"><?php echo __('Recipient');?></label></th>
            <td><input id="message_recipients" name="message[recipient]" size="30" type="text" /></td>
        </tr>
        <tr>
            <th><label for="message_subject"><?php echo __('Subject');?></label></th>
            <td><input id="message_subject" name="message[subject]" size="30" type="text" /></td>
        </tr>
        <tr>
            <th><label for="message_body">Message body</label></th>
            <td><textarea class="tall" cols="40" id="message_body" name="message[body]" rows="20"></textarea></td>
        </tr>
        <tr>
            <th></th>
            <td><input id="message_submit" name="commit" type="submit" value="Send message" /></td>
        </tr>
    </table>
</form>

<script type="text/javascript">
    // <![CDATA[
    $(document).ready(function() {
        $('#message_recipients').autocomplete({serviceUrl:'<?php echo $serviceurl; ?>'});
    });
    //]]>
</script>