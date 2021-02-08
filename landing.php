<!DOCTYPE HTML>
<html lang = "th">
    <head>
        <meta charset = "utf-8">
        <title>ระบบเข้าใช้คอมพิวเตอร์ โรงเรียนเตรียมอุดมศึกษา</title>
    </head>
    <link href="css/theme.css" rel="stylesheet"/>
        
<style>
    @font-face {
        font-family: Kanit;
        src: url(fonts/Kanit-Regular.ttf)
    }
</style>

    <body>
        <header>
            <p class = "header"><IMG id = "TUlogo" src = "pictures/phrakiao.png">ระบบเข้าใช้คอมพิวเตอร์</p>
        </header>

        <center><?php
            include('config.php');
            include($server_path . 'config.php');
            include('function/sql.php');
            $conn = mysqli_connect($db_host, $db_user, $db_pass);

            $user = $_POST["login_name"];
            $pass = md5($_POST["login_pass"]);

            $internalIP = $_POST["internalIP"];
            
            date_default_timezone_set('Asia/Bangkok');
            $unixOBJ = date_create();
            $unixINT = date_timestamp_get($unixOBJ);
            $datetime = date("Y-m-d \TH:i:s", $unixINT);

            if ($user == "")
            {
?>
                <p class="header">ไม่ได้ใส่รหัสนักเรียน</p>
                <form method = post action = index.php>
                    <input class = "login_fail" type = submit value = "> กลับไปเข้าสู่ระบบ <">
                </form>
<?php
                die;
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
?>
                            <p class="header">ไม่มีรหัสนักเรียนนี้ในระบบ</p>
                            <form method = post action = index.php>
                                <input class = "login_fail" type = submit value = "> กลับไปเข้าสู่ระบบ <">
                            </form>
<?php
                            die;
                        }
                        elseif ($pass != $row["password"])
                        {
?>
                            <p class="header">รหัสผ่านผิด</p>
                            <form method = post action = index.php>
                                <input class = "login_fail" type = submit value = "> กลับไปเข้าสู่ระบบ <">
                            </form>
<?php
                            die;
                        }
                    }
                    mysqli_free_result($result);
                }
                else
                {
?>
                    <p class="header">ไม่มีรหัสนักเรียนนี้ในระบบ</p>
                    <form method = post action = index.php>
                        <input class = "login_fail" type = submit value = "> กลับไปเข้าสู่ระบบ <">
                    </form>
<?php
                    die;
                }
            }
        //add admin login
            $sql = "INSERT INTO computer_log
            VALUES ('$datetime', '$internalIP', '$user');";

            //write table
            work($conn, $sql, "<p class='header'>ยินดีต้อนรับ <br> ปิดหน้าต่างนี้ได้</p>", "เกิดปัญหา โปรดติดต่อผู้ดูแลระบบ: ", true);

        //sql disconnect
            mysqli_close($conn);
?>
        <!--<form method = post action = "index.php">
            <input class = login type = submit value = "เข้าสู่คอมพิวเตอร์">
        </form>-->
    </center>
    </body>
</html>