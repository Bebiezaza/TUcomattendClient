<!DOCTYPE HTML>
<html lang = "th">
    <head>
        <meta charset = "utf-8">
        <title>Login Passthrough Test</title>
    </head>

    <body><center>
        <h1>Login Passthrough Test</h1><hr>
        <?php
            $dbuser = $_POST["username"];
            $dbpass = $_POST["password"];

            $user = $_POST["login_name"];
            $pass = $_POST["login_pass"];

            echo "DB USERNAME: " . $dbuser;
            echo "<br>DB PASSWORD: ". $dbpass;
            echo "<br>USERNAME: " . $user;
            echo "<br>PASSWORD: ". $pass;
        ?>