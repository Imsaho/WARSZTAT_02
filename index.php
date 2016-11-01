<?php

include_once 'SRC/User.php';
include_once 'SRC/Tweet.php';
include_once 'SRC/db_config_inc.php';



/*$user = new User();

$user->setUsername("Andrzej");
$user->setHashedPassword("coderslab");
$user->setEmail("andrzej@gmail.com");
 * 
 */

$conn = getDbConnection();
$id =1;

// $user = User::loadUserById($conn, $id);

$users = User::loadAllUsers($conn);
var_dump($users);

$email = "adam.nowy@gmail.com";

$user = User::loadUserById($conn, 1);
$user->setEmail($email);
var_dump($user);

if ($user->saveToDB($conn)) {
    echo "user updated";
    var_dump($user);
} else {
    echo "user not updated" . $conn->error;
}

/* if (is_null($user)) {
    echo "User with id $id does not exist!";
    die;
}
 * 
 */

/*
if ($user->saveToDB($conn)) {
    // var_dump($user);
    echo "Użytkownik został dodany";
} else {
    echo "Błąd. Nie dodano użytkownika";
}
 * 
 */

$tweet = Tweet::loadTweetById($conn, 1);
var_dump($tweet);

$user6 = User::loadUserById($conn, 6);
$user6Tweets = Tweet::loadAllTweetsByUserId($conn, 6);
var_dump($user6Tweets);

var_dump(Tweet::loadAllTweets($conn));
$user9Tweets = Tweet::loadAllTweetsByUserId($conn, 9);
        
$currentDate = date('Y-m-d H:i:s');
echo $currentDate;

$newMessage = "Kolejny tweet dla użytkownika nr 9";
var_dump ($user9Tweets);
$newTweet = new Tweet();
var_dump($newTweet);
$newTweet->setText($newMessage);
$newTweet->setUserId(9);
//$newTweet->saveToDB($conn);

var_dump ($user9Tweets);


$conn->close();
$conn = null;


?>