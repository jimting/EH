<?php session_start(); ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
include("mysqli_connect.inc.php");

$user_ID =$_SESSION['user_ID'];
$user_number = $_POST['user_number'];
$user_pw = $_POST['user_pw'];
$user_pw2 = $_POST['user_pw2'];
$user_nickname = $_POST['user_nickname'];
$user_email = $_POST['user_email'];
$user_department = $_POST['user_department'];
$user_phone = $_POST['user_phone'];

//紅色字體為判斷密碼是否填寫正確
if($_SESSION['user_ID'] != null && $user_pw != null && $user_pw2 != null && $user_pw == $user_pw2)
{
        //更新資料庫資料語法
        $sql = "update user set user_pw='$user_pw', user_nickname='$user_nickname', user_email='$user_email', user_phone='$user_phone', user_department='$user_department' where user_id='$user_ID'";
        if(mysqli_query($db,$sql))
        {
                echo '<meta http-equiv=REFRESH CONTENT=0;url=users.php>';
        }
        else
        {
                echo '<meta http-equiv=REFRESH CONTENT=0;url=users.php>';
        }
}
else
{
        echo '您無權限觀看此頁面!';
        echo '<meta http-equiv=REFRESH CONTENT=2;url=../login.html>';
}
?>