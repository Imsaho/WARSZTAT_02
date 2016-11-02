<?php

class Message {
    private $id;
    private $senderId;
    private $receiverId;
    private $text;
    private $creationDate;
    private $isRead;
    
    public function __construct() {
        $this->id = -1;
        $this->senderId = null;
        $this->receiverId = null;
        $this->text = "";
        $this->creationDate = null;
        $this->isRead = null;
    }
    
    public function setSenderId($senderId) {
        $this->senderId = $senderId;
        return $this;
    }

    public function setReceiverId($receiverId) {
        $this->receiverId = $receiverId;
        return $this;
    }

    public function setText($text) {
        $this->text = $text;
        return $this;
    }

//    public function setCreationDate($creationDate) {
//        $this->creationDate = $creationDate;
//        return $this;
//    }

    public function setIsRead($isRead) {
        $this->isRead = $isRead;
        return $this;
    }

    public function getId() {
        return $this->id;
    }

    public function getSenderId() {
        return $this->senderId;
    }

    public function getReceiverId() {
        return $this->receiverId;
    }

    public function getText() {
        return $this->text;
    }

    public function getCreationDate() {
        return $this->creationDate;
    }

    public function getIsRead() {
        return $this->isRead;
    }
    
    static public function loadMessageById(mysqli $connection, $id) {
        $sql = "SELECT * FROM Messages WHERE id = $id";
        $result = $connection->query($sql);
        
        if ($result != FALSE && $result->num_rows == 1) {
            $row = $result->fetch_assoc();
            
            $loadedMessage = new Message();
            $loadedMessage->id = $row['id'];
            $loadedMessage->senderId = $row['sender_id'];
            $loadedMessage->receiverId = $row['receiver_id'];
            $loadedMessage->text = $row['text'];
            $loadedMessage->creationDate = $row['creation_date'];
            $loadedMessage->isRead = $row['is_read'];
            
            return $loadedMessage;
        }
        return null;
    }
    
    static public function loadMessagesBySenderId(mysqli $connection, $senderId) {
        $sql = "SELECT * FROM Messages
                                            WHERE sender_id = $senderId ORDER BY creation_date DESC";
        $result = $connection->query($sql);
        $ret = [];
        
        if ($result != FALSE && $result->num_rows != 0) {
            foreach ($result as $row) {
                $sentMessage = new Message();
                $sentMessage->id = $row['id'];
                $sentMessage->senderId = $row['sender_id'];
                $sentMessage->receiverId = $row['receiver_id'];
                $sentMessage->text = $row['text'];
                $sentMessage->creationDate = $row['creation_date'];
                $sentMessage->isRead = $row['is_read'];
                
                $ret[$sentMessage->id] = $sentMessage;
            }
        }
        return $ret;
    }
    
    static public function loadMessagesByReceiverId(mysqli $connection, $receiverId) {
        $sql = "SELECT * FROM Messages
                                            WHERE receiver_id = $receiverId ORDER BY creation_date DESC";
        $result = $connection->query($sql);
        $ret = [];
        
        if ($result != FALSE && $result->num_rows != 0) {
            foreach ($result as $row) {
                $receivedMessage = new Message();
                $receivedMessage->id = $row['id'];
                $receivedMessage->senderId = $row['sender_id'];
                $receivedMessage->receiverId = $row['receiver_id'];
                $receivedMessage->text = $row['text'];
                $receivedMessage->creationDate = $row['creation_date'];
                $receivedMessage->isRead = $row['is_read'];
                
                $ret[$receivedMessage->id] = $receivedMessage;
            }
        }
        return $ret;
    }
    
    public function saveToDB(mysqli $connection) {
        if ($this->id == -1) {
            $currentDate = date('Y-m-d H:i:s');
            $this->creationDate = $currentDate;
            $statement = $connection->prepare("INSERT INTO Messages (sender_id, receiver_id, text, creation_date, is_read) VALUES (?, ?, ?, ?, ?)");
            if (!$statement) {
                return false;
            }
            $statement->bind_param('sssss', $this->senderId, $this->receiverId, $this->text, $this->creationDate, $this->isRead);
            if ($statement->execute()) {
                $this->id = $statement->insert_id;
                return true;
            } else {
                echo "Problem z zapytaniem: " . $statement->error;
            }
            return false;
        }
    }


}

?>