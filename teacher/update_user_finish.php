<?php session_start(); ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
include("mysqli_connect.inc.php");

$user_ID = $_POST['user_ID'];
$user_pw = $_POST['user_pw'];
$user_pw2 = $_POST['user_pw2'];
$user_nickname = $_POST['user_nickname'];
$user_email = $_POST['user_email'];
$user_department = $_POST['user_department'];
$user_phone = $_POST['user_phone'];
$user_level = $_POST['user_level'];

$sql = "UPDATE user SET user_pw='$user_pw', user_nickname='$user_nickname', user_email='$user_email', user_phone='$user_phone', user_department='$user_department', user_level='$user_level' WHERE user_ID='$user_ID'";
mysqli_query($db,$sql);
?>