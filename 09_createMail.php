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

if (isset($_GET['receiver_id'])) {
    $receiverId = $_GET['receiver_id'];
} else {
    echo "Brak użytkownika o wskazanym ID";
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['message_text']) && $_POST['message_text'] != "") {
        $messageText = $_POST['message_text'];
        $newMessage = new Message();
        $newMessage->setSenderId($loggedUserId);
        $newMessage->setText($messageText);
        if ($loggedUserId != $receiverId) {
            $newMessage->setReceiverId($receiverId);
            $newMessage->saveToDB($conn);
            echo "Wiadomość została wysłana";
        } else {
            echo "Nie można wysłać wiadomości: zmień adresata";
        }
    } else {
        echo "Nie można wysłać wiadomości bez treści";
    }
}

?>

<html>
    <head>
        
    </head>
    <body>
        <div>
        <form action="" method="POST">
            <h3>Nowa wiadomość do: <?=User::loadUserById($conn, $receiverId)->getUsername()?></h3>
            <textarea name="message_text" placeholder="wpisz treść wiadomości" maxlength="140" cols="50" rows="10" style="resize: none"></textarea><br>
            <button type="submit" name="send_message">Wyślij</button>
        </form>
        </div>
         <hr>
        <a href="01_mainPage.php">Powrót do srony głównej</a>
    </body>
</html>

<?php

$conn->close();
$conn = null;

?>