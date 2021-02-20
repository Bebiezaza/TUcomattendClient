<?php
//register failed function
    function registerFailed($conn, $text)
    {
?>
        <div class = 'login'>
            ลงทะเบียนไม่สำเร็จ <br> 
<?php
            echo $text;
?>
        </div>

        <form>
            <input class = "login_fail" type = "submit" value = "> กลับไปลงทะเบียนใหม่ <">
        </form>
<?php
        //sql disconnect
        mysqli_close($conn);

        die;
    }

//register write to table
    function registerWrite($conn, $sql, $fail)
    {
        if (!mysqli_query($conn, $sql))
        {
            registerFailed($conn, $fail);
        }
        else
        {
            echo "<div class = 'login'>ลงทะเบียนสำเร็จ</div>";
?>
            <form method = post action = "index.php">
                <input class = "login" type = "submit" value = "> กลับสู่หน้าหลัก <">
            </form>
<?php
            //sql disconnect
            mysqli_close($conn);
        }
    }

//option loop
    function optionLoop($startNum, $lastNum)
    {
        for($i = $startNum; $i <= $lastNum; $i++)
        {
            if (strlen($i) == 1)
            {
                $j = "0" . $i;
            }
            else
            {
                $j = $i;
            }
            
            echo "<option value=" . $j . ">" . $j . "</option>";
        }
    }
?>