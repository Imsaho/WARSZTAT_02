<?php

/*
 * CREATE TABLE Comments (
                id int AUTO_INCREMENT,
                user_id int,
                tweet_id int,
                text text(60) NOT NULL,
                creation_date datetime,
                PRIMARY KEY(id),
                FOREIGN KEY(user_id) REFERENCES Users(id),
                FOREIGN KEY(tweet_id) REFERENCES Tweets(id)
	)
 */

class Comment {
    private $id;
    private $userId;
    private $tweetId;
    private $text;
    private $creationDate;
    
    public function __construct() {
        $this->id = -1;
        $this->userId = null;
        $this->tweetId = null;
        $this->text = "";
        $this->creationDate = null;
    }
    
    public function setUserId($userId) {
        $this->userId = $userId;
        return $this;
    }

    public function setTweetId($tweetId) {
        $this->tweetId = $tweetId;
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

    public function getId() {
        return $this->id;
    }

    public function getUserId() {
        return $this->userId;
    }

    public function getTweetId() {
        return $this->tweetId;
    }

    public function getText() {
        return $this->text;
    }

    public function getCreationDate() {
        return $this->creationDate;
    }
    
    static public function loadCommentById(mysqli $connection, $id) {
        $sql = "SELECT * FROM Comments WHERE id = $id";
        $result = $connection->query($sql);
        
        if ($result != FALSE && $result->num_rows == 1) {
            $row = $result->fetch_assoc();
            
            $loadedComment = new Comment();
            $loadedComment->id = $row['id'];
            $loadedComment->userId = $row['user_id'];
            $loadedComment->tweetId = $row['tweet_id'];
            $loadedComment->text = $row['text'];
            $loadedComment->creationDate = $row['creation_date'];
            
            return $loadedComment;
        }
        return null;
    }
    
    static public function loadAllCommentsByTweetId(mysqli $connection, $tweetId) {
        $sql = "SELECT * FROM Comments
                                            WHERE tweet_id = $tweetId ORDER BY creation_date DESC";
        $result = $connection->query($sql);
        $ret = [];
        
        if ($result != FALSE && $result->num_rows != 0) {
            foreach ($result as $row) {
                $loadedComment = new Comment();
                $loadedComment->id = $row['id'];
                $loadedComment->userId = $row['user_id'];
                $loadedComment->tweetId = $row['tweet_id'];
                $loadedComment->text = $row['text'];
                $loadedComment->creationDate = $row['creation_date'];
                
                $ret[$loadedComment->id] = $loadedComment;
            }
        }
        return $ret;
    }
    
    public function saveToDB(mysqli $connection) {
        if ($this->id == -1) {
            $currentDate = date('Y-m-d H:i:s');
            $this->creationDate = $currentDate;
            $statement = $connection->prepare("INSERT INTO Comments (user_id, tweet_id, text, creation_date) VALUES (?, ?, ?, ?)");
            if (!$statement) {
                return false;
            }
            $statement->bind_param('ssss', $this->userId, $this->tweetId, $this->text, $this->creationDate);
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