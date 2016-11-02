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
include_once 'SRC/Message.php';
include_once 'SRC/db_config_inc.php';

$conn = getDbConnection();

if (isset($_GET['message_id'])) {
    $messageId = $_GET['message_id'];
} else {
    echo "Brak wiadomości o wskazanym ID";
}

$message = Message::loadMessageById($conn, $messageId);

?>

<html>
    <head>
        
    </head>
    <body>
        <div>
            <table>
<?php
    $senderId = $message->getSenderId();
    $receiverId = $message->getReceiverId();
    echo "<tr>";
    echo "<td>" . $message->getId() . "</td>";
    echo "<td>Od: " . User::loadUserById($conn, $senderId)->getUsername() . "</td>";
    echo "<td>Do: " . User::loadUserById($conn, $receiverId)->getUsername() . "</td>";
    echo "<td>" . $message->getText() . "</td>";
    echo "<td>" . $message->getCreationDate() . "</td>";
    echo "</tr>";
?>
            </table>
        </div>
         <hr>
         <a href="07_mailboxPage.php">Powrót do wiadomości</a>
    </body>
</html>

<?php

$conn->close();
$conn = null;

?>