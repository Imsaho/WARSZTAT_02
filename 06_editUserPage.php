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
include_once 'SRC/db_config_inc.php';

$conn = getDbConnection();



?>

<html>
    <head>
        
    </head>
    <body>
        <div>
            <form action="" method=""POST>
                <label>Nazwa użytkownika:</label>
                <input type="text" name="username"></input><br>
                <label>E-mail:</label>
                <input type="text" name="email"></input><br>
                <label>Hasło:</label>
                <input type="password" name="password1"></input><br>
                <label>Potwierdź hasło:</label>
                <input type="password" name="password2"></input><br>                
                <button type="submit">Wyślij</button>
            </form>
        </div>
    </body>
</html>

<?php

$conn->close();
$conn = null;

?>