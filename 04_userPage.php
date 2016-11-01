<?php

include_once 'SRC/User.php';
include_once 'SRC/Tweet.php';
include_once 'SRC/db_config_inc.php';

$conn = getDbConnection();

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset($_GET['user_id'])) {
        $userId = $_GET['user_id'];
    } else {
        echo "Brak użytkownika o wskazanym ID";
    }
} else {
    echo "Niepoprawnie przesłane dane";
}

$allUserTweets = Tweet::loadAllTweetsByUserId($conn, $userId);

?>

<html>
    <head>
        
    </head>
    <body>
    <div>
        <table>
<?php
foreach ($allUserTweets as $tweet) {
    echo "<tr>";
    echo "<td>" . $tweet->getId() . "</td>";
    echo "<td>" . $tweet->getText() . "</td>";
    echo "<td>" . $tweet->getCreationDate() . "</td>";
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