<?php
session_start();
include_once 'SRC/User.php';
include_once 'SRC/Tweet.php';
include_once 'SRC/db_config_inc.php';

$conn = getDbConnection();

//if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) {
//    echo "Jesteś już zalogowany";
//    exit;
//}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!empty($_POST['email']) && !empty($_POST['password'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];
        $loggedUser = User::loadUserByEmail($conn, $email);
        if ($loggedUser != null) {
            $hash = $loggedUser->getHashedPassword();
            if (password_verify($password, $hash)) {
                $_SESSION['logged_in'] = true;
                $_SESSION['user_id'] = $loggedUser->getId();
                header("Location: 01_mainPage.php");
            } else {
                $_SESSION['logged_in'] = false;
                unset($_SESSION['user_id']);
                echo "Niepoprawne hasło";
            }
        } else {
            $_SESSION['logged_in'] = false;
            unset($_SESSION['user_id']);
            echo "Brak użytkownika o podanym adresie e-mail";
        }
    } else {
        $_SESSION['logged_in'] = false;
        unset($_SESSION['user_id']);
        echo "Podaj e-mail oraz hasło";
    }
}

?>

<html>
    <head>
        
    </head>
    <body>
        <div>
            <p></p>
        </div>
        <div>
            <form method="POST" action="">
                <label>E-mail:</label>
                <input type="text" name="email"></input>
                <br>
                <label>Hasło:</label>
                <input type="text" name="password"></input>
                <br>
                <button type="submit">Zaloguj</button>
            </form>
        </div>
        <div>
            <p>Nie masz jeszcze konta? <a href="03_registerPage.php">Zarejestruj się!</a></p>
        </div>
    </body>
</html>

<?php
$conn->close();
$conn = null;

?>