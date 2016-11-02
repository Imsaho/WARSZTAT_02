<?php

/*
 * CREATE TABLE Tweets(
	id int AUTO_INCREMENT,
    user_id int,
    text text(140) NOT NULL,
    creation_date datetime NOT NULL,
    PRIMARY KEY(id),
    FOREIGN KEY(user_id) REFERENCES Users(id)
)
 */

class Tweet {
    private $id;
    private $userId;
    private $text;
    private $creationDate;
    
    public function __construct() {
        $this->id = -1;
        $this->userId = null;
        $this->text = "";
        $this->creationDate = null;
    }
    
    public function setUserId($userId) {
        $this->userId = $userId;
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

    public function getText() {
        return $this->text;
    }

    public function getCreationDate() {
        return $this->creationDate;
    }
    
    static public function loadTweetById(mysqli $connection, $id) {
        $sql = "SELECT * FROM Tweets WHERE id = $id";
        $result = $connection->query($sql);
        
        if ($result != FALSE && $result->num_rows == 1) {
            $row = $result->fetch_assoc();
            
            $loadedTweet = new Tweet();
            $loadedTweet->id = $row['id'];
            $loadedTweet->userId = $row['user_id'];
            $loadedTweet->text = $row['text'];
            $loadedTweet->creationDate = $row['creation_date'];
            
            return $loadedTweet;
        }
        return null;
    }
    
    static public function loadAllTweetsByUserId(mysqli $connection, $userId) {
        $sql = "SELECT * FROM Tweets
                                              WHERE user_id = $userId ORDER BY creation_date DESC";
        $result = $connection->query($sql);
        $ret = [];
        
        if ($result != FALSE && $result->num_rows != 0) {
            foreach ($result as $row) {
                $loadedTweet = new Tweet();
                $loadedTweet->id = $row['id'];
                $loadedTweet->userId = $row['user_id'];
                $loadedTweet->text = $row['text'];
                $loadedTweet->creationDate = $row['creation_date'];
                
                $ret[$loadedTweet->id] = $loadedTweet;
            }
        }
        return $ret;
    }
    
    static public function loadAllTweets(mysqli $connection) {
        $sql = "SELECT * FROM Tweets ORDER BY creation_date DESC";
        $result = $connection->query($sql);
        $ret = [];
        
        if ($result != FALSE && $result->num_rows != 0) {
            foreach ($result as $row) {
                $loadedTweet = new Tweet();
                $loadedTweet->id = $row['id'];
                $loadedTweet->userId = $row['user_id'];
                $loadedTweet->text = $row['text'];
                $loadedTweet->creationDate = $row['creation_date'];
                
                $ret[$loadedTweet->id] = $loadedTweet;
            }
        }
        return $ret;
    }
    
    public function saveToDB(mysqli $connection) {
        if ($this->id == -1) {
            $currentDate = date('Y-m-d H:i:s');
            $this->creationDate = $currentDate;
            $statement = $connection->prepare("INSERT INTO Tweets (user_id, text, creation_date) VALUES (?, ?, ?)");
            if (!$statement) {
                return false;
            }
            $statement->bind_param('sss', $this->userId, $this->text, $this->creationDate);
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