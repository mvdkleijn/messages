<form action="<?php echo BASE_URL.'messages/new';?>" class="new_message" id="new_message" method="post"><div style="margin:0;padding:0;display:inline"><input name="authenticity_token" type="hidden" value="0d+qN0nuGsZDApE4HT60k02HTNkOvgdypqbkgyUghtY=" /></div>
    <div class="messages">
        <p>
            <label for="message_recipients">
                Recipient
            </label> 
        <div>
            <input id="message_recipients" name="message[recipient]" size="30" type="text" />
        </div>
        </p>

        <p>
            <label for="message_subject">Subject</label>
        <div><input id="message_subject" name="message[subject]" size="30" type="text" /></div>
        </p>

        <p>
            <label for="message_body">Message body</label>
        <div>
            <textarea class="tall" cols="40" id="message_body" name="message[body]" rows="20"></textarea>
        </div>
        </p>
    </div>
    <br/>
    <input id="message_submit" name="commit" type="submit" value="Send message" />
</form>

<script type="text/javascript">
    // <![CDATA[
    $(document).ready(function() {
        $('#message_recipients').autocomplete({serviceUrl:'/wolfcms/?/acuser?query='});
    });
    //]]>
</script>