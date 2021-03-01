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
            error_reporting(0);

            include('config.php');
            include($server_path . 'config.php');
            $conn = mysqli_connect($db_host, $db_user, $db_pass);

            if (!mysqli_select_db($conn, "$db_name"))
            {
                echo "<p class = 'header'>ไม่ได้มีการตั้งค่าระบบฐานข้อมูล โปรดติดต่อผู้ดูแลระบบ</p>";
            }
            else
            {
?>
                <form method = "post" action = "landing.php" autocomplete = "off">
                    <div class = "login">
                        <label for = "login_name">รหัสนักเรียน</label><br>
                        <input id = "login_name" type = "text" maxlength="5" name = "login_name"><br><br>
                        
                        <label for = "login_name">รหัสผ่าน</label><br>
                        <input id = "login_pass" type = "password" name = "login_pass"><br>
                    </div>
                    <input class = "login" type = "submit" value = "> เข้าสู่ระบบ <">
                </form><br><br><br>

                <font color = "white" size = "3.75em">ลงทะเบียนไม่ต้องกรอกฟอร์มข้างบน</font>
                
                <form method = "post" action = "register.php" autocomplete = "off">
                    <input class = "login" type = "submit" value = "> ลงทะเบียน <">
                </form>
<?php
            }
            
        //sql disconnect
            mysqli_close($conn);
?>
        </center>
    </body>
</html>