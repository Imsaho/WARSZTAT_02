<?php

// host: localhost
// password  AQ76riT94TGwVm0o
// user: twitter
// baza: 

/*
 * CREATE TABLE users(
    id int AUTO_INCREMENT,
    username varchar(255) NOT NULL,
    hashedPassword varchar(60) NOT NULL,
    email varchar(255) UNIQUE NOT NULL,
    PRIMARY KEY(id)
   )
 */

class User {
    private $id;
    private $username;
    private $hashedPassword;
    private $email;
    
    public function __construct() {
        $this->id = -1;
        $this->username = "";
        $this->hashedPassword = "";
        $this->email = "";
    }
    
    public function setUsername($username) {
        $this->username = $username;
        return $this;
    }

    public function setHashedPassword($hashedPassword) {
        $newHashedPassword = password_hash($hashedPassword, PASSWORD_BCRYPT);
        $this->hashedPassword = $newHashedPassword;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function getId() {
        return $this->id;
    }

    public function getUsername() {
        return $this->username;
    }

    public function getEmail() {
        return $this->email;
    }
    
    public function saveToDB(mysqli $connection) {
        if ($this->id == -1) {
            //  prepare statement - SQL injection ! ! !
            $statement = $connection->prepare("INSERT INTO Users(username, hashed_password, email) VALUES (?, ?, ?)");
            if (!$statement) {
                return false;
            }
            $statement->bind_param('sss', $this->username, $this->hashedPassword, $this->email);
            if ($statement->execute()) {
                $this->id = $statement->insert_id;
                return true;
            } else {
                echo "Problem z zapytaniem: " . $statement.error;
            }
            return false;
        } else {
            $sql = "UPDATE Users SET username = '$this->username',
                                                                                               hashed_password = '$this->hashedPassword',
                                                                                               email = '$this->email'
                                                                                               WHERE id = $this->id";
            $result = $connection->query($sql);
            if ($result) {
                return TRUE;
            }
            return FALSE;
        }
    }
    
    static public function loadUserById(mysqli $connection, $id) {
        $sql = "SELECT * FROM Users WHERE id = $id";
        $result = $connection->query($sql);
        
        if ($result != FALSE && $result->num_rows == 1) {
            $row = $result->fetch_assoc();
            
            $loadedUser = new User();
            $loadedUser->id = $row['id'];
            $loadedUser->setEmail($row['email']);
            $loadedUser->hashedPassword = $row['hashed_password'];
            $loadedUser->username = $row['username'];
            
            return $loadedUser;
        }
        return null;
    }
    
    static public function loadAllUsers(mysqli $connection) {
        $sql = "SELECT * FROM Users";
        $result = $connection->query($sql);
        $ret = [];
        
        if ($result != FALSE && $result->num_rows != 0) {
            foreach ($result as $row) {
                 $loadedUser = new User();
                 $loadedUser->id = $row['id'];
                 $loadedUser->setEmail($row['email']);
                 $loadedUser->hashedPassword = $row['hashed_password'];
                 $loadedUser->username = $row['username'];
                 
                 $ret[$loadedUser->id] = $loadedUser;
            }
        }
        return $ret;
    }
    
    public function delete(mysqli $connection) {
        if ($this->id == -1) {
            return true;
        }
        
        $sql = "DELETE FROM Users WHERE id = $this->id";
        $result = $conn->query($sql);
        if ($result) {
            $this->id = -1;
            return true;
        }
        return false;
    }

}

?>
