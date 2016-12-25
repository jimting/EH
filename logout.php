<?php session_start(); ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="Style.css" type="text/css" media="screen" />
<link rel="stylesheet" href="login.css">
<?php
//將session清空
unset($_SESSION['user_number']);
echo '<div class="login"><h1>登出！<h1><br><h1>轉跳到登入頁面！</h1></div>';
echo '<meta http-equiv=REFRESH CONTENT=1;url=login.html>';
?>