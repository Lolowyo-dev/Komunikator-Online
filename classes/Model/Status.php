<?php

namespace Model;

use PDO;

class Status
{
    private $conn;
    private $table = 'message_status';

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function createStatus($message_id, $user_id, $status = 'unread')
    {
        $query = "INSERT INTO {$this->table} (message_id, user_id, status) VALUES (:message_id, :user_id, :status)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':message_id', $message_id, PDO::PARAM_INT);
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->bindParam(':status', $status, PDO::PARAM_STR);

        return $stmt->execute();
    }


    public function updateStatus($message_id, $user_id, $status)
    {
        $query = "UPDATE {$this->table} SET status = :status WHERE message_id = :message_id AND user_id = :user_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':status', $status);
        $stmt->bindParam(':message_id', $message_id);
        $stmt->bindParam(':user_id', $user_id);

        return $stmt->execute();
    }

    public function getStatus($message_id, $user_id)
    {
        $query = "SELECT status FROM {$this->table} WHERE message_id = :message_id AND user_id = :user_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':message_id', $message_id);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updateMessageStatus($message_id, $user_id)
    {
        $currentStatus = $this->getStatus($message_id, $user_id);

        if ($currentStatus && $currentStatus['status'] == 'unread') {
            return $this->updateStatus($message_id, $user_id, 'read');
        }

        return false;
    }
}
