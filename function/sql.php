<?php
//select database function
    function selectDB($conn, $dbname)
    {
        if (!mysqli_select_db($conn, $dbname))
        {
            echo "<h1>Error Using Database: " . mysqli_error($conn) . "</h1><br>";
            echo "<form method = 'post' action = 'index.php'><input type = 'submit' value = 'กลับสู่หน้าหลัก'></form>";

            //sql disconnect
            mysqli_close($conn);

            die;
        }
    }

//landing failed notice
    function landingFailed($conn, $text)
    {
        echo "<p class='header'>$text</p>";
?>
        <form method = "post" action = index.php>
            <input class = "login_fail" type = submit value = "> กลับไปเข้าสู่ระบบ <">
        </form>
<?php
        //sql disconnect
        mysqli_close($conn);
        
        die;
    }

//work function
    function work($conn, $sql, $success, $fail, $redir)
    {
        if (!mysqli_query($conn, $sql))
        {
            echo "<p class='header'>" . $fail . mysqli_error($conn) . "</p><br>";
            if($redir == true)
            {
                echo "<form action = 'index.php'><input class = 'login_fail' type = 'submit' value = '> กลับสู่หน้าหลัก <'></form>";
                
                //sql disconnect
                mysqli_close($conn);
                
                die;
            }
        }
        else
        {
            echo "<p class='header'>" . $success . "</p><br>";

            //sql disconnect
            mysqli_close($conn);
        }
    }
?>