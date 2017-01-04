<?php session_start(); ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
include("mysqli_connect.inc.php");
$id = $_GET['id'];

if($_SESSION['user_number'] != null)
{
        //刪除資料庫資料語法
        $sql = "delete from user where user_id='$id'";
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