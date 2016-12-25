<?php session_start(); ?>
<!--上方語法為啟用session，此語法要放在網頁最前方-->
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="Style.css" type="text/css" media="screen" />
<link rel="stylesheet" href="login.css">
<?php
//連接資料庫
//只要此頁面上有用到連接MySQL就要include它
include("mysqli_connect.inc.php");
$id = $_POST['id'];
$pw = $_POST['pw'];

//搜尋資料庫資料
$sql = "SELECT * FROM user where user_number = '$id'";
$stmt = $db->query($sql);
$result=mysqli_fetch_object($stmt);


//判斷帳號與密碼是否為空白
//以及MySQL資料庫裡是否有這個會員
if($result != null && $result->user_number == $id && $result->user_pw == $pw && $result->user_level == 5)
{
        //將帳號寫入session，方便驗證使用者身份
        $_SESSION['user_number'] = $id;
		$_SESSION['user_nickname'] = $result->user_nickname;
		$_SESSION['user_department'] = $result->user_department;
		$_SESSION['user_date'] = $result->user_date;
		$_SESSION['user_ID'] = $result->user_ID;
		
		//user_number, user_pw,user_nickname,user_email,user_department,user_phone,user_date
        echo '<div class="login"><h1>登入成功囉！<h1><br><h1>前進首頁！</h1></div>';
        echo '<meta http-equiv=REFRESH CONTENT=3;url=teacher.html>';
}
else
{
		echo '<div class="login"><h1>登入失敗！<h1><br><h1>請確定帳密是否正確</h1><br><h1>轉跳到登入頁面！</h1></div>';
        echo '<meta http-equiv=REFRESH CONTENT=3;url=admin.html>';
}
?>