<?php
// generate messages from database
foreach ($messages as $message) {
    $message_id = $message['message_id'];
    $isSent = ($message['sender_id'] == $user_id);
    $contact = ($isSent) ? $User->findById($message['receiver_id']) : $User->findById($message['sender_id']);
    $status = $message['message_status'] ? $message['message_status'] : 'unread';
    $timestamp = date('H:i', strtotime($message['sent_at']));
?>
    <div class="flex <?php echo $isSent ? 'justify-end' : 'justify-start'; ?> mb-4">
        <?php if (!$isSent) { ?>
            <img class="profile-picture mr-2 mb-auto" src="<?= $this->getUrl("templates/default/gfx/profile.png"); ?>"
                alt="<?php echo htmlspecialchars($contact['username']); ?>">
        <?php } ?>
        <div class="flex flex-col <?php echo $isSent ? 'items-end' : 'items-start'; ?> max-w-lg m-1">
            <div class="message <?php echo $isSent ? 'sent' : 'received'; ?>">
                <div class="message-content">
                    <?php echo htmlspecialchars($message['message_content']); ?>
                </div>
            </div>
            <div class="message-meta max-w">
                <span><?php echo $timestamp; ?></span>
                <?php if ($isSent) { ?>
                    <span class="ml-2"><?php echo ucfirst($status); ?></span>
                <?php } ?>
            </div>
        </div>
    </div>
<?php
}

// include message input component
if ($contact_id != 0)
    include("templates/default/components/message-input.php");
?>