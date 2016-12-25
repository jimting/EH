<?php session_start(); ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
include("mysqli_connect.inc.php");

$user_ID = $_SESSION['user_ID'];
$equip_ID = $_POST['equip_ID'];
$lend_equip_quan = $_POST['howmany'];
$lend_date = $_POST['startdays'];
$lend_days = $_POST['days'];
$sql1 = "SELECT * FROM equipment WHERE equip_ID = $equip_ID";
$stmt = $db->query($sql1);
$result1=mysqli_fetch_object($stmt);
if($equip_ID < $result1->equip_quantity)//如果要借的數量 < 庫存數量
{
	$temp = $result1->equip_quantity - $lend_equip_quan;//原本數量 - 借出數量

	$query1 = "INSERT INTO lend_equip (user_ID, equip_ID,lend_equip_quan,lend_date,lend_days) values ('$user_ID', '$equip_ID','$lend_equip_quan','$lend_date','$lend_days')";
	$query2 = "SELECT * FROM lend_equip WHERE lend_equip_ID > 0";
	$query3 = "UPDATE equipment SET equip_quantity='$temp' where equip_ID='$equip_ID'";
	mysqli_query($db,$query1); //執行$query1 將輸入資訊更新到lend-equip的table
	mysqli_query($db,$query3); //更新借出後剩下的數量
	echo '預借器材成功囉！記得要到課指組找老師確認哦！';
}
else 
{
	echo'您輸入太多了，請確認後重新輸入';//要借的數量太多 不夠借
}
?>