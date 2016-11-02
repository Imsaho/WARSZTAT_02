<?php
session_start();
if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) {
    $loggedUserId = $_SESSION['user_id'];
    echo "";
} else {
    echo "<br><a href='02_loginPage.php'>Zaloguj się</a>";
    exit;
}

include_once 'SRC/User.php';
include_once 'SRC/Tweet.php';
include_once 'SRC/Comment.php';
include_once 'SRC/db_config_inc.php';

$conn = getDbConnection();

if (isset($_GET['tweet_id'])) {
    $tweetId = $_GET['tweet_id'];
} else {
    echo "Brak tweetów o wskazanym ID";
}

$tweet = Tweet::loadTweetById($conn, $tweetId);
$allComments = Comment::loadAllCommentsByTweetId($conn, $tweetId);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['comment_text']) && $_POST['comment_text'] != "") {
        $commentText = $_POST['comment_text'];
        $newComment = new Comment();
        $newComment->setUserId($loggedUserId);
        $newComment->setTweetId($tweetId);
        $newComment->setText($commentText);
        $newComment->saveToDB($conn);
    } else {
        echo "Wpisz treść komentarza!";
    }
}

?>

<html>
    <head>
        
    </head>
    <body>
          <div>
            <form action="" method="POST">
            <textarea name="comment_text" maxlength="60" placeholder="skomentuj!"></textarea><br>
            <button type="submit" name="send_comment">Wyślij</button>
             </form>
         </div>
    <div>
        <table>
<?php

    echo "<tr>";
    echo "<td>" . $tweet->getId() . "</td>";
    echo "<td>" . $tweet->getText() . "</td>";
    echo "<td>" . $tweet->getCreationDate() . "</td>";
        echo "<table>";
        foreach ($allComments as $comment) {
            $userId = $comment->getUserId();
            echo "<tr>";
            echo "<td>" . $comment->getId() . "</td>";
            echo "<td><a href='04_userPage.php?user_id=" . $userId . "'>" . User::loadUserById($conn, $userId)->getUsername() . "</td>";
            echo "<td>" . $comment->getText() . "</td>";
            echo "<td>" . $comment->getCreationDate() . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    echo "</tr>";
    echo "<br>";

?>
        </table>
    </div>
         <hr>
        <a href="01_mainPage.php">Powrót do srony głównej</a>
    </body>
</html>

<?php

$conn->close();
$conn = null;

?>