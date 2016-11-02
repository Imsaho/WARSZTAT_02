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
include_once 'SRC/Message.php';
include_once 'SRC/db_config_inc.php';

$conn = getDbConnection();

$receivedMessages = Message::loadMessagesByReceiverId($conn, $loggedUserId);
$sentMessages = Message::loadMessagesBySenderId($conn, $loggedUserId);
//var_dump($receivedMessages);
//var_dump($sentMessages);

?>

<html>
    <head>
        
    </head>
    <body>
        <div name="received">
            <h3>Skrzynka odbiorcza</h3>
            <table>
<?php
    foreach ($receivedMessages as $message) {
        $userId = $message->getSenderId();
        echo "<tr>";
        echo "<td>" . $message->getId() . "</td>";
        echo "<td>" . User::loadUserById($conn, $userId)->getUsername() . "</td>";
        echo "<td>" . substr($message->getText(), 0, 30) . "...</td>";
        echo "<td>" . $message->getCreationDate() . "</td>";
        echo "<td><a href='08_mailPage.php?message_id=" . $message->getId() . "'>Zobacz >></a></td>";
        echo "</tr>";
    }
?>
            </table>
        </div>
        <div name="sent">
            <h3>Wiadomości wysłane</h3>
            <table>
<?php
    foreach ($sentMessages as $message) {
        $userId = $message->getReceiverId();
        echo "<tr>";
        echo "<td>" . $message->getId() . "</td>";
        echo "<td>" . User::loadUserById($conn, $userId)->getUsername() . "</td>";
        echo "<td>" . substr($message->getText(), 0, 30) . "...</td>";
        echo "<td>" . $message->getCreationDate() . "</td>";
        echo "<td><a href='08_mailPage.php?message_id=" . $message->getId() . "'>Zobacz >></a></td>";
        echo "</tr>";
    }
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