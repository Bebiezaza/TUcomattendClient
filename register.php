<!DOCTYPE HTML>
<html lang = "th">
<head>
    <meta charset = "utf-8">
    <title>ลงทะเบียนระบบเข้าใช้คอมพิวเตอร์</title>
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
        include('../TUcomattendServer/config.php');
        include('function/sql.php');
        $conn = mysqli_connect($db_host, $db_user, $db_pass);
        error_reporting(0);

        $user = $_POST["login_name"];
        $pass = $_POST["login_pass"];
        $bday = $_POST["bday"];
        $bmonth = $_POST["bmonth"];
        $byear = $_POST["byear"];
        $birthday = $byear . "-" . $bmonth . "-" . $bday;
        
        if ($user == "")
        {
    ?>

    <div class = "login"><form method = post autocomplete = "off">
        <label for = "login_name">รหัสนักเรียน</label><br>
        <input id = "login_name" type = "text" name = "login_name"><br><br>
        
        <label for = "login_name">รหัสผ่าน</label><br>
        <input id = "login_pass" type = "password" name = "login_pass"><br><br>

        <label for="bday">วันเกิด</label>
        <select id="bday" name="bday">
            <option value = "01">01</option>
            <option value = "02">02</option>
            <option value = "03">03</option>
            <option value = "04">04</option>
            <option value = "05">05</option>
            <option value = "06">06</option>
            <option value = "07">07</option>
            <option value = "08">08</option>
            <option value = "09">09</option>
            <?php for($i = 10; $i <= 31; $i++)
            {
                echo "<option value=" . $i . ">" . $i . "</option>";
            }
            ?>
        </select>

        <label for="bmonth">เดือนเกิด</label>
        <select id="bmonth" name="bmonth">
            <option value = "01">01</option>
            <option value = "02">02</option>
            <option value = "03">03</option>
            <option value = "04">04</option>
            <option value = "05">05</option>
            <option value = "06">06</option>
            <option value = "07">07</option>
            <option value = "08">08</option>
            <option value = "09">09</option>
            <option value = "10">10</option>
            <option value = "11">11</option>
            <option value = "12">12</option>
        </select>

        <label for="byear">ปีเกิด</label>
        <select id="byear" name="byear">
            <?php for($i = 2000; $i <= 2020; $i++)
            {
                echo "<option value=" . $i . ">" . $i . "</option>";
            }
            ?>
        </select>
        <br><br>

        <label for = "login_name">รูปบัตรประชาชน (future)</label><br>
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