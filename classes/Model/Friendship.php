<?php

namespace Model;

class Friendship
{
    private $conn;
    private $table = 'friendships';

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function sendRequest($user1_id, $user2_id)
    {
        $query = "INSERT INTO {$this->table} (user1_id, user2_id, status) VALUES (:user1_id, :user2_id, 'pending')";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':user1_id', $user1_id);
        $stmt->bindParam(':user2_id', $user2_id);

        return $stmt->execute();
    }

    public function updateRequest($user1_id, $user2_id, $status)
    {
        $query = "UPDATE {$this->table} SET status = :status WHERE (user1_id = :u1_id AND user2_id = :u2_id) OR (user1_id = :u2_id AND user2_id = :u1_id)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':status', $status);
        $stmt->bindParam(':u1_id', $user1_id);
        $stmt->bindParam(':u2_id', $user2_id);

        return $stmt->execute();
    }

    public function getFriends($user_id, $status = 'accepted')
    {
        $query = "SELECT users.id, users.username 
                FROM friendships 
                JOIN users ON (users.id = friendships.user1_id OR users.id = friendships.user2_id)
                WHERE (friendships.user1_id = :user_id OR friendships.user2_id = :user_id)
                  AND friendships.status = :status
                  AND users.id != :user_id";

        if ($status == 'pending') {
            $query = "SELECT users.id, users.username 
                FROM friendships 
                JOIN users ON (users.id = friendships.user1_id OR users.id = friendships.user2_id)
                WHERE (friendships.user2_id = :user_id)
                  AND (friendships.status = :status)
                  AND users.id != :user_id";
        }

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->bindParam(':status', $status);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function areFriends($user1_id, $user2_id)
    {
        $query = "SELECT * FROM {$this->table} WHERE status='accepted' AND ((user1_id = :user1_id AND user2_id = :user2_id) OR (user1_id = :user2_id AND user2_id = :user1_id))";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':user1_id', $user1_id);
        $stmt->bindParam(':user2_id', $user2_id);
        $stmt->execute();

        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public function searchAvailableFriends($user_id, $searchTerm)
    {
        $searchTerm = '%' . $searchTerm . '%';
        $query = "
            SELECT users.id, users.username 
            FROM users
            LEFT JOIN friendships f1 ON (f1.user1_id = users.id AND f1.user2_id = :user_id)
            LEFT JOIN friendships f2 ON (f2.user2_id = users.id AND f2.user1_id = :user_id)
            WHERE users.username LIKE :searchTerm
            AND users.id != :user_id
            AND (f1.status IS NULL AND f2.status IS NULL)
        ";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->bindParam(':searchTerm', $searchTerm);
        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
}
