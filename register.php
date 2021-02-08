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
        <p class = "header"><IMG id = "TUlogo" src = "pictures/phrakiao.png">ลงทะเบียนระบบเข้าใช้คอมพิวเตอร์</p>
    </header>

    <center><?php
        include('config.php');
        include($server_path . 'config.php');
        include('function/sql.php');
        $conn = mysqli_connect($db_host, $db_user, $db_pass);
        error_reporting(0);

        $user = $_POST["user"];
        $pass = $_POST["pass"];
        $conf = $_POST["pass_conf"];
        $bday = $_POST["bday"];
        $bmonth = $_POST["bmonth"];
        $byear = $_POST["byear"];
        $birthday = $byear . "-" . $bmonth . "-" . $bday;
        
        if ($user == "")
        {
    ?>

    <div class = "login"><form method = post autocomplete = "off">
        <label for = "user">รหัสนักเรียน</label><br>
        <input id = "user" type = "text" maxlength="5" name = "user"><br><br>
        
        <label for = "pass">รหัสผ่าน</label><br>
        <input id = "pass" type = "password" name = "pass"><br><br>

        <label for = "pass_conf">ยืนยันรหัสผ่าน</label><br>
        <input id = "pass_conf" type = "password" name = "pass_conf"><br><br>

        <label for="bday">วันเกิด</label>
        <select id="bday" name="bday">
            <?php for($i = 1; $i <= 31; $i++)
            {
                if (strlen($i) == 1) { $j = "0" . $i; }
                else { $j = $i; }
                
                echo "<option value=" . $j . ">" . $j . "</option>";
            }
            ?>
        </select>

        <label for="bmonth">เดือนเกิด</label>
        <select id="bmonth" name="bmonth">
        <?php for($i = 1; $i <= 12; $i++)
            {
                if (strlen($i) == 1) { $j = "0" . $i; }
                else { $j = $i; }
                
                echo "<option value=" . $j . ">" . $j . "</option>";
            }
        ?>
        </select>

        <label for="byear">ปีเกิด</label>
        <select id="byear" name="byear">
            <?php for($i = 2000; $i <= 2020; $i++)
            {
                echo "<option value=" . $i . ">" . $i . "</option>";
            }
            ?>
        </select>
        <br><!--<br>

        <label for = "user">รูปบัตรประชาชน (future)</label><br>-->
        </div>
        
        <input class = login type = submit value = "ลงทะเบียน">
    </form>
    
    <footer>
        <form method = post action = "index.php">
            <input type = "submit" value = "กลับสู่หน้าหลัก">
        </form>
    </footer>
        <?php 
        die;
        }
        else
        {
            if(!(int)$user)
            {
                echo "<div class = 'login'>ลงทะเบียนไม่สำเร็จ <br> รหัสนักเรียนไม่เป็นตัวเลข</div>";
            }
            else if ($pass != $conf)
            {
                echo "<div class = 'login'>ลงทะเบียนไม่สำเร็จ <br> รหัสผ่านไม่สามารถยืนยันได้</div>";
            }
            else
            {
            //select database
                selectDB($conn, "TUcomattend");

            //add default student login
                $sql = "INSERT INTO student_login
                VALUES ('$user', MD5('$pass'), '$birthday');";

                //write table
                register($conn, $sql, "<div class = 'login'>ลงทะเบียนสำเร็จ</div>", "<div class = 'login'>ลงทะเบียนไม่สำเร็จ <br> รหัสนักเรียนซ้ำ");
            }
        }

        //sql disconnect
            mysqli_close($conn);
        ?>
        <form method = post action = "index.php">
            <input class = login type = "submit" value = "กลับสู่หน้าหลัก">
        </form>
    </center>
</body>
</html>