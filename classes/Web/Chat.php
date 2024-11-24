<?php

namespace Web;

class Chat extends \Application\Main
{
    public function __construct($cmd, $config)
    {
        parent::__construct($cmd, $config);
    }

    public function show()
    {
        $Controller = $this->GetInstance('Application\Controller');

        if (isset($_POST['logout'])) {
            session_destroy();
            $Controller->redirectPage("/Web/Auth", true);
        }

        if (!isset($_SESSION['user'])) {

            $Controller->redirectPage("/Web/Auth", true);
        }

        $this->addAsset("chat.css", "css");
        $this->addAsset("chat.js", "js");

        $DataBase = $this->GetInstance('Drivers\DataBase');
        $User = $this->GetInstance('Model\User');
        $Friendship = $this->GetInstance('Model\Friendship');
        $Message = $this->GetInstance('Model\Message');
        $Status = $this->GetInstance('Model\Status');

        $db = $DataBase->dbConnect();

        $user_id = $_SESSION['user']['id'];

        // getting contact_id from url
        if ($Controller->GetParam('friend_id') != null) {
            $contact_id = $Controller->GetParam('friend_id');
            // check if user is friends with contact
            if (!$Friendship->areFriends($user_id, $contact_id)) {
                $Controller->redirectPage("/Web/Chat", true);
            }
        } else {
            $contact_id = 0;
        }

        $messages = $Message->getMessages($user_id, $contact_id);
        $friends = $Friendship->getFriends($user_id);
        $pendingRequests = $Friendship->getFriends($user_id, 'pending');

        // update message status to read after refresh
        foreach ($messages as $message) {
            $Status->updateMessageStatus($message['message_id'], $user_id);
        }

        // loading templates
        $templates = ["header.php", "chat.php", "footer.php"];
        foreach ($templates as $template) {
            $path = $this->getTemplatePath($template);
            if ($path) {
                include $path;
            }
        }
    }
}
