<!DOCTYPE HTML>
<html lang = "th">
    <head>
        <meta charset = "utf-8">
        <title>ระบบเข้าใช้คอมพิวเตอร์ โรงเรียนเตรียมอุดมศึกษา</title>

        <link href="css/theme.css" rel="stylesheet"/>
        
<style>
    @font-face {
        font-family: Kanit;
        src: url(fonts/Kanit-Regular.ttf)
    }
</style>
    </head>

    <body>
        <p class = "header"><IMG id = "TUlogo" src = "pictures/phrakiao.png">ระบบเข้าใช้คอมพิวเตอร์ BETA</p>

        <center>
        <?php
            include('config.php');
            include($server_path . 'config.php');
            $conn = mysqli_connect($db_host, $db_user, $db_pass);

            if (!mysqli_select_db($conn, "TUcomattend"))
            {
                echo "<p class = 'header'>ไม่ได้มีการตั้งค่าระบบฐานข้อมูล โปรดติดต่อผู้ดูแลระบบ</p>";
            }
            else
            {                
                $global_localIP = $_SERVER['REMOTE_ADDR'];
        ?>
        <p class = "header">[DEBUG] Your local IP is: <?php echo $global_localIP; ?></p>
        
        <div class = "login"><form method = "post" action = "landing.php" autocomplete = "off">
            <input type = "hidden" name = "internalIP" value = <?php echo $global_localIP ?>>

            <label for = "login_name">รหัสนักเรียน</label><br>
            <input id = "login_name" type = "text" maxlength="5" name = "login_name"><br><br>
            
            <label for = "login_name">รหัสผ่าน</label><br>
            <input id = "login_pass" type = "password" name = "login_pass"><br>
            </div>
            <input class = "login" type = "submit" value = "> เข้าสู่ระบบ <">
        </form><br><br><br><br><br>

        <form method = "post" action = "register.php" autocomplete = "off">
            <input class = "login" type = "submit" value = "> ลงทะเบียน <">
        </form></center>
        <?php } ?>

        <footer>
            <a class = "footerlink" href="http://www.triamudom.ac.th">โรงเรียนเตรียมอุดมศึกษา</a>
        </footer>
    </body>
</html>