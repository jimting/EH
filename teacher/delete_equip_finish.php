<?php
	session_start();
	include("mysqli_connect.inc.php");
	
	if($_SESSION['user_ID'] != null)
	{
		$equip_ID = $_POST['equip_ID'];											
		$sql = "SELECT * FROM lend_equip WHERE equip_ID = '$equip_ID'";//找出包含此器材的借據
		if($stmt = $db->query($sql))
		{
			while($result=mysqli_fetch_object($stmt))
			{
				$temp_lend_ID = $result->lend_equip_ID;
				$query2 = "DELETE FROM lend_equip WHERE lend_equip_ID = '$temp_lend_ID'";//刪除每筆含這個器材的借據 
				mysqli_query($db,$query2);
			}
		}
		$query2 = "DELETE FROM equipment WHERE equip_ID = '$equip_ID'";//刪除器材 
		mysqli_query($db,$query2);
		echo '刪除器材成功囉！';
	}
?>