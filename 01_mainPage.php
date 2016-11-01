<?php

include_once 'SRC/User.php';
include_once 'SRC/Tweet.php';
include_once 'SRC/db_config_inc.php';

$conn = getDbConnection();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!empty($_POST['email']) && !empty($_POST['password'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];
        $loggedUser = User::loadUserByEmail($conn, $email);
        if ($loggedUser != null) {
            $hash = $loggedUser->getHashedPassword();
            if (password_verify($password, $hash)) {
                $_SESSION['user_id'] = $loggedUser->getId();
            } else {
                header("Loaction: 02_loginPage.php");
                echo "Niepoprawne hasło";
                echo "<br><a href='02_loginPage.php'><< Powrót</a>";
                exit;
            }
        } else {
            header("Loaction: 02_loginPage.php");
            echo "Brak użytkownika o podanym adresie e-mail";
            echo "<br><a href='02_loginPage.php'><< Powrót</a>";
            exit;
        }
    } else {
        header("Loaction: 02_loginPage.php");
        echo "Podaj e-mail oraz hasło";
        echo "<br><a href='02_loginPage.php'><< Powrót</a>";
        exit;
    }
}

$allTweets = Tweet::loadAllTweets($conn);

//var_dump($_SESSION);


?>

<html>
    <head>
        
    </head>
    <body>
    <div>
        <form>
            
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