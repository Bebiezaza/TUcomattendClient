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
            include('../TUcomattendServer/config.php');
            include('function/sql.php');
            $conn = mysqli_connect($db_host, $db_user, $db_pass);

            $user = $_POST["login_name"];
            $pass = md5($_POST["login_pass"]);

            $internalIP = $_POST["internalIP"];
            $datetime = $_POST["datetime"];

            if ($user == "")
            {
?>
                <p class="header">ไม่ได้ลงชื่อผู้ใช้งาน</p>
                <form method = post action = index.php>
                    <input class = "login_fail" type = submit value = "> กลับไปเข้าสู่ระบบ <">
                </form>
<?php
                die;
            }

            //select database
            selectDB($conn, "TUcomattend");

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
                            <p class="header">ไม่มีชื่อผู้ใช้นี้ในระบบ</p>
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
                    <p class="header">ไม่มีชื่อผู้ใช้นี้ในระบบ</p>
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
            work($conn, $sql, "Data Written to Table 'computer_log' Successfully", "เกิดปัญหา โปรดติดต่อผู้ดูแลระบบ: ", true);

        //sql disconnect
            mysqli_close($conn);
?>
        <p class="header">ยินดีต้อนรับ</p>

        <form method = post action = index.php>
            <input class = login type = submit value = "เข้าสู่คอมพิวเตอร์">
        </form></center>
    </body>
</html>