<?php


//var_dump($_COOKIE);
//var_dump($_SESSION);
//setcookie('PHPSESSID', '', time()-3600);






?>

<html>
    <head>
        
    </head>
    <body>
        <div>
            <p></p>
        </div>
        <div>
            <form method="POST" action="01_mainPage.php">
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


?>