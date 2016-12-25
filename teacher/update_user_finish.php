<?php session_start(); ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
include("mysqli_connect.inc.php");

$id = $_POST['id'];
$pw = $_POST['pw'];
$pw2 = $_POST['pw2'];
$phone = $_POST['phone'];
$nickname = $_POST['nickname'];
$email = $_POST['email'];
$department = $_POST['department'];

//紅色字體為判斷密碼是否填寫正確
if($_SESSION['user_number'] != null && $pw != null && $pw2 != null && $pw == $pw2)
{
        $id = $_SESSION['user_number'];
    
        //更新資料庫資料語法
        $sql = "update user set user_pw='$pw', user_phone='$phone', user_email='$email', user_department='$department', user_nickname='$nickname' where user_number='$id'";
        if(mysqli_query($db,$sql))
        {
                echo '修改成功!';
                echo '<meta http-equiv=REFRESH CONTENT=2;url=member.php>';
        }
        else
        {
                echo '修改失敗!';
                echo '<meta http-equiv=REFRESH CONTENT=2;url=member.php>';
        }
}
else
{
        echo '您無權限觀看此頁面!';
        echo '<meta http-equiv=REFRESH CONTENT=2;url=member.php>';
}
?>