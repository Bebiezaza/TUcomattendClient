<?php
//select database function
    function selectDB($conn, $dbname)
    {
        if (!mysqli_select_db($conn, $dbname))
        {
            echo "<h1>Error Using Database: " . mysqli_error($conn) . "</h1><br>";
            
            echo "<form method = 'post' action = 'index.php'><input type = 'submit' value = 'กลับสู่หน้าหลัก'></form>";
            die;
        }
    }

//work function
    function work($conn, $sql, $success, $fail, $death)
    {
        if (!mysqli_query($conn, $sql))
        {
            echo "<h1>" . $fail . mysqli_error($conn) . "</h1><br>";
            if($death == true)
            {
                echo "<form method = 'post' action = 'index.php'><input type = 'submit' value = 'กลับสู่หน้าหลัก'></form>";
                die;
            }
        }
        else
        {
            echo $success . "<br>";
        }
    }
?>