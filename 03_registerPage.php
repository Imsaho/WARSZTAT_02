<?php
session_start();
include_once 'SRC/User.php';
include_once 'SRC/Tweet.php';
include_once 'SRC/db_config_inc.php';

$conn = getDbConnection();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!empty($_POST['username']) 
            && !empty($_POST['email']) 
            && !empty($_POST['password1']) 
            && !empty($_POST['password2'])) {
        $username = $_POST['username'];
        $email = $_POST['email'];

        if (strlen($username) < 3) {
            echo "Za krótka nazwa użytkownika";
        } elseif (strpos($email, '@') === false
                OR strpos($email, '.' === false)) {
            echo "Niepoprawny e-mail";
        } elseif (strlen($_POST['password1']) < 5) {
            echo "Za krótkie hasło. Wprowadź hasło nie krótsze niż 5 znaków";
        } elseif ($_POST['password1'] != $_POST['password2']) {
            echo "Niepoprawne hasło, sprawdź jeszcze raz";
        } else {
            $password = $_POST['password1'];
            $user = new User();
            $user->setUsername($username);
            $user->setHashedPassword($password);
            $user->setEmail($email);

            if ($user->saveToDB($conn)) {
                echo "Użytkownik został dodany!";
            } else {
                echo "Użytkownik nie został dodany. Błąd: " . $conn->error;
            }
        }
    } else {
        echo "Podaj wszystkie dane";
    }
}
?>

<html>
    <head>

    </head>
    <body>
        <div>
            <form method="POST" action="">
                <label>Username:</label>
                <input type="text" name="username"></input><br>
                <label>E-mail:</label>
                <input type="text" name="email"></input><br>
                <label>Password:</label>
                <input type="password" name="password1"></input><br>
                <label>Confirm password:</label>
                <input type="password" name="password2"></input><br>
                <button type="submit">Zarejestruj</button>
            </form>
            <a href="02_loginPage.php">Zaloguj się</a>
        </div>
    </body>
</html>

<?php
$conn->close();
$conn = null;
?>