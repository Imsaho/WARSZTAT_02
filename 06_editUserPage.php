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

$currentUser = User::loadUserById($conn, $loggedUserId);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['submit'])) {
        switch ($_POST['submit']) {
            case 'username':
                if ($_POST['username'] != "" && strlen($_POST['username']) > 2) {
                    $currentUser->setUsername($_POST['username']);
                    if ($currentUser->saveToDB($conn)) {
                        echo "Dane zostały zaktualizowane";
                    } else {
                        echo "Nie udało się zaktualizować danych. Błąd: " . $conn->error;
                    }
                } else {
                    echo "Podana nazwa użytkownika jest za krótka";
                }
                break;
            case 'password':
                if (strlen($_POST['password1']) > 4 && ($_POST['password1'] == $_POST['password2'])) {
                    $currentUser->setHashedPassword($_POST['password1']);
                    if ($currentUser->saveToDB($conn)) {
                        echo "Dane zostały zaktualizowane";
                    } else {
                        echo "Nie udało się zaktualizować danych. Błąd: " . $conn->error;
                    }
                } else {
                    echo "Niepoprawne hasło";
                }
                break;
            default:
                break;
        }
    }
}

?>

<html>
    <head>

    </head>
    <body>
        <h3>Aktualizuj dane</h3>
        <div>

            <form action="" method="POST">
                <label>Nazwa użytkownika:</label>
                <input type="text" name="username"></input><br>
                <button type="submit" name="submit" value="username">Zmień</button>
            </form>

            <form action="" method="POST">
                <label>Hasło:</label>
                <input type="password" name="password1" placeholder="min. 5 znaków"></input><br>
                <label>Potwierdź hasło:</label>
                <input type="password" name="password2"></input><br>                
                <button type="submit" name="submit" value="password">Zmień</button>
            </form>

        </div>
    </body>
</html>

<?php
$conn->close();
$conn = null;
?>