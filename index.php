<?php

include_once 'SRC/User.php';



/*$user = new User();

$user->setUsername("Andrzej");
$user->setHashedPassword("coderslab");
$user->setEmail("andrzej@gmail.com");
 * 
 */

$conn = getDbConnection();
$id =1;

// $user = User::loadUserById($conn, $id);

$users = User::loadAllUsers($conn);

var_dump($users);

$email = "adam.nowy@gmail.com";

$user = User::loadUserById($conn, 1);
$user->setEmail($email);

if ($user->saveToDB($conn)) {
    echo "user updated";
    var_dump($user);
} else {
    echo "user not updated";
}

/* if (is_null($user)) {
    echo "User with id $id does not exist!";
    die;
}
 * 
 */

/*
if ($user->saveToDB($conn)) {
    // var_dump($user);
    echo "Użytkownik został dodany";
} else {
    echo "Błąd. Nie dodano użytkownika";
}
 * 
 */


function getDbConnection() {
    $servername = 'localhost';
    $username = 'twitter';
    $password = "AQ76riT94TGwVm0o";
    $baseName = "twitter";

    $conn = new mysqli($servername, 
            $username, 
             $password, 
            $baseName
    );

    if ($conn->connect_error == FALSE) {
       echo "";
    } else {
      echo "Connection Error: " . $conn->connect_error;
      die;
    }
    
    $setEncodingSql = "SET CHARSET utf8";
    $conn->query($setEncodingSql);

    return $conn;

}

$conn->close();
$conn = null;


?>