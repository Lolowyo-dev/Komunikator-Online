<?php

namespace Model;

use PDO;

class Message
{
    private $conn;
    private $table = 'messages';

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function sendMessage($sender_id, $receiver_id, $content)
    {
        $query = "INSERT INTO {$this->table} (sender_id, receiver_id, message_content) VALUES (:sender_id, :receiver_id, :content)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':sender_id', $sender_id);
        $stmt->bindParam(':receiver_id', $receiver_id);
        $stmt->bindParam(':content', $content);

        return $stmt->execute();
    }

    public function getMessages($user_id, $contact_id)
    {
        $query = "
            SELECT 
                m.id AS message_id, 
                m.sender_id, 
                m.receiver_id, 
                m.message_content, 
                ms.status AS message_status,
                m.sent_at
            FROM {$this->table} m
            LEFT JOIN message_status ms ON m.id = ms.message_id 
            WHERE (m.sender_id = :user_id AND m.receiver_id = :contact_id) 
               OR (m.sender_id = :contact_id AND m.receiver_id = :user_id)
            ORDER BY m.sent_at ASC
        ";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->bindParam(':contact_id', $contact_id);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getLastMessageId($user_id, $contact_id)
    {
        $query = "
            SELECT id 
            FROM {$this->table} 
            WHERE (sender_id = :user_id AND receiver_id = :contact_id)
               OR (sender_id = :contact_id AND receiver_id = :user_id)
            ORDER BY sent_at DESC 
            LIMIT 1
        ";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->bindParam(':contact_id', $contact_id);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['id'];
    }
}
