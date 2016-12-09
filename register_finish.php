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

//判斷帳號密碼是否為空值
//確認密碼輸入的正確性
if($id != null && $pw != null && $pw2 != null && $pw == $pw2)
{
        //新增資料進資料庫語法
		$datetime = date ("Y-m-d H:i:s" , mktime(date('H')+8, date('i'), date('s'), date('m'), date('d'), date('Y'))) ; 
        $sql = "insert into user (user_number, user_pw,user_nickname,user_email,user_department,user_phone,user_date) values ('$id','$pw','$nickname','$email', '$department', '$phone', '$datetime')";
        if(mysqli_query($db,$sql))
        {
                echo '新增成功!';
                echo '<meta http-equiv=REFRESH CONTENT=3;url=login.html>';
        }
        else
        {
                echo '新增失敗!';
                echo '<meta http-equiv=REFRESH CONTENT=3;url=register.html>';
        }
}
else
{
        echo '您無權限觀看此頁面!';
        echo '<meta http-equiv=REFRESH CONTENT=2;url=login.html>';
}
?>