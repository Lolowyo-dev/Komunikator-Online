<?php
if (isset($_POST['message'])) {
    if ($contact_id <= 0)
        error_log("No contact selected error");
    else {
        $message = $_POST['message'];
        $user_id = $_SESSION['user']['id'];

        $Message->sendMessage($user_id, $contact_id, $message);
        $Status->createStatus($Message->getLastMessageId($user_id, $contact_id), $contact_id);
?>
        <script>
            reloadPageFor(<?php echo $user_id; ?>);
            reloadPageFor(<?php echo $contact_id; ?>);
        </script>
<?php
    }
}
?>

<div class="chat-container">
    <form class="message-form" id="message-form" method="post">
        <div class="message-input-container">
            <textarea id="messageInput" name="message" placeholder="Type message..." rows="1" required></textarea>
            <button type="submit" id="sendButton" name="send_message">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                    <path fill="currentColor" d="M3 21v-7l15-2-15-2v-7l21 9z" />
                </svg>
            </button>
        </div>
    </form>
</div>