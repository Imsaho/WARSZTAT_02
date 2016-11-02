<?php
session_start();

include_once 'SRC/User.php';
include_once 'SRC/Tweet.php';
include_once 'SRC/db_config_inc.php';

$conn = getDbConnection();

if (isset($_SESSION['logged_in']) 
    && $_SESSION['logged_in'] == true
    && isset($_SESSION['user_id'])) {
    $userId = $_SESSION['user_id'];
} else {
    echo "<br><a href='02_loginPage.php'>Zaloguj się</a>";
    exit;
}

$allTweets = Tweet::loadAllTweets($conn);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['tweet_text']) && $_POST['tweet_text'] != "") {
        $tweetText = $_POST['tweet_text'];
        $newTweet = new Tweet();
        $newTweet->setText($tweetText);
        $newTweet->setUserId($userId);
        $newTweet->saveToDB($conn);
    } else {
        echo "Wpisz treść!";
    }
}

?>

<html>
    <head>
        
    </head>
    <body>
    <div>
        <form action="" method="POST">
            <textarea name="tweet_text" maxlength="140" placeholder="co masz na myśli?"></textarea><br>
            <button type="submit" name="send_tweet">Wyślij</button>
        </form>
    </div>
    <div>
        <table>
<?php
foreach ($allTweets as $tweet) {
    $userId = $tweet->getUserId();
    echo "<tr>";
    echo "<td>" . $tweet->getId() . "</td>";
    echo "<td><a href='04_userPage.php?user_id=" . $userId . "'>" .
        User::loadUserById($conn, $userId)->getUsername() . "</a></td>";
    echo "<td>" . $tweet->getText() . "</td>";
    echo "<td>" . $tweet->getCreationDate() . "</td>";
    echo "<td><a href='05_tweetPage.php?tweet_id=" . $tweet->getId() . "'>więcej >></a></td>";
    echo "</tr>";
}
?>
        </table>
    </div>
    </body>
</html>

<?php

$conn->close();
$conn = null;

?>