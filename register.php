<!DOCTYPE HTML>
<html lang = "th">
    <head>
        <meta charset = "utf-8">
        <title>ระบบเข้าใช้คอมพิวเตอร์ โรงเรียนเตรียมอุดมศึกษา</title>

<link href="css/theme.css" rel="stylesheet"/>
    </head>
    
    <body>
        <header>
            <p class = "header"><IMG id = "TUlogo" src = "pictures/phrakiao.png">ลงทะเบียนระบบเข้าใช้คอมพิวเตอร์</p>
        </header>

        <center>
<?php
            include('config.php');
            include($server_path . 'config.php');
            include('function/sqlHelper.php');
            include('function/registerHelper.php');
            
            if (isset($_POST['register']))
            {
                $conn = mysqli_connect($db_host, $db_user, $db_pass);

                $user = $_POST["user"];
                $pass = $_POST["pass"];
                $conf = $_POST["pass_conf"];
                
                $bday = $_POST["bday"];
                $bmonth = $_POST["bmonth"];
                $byear = $_POST["byear"];
                $birthday = $byear . "-" . $bmonth . "-" . $bday;

                if(!(int)$user)                     registerFailed($conn, "รหัสนักเรียนไม่เป็นตัวเลข");
                if (strlen((string)$user) != 5)     registerFailed($conn, "รหัสนักเรียนไม่ครบ 5 หลัก");
                if ($pass != $conf)                 registerFailed($conn, "รหัสผ่านไม่สามารถยืนยันได้");

                //select database
                    selectDB($conn, "$db_name");

                //registration
                    $sql = "INSERT INTO student_login
                    VALUES ('$user', MD5('$pass'), '$birthday');";

                    //write table
                    registerWrite($conn, $sql, "รหัสนักเรียนซ้ำ");
            }
            else
            {
?>
                <form method = post autocomplete = "off">
                    <div class = "login">
                        <label for = "user">รหัสนักเรียน</label><br>
                        <input id = "user" type = "text" maxlength="5" name = "user"><br><br>
                        
                        <label for = "pass">รหัสผ่าน</label><br>
                        <input id = "pass" type = "password" name = "pass"><br><br>

                        <label for = "pass_conf">ยืนยันรหัสผ่าน</label><br>
                        <input id = "pass_conf" type = "password" name = "pass_conf"><br><br>

                        <label for="bday">วันเกิด</label>
                        <select id="bday" name="bday">
<?php
                            optionLoop(1, 31);
?>
                        </select>

                        <label for="bmonth">เดือนเกิด</label>
                        <select id="bmonth" name="bmonth">
<?php
                            optionLoop(1, 12);
?>
                        </select>

                        <label for="byear">ปีเกิด</label>
                        <select id="byear" name="byear">
<?php
                            optionLoop(2000, 2037);
?>
                        </select>
                        <br>
                    </div>
                    <input class = "login" type = submit name = "register" value = "> ลงทะเบียน <">
                </form>

                <footer>
                    <form method = post action = "index.php">
                        <input type = "submit" value = "กลับสู่หน้าหลัก">
                    </form>
                </footer>
<?php
            }
?>
        </center>
    </body>
</html>