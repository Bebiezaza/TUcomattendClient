<!DOCTYPE HTML>
<html lang = "th">
    <head>
        <meta charset = "utf-8">
        <title>ระบบเข้าใช้คอมพิวเตอร์ โรงเรียนเตรียมอุดมศึกษา</title>

<link href="css/theme.css" rel="stylesheet"/>
    </head>

    <body>
        <header>
            <p class = "header"><IMG id = "TUlogo" src = "pictures/phrakiao.png">ระบบเข้าใช้คอมพิวเตอร์</p>
        </header>

        <center>
<?php
            include('config.php');
            include($server_path . 'config.php');
            include('function/sqlHelper.php');
            $conn = mysqli_connect($db_host, $db_user, $db_pass);

            $user = $_POST["login_name"];
            $pass = md5($_POST["login_pass"]);

            date_default_timezone_set('Asia/Bangkok');
            $datetime = date("Y-m-d \TH:i:s", date_timestamp_get(date_create()));

            $internalIP = $_SERVER['REMOTE_ADDR'];

            if ($user == "")
            {
                landingFailed($conn, "ไม่ได้ใส่รหัสนักเรียน");
            }

            //select database
            selectDB($conn, "$db_name");

            $sql = "SELECT * from student_login WHERE username = '$user'";
            if($result = mysqli_query($conn, $sql))
            {
                //login password check
                if (mysqli_num_rows($result) > 0)
                {           
                    while($row = mysqli_fetch_array($result))
                    {
                        if ($user != $row["username"])
                        {
                            mysqli_free_result($result);
                            landingFailed($conn, "ไม่มีรหัสนักเรียนนี้ในระบบ");
                        }
                        elseif ($pass != $row["password"])
                        {
                            mysqli_free_result($result);
                            landingFailed($conn, "รหัสผ่านไม่ถูกต้อง");
                        }
                    }
                    mysqli_free_result($result);
                }
                else
                {
                    landingFailed($conn, "ไม่มีรหัสนักเรียนนี้ในระบบ");
                }
            }
        //add admin login
            $sql = "INSERT INTO computer_log
            VALUES ('$datetime', '$internalIP', '$user');";

            //write table
            work($conn, $sql, "ยินดีต้อนรับ", "เกิดปัญหา โปรดติดต่อผู้ดูแลระบบ: ", true);
?>
            <form method = get action = "https://www.google.com">
                <input class = "login" type = "submit" value = "> เข้าสู่คอมพิวเตอร์<">
            </form>
        </center>
        
        <footer>
            <a class = "footerlink" href="http://www.triamudom.ac.th">โรงเรียนเตรียมอุดมศึกษา</a>
        </footer>
    </body>
</html>