<?php

include_once 'SRC/User.php';
include_once 'SRC/Tweet.php';
include_once 'SRC/db_config_inc.php';

$conn = getDbConnection();

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset($_GET['tweet_id'])) {
        $tweetId = $_GET['tweet_id'];
    } else {
        echo "Brak tweetów o wskazanym ID";
    }
} else {
    echo "Niepoprawnie przesłane dane";
}

$tweet = Tweet::loadTweetById($conn, $tweetId);

?>

<html>
    <head>
        
    </head>
    <body>
    <div>
        <table>
<?php

    echo "<tr>";
    echo "<td>" . $tweet->getId() . "</td>";
    echo "<td>" . $tweet->getText() . "</td>";
    echo "<td>" . $tweet->getCreationDate() . "</td>";
    echo "</tr>";

?>
        </table>
    </div>
    </body>
</html>

<?php

$conn->close();
$conn = null;

?>