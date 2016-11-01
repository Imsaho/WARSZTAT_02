<?php

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

?>