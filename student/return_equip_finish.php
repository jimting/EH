<?php session_start(); ?>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link rel="stylesheet" href="../css/bootstrap.min.css">
		<script src="../js/jquery.js"></script>
		<script src="../js/bootstrap.js"></script>
	</head>
	<body>
		<?php
			include("mysqli_connect.inc.php");
			if($_SESSION['user_ID'] != null)
			{
				$user_ID = $_SESSION['user_ID'];
				$lend_equip_ID = $_POST['lend_equip_ID'];													
				$sql1 = "SELECT * FROM lend_equip WHERE lend_equip_ID = '$lend_equip_ID'";//找出選擇的借據
				$stmt = $db->query($sql1);
				$result1=mysqli_fetch_object($stmt);


				$sql2 = "SELECT * FROM equipment WHERE equip_ID = '$result1->equip_ID'";//找原本庫存
					$stmt = $db->query($sql2);
					$result2=mysqli_fetch_object($stmt);

				$temp = $result2->equip_quantity + $result1->lend_equip_quan;//原本數量 + 歸還數量
				$query1 = "UPDATE equipment SET equip_quantity='$temp' where equip_ID='$result1->equip_ID'";
				mysqli_query($db,$query1); //執行$query1 將資訊更新
				$query2 = "DELETE FROM lend_equip WHERE lend_equip_ID = '$lend_equip_ID'";//刪除借據 
				mysqli_query($db,$query2);//執行$query2 將資訊更新
				
				echo '歸還器材成功囉！';
			}
		?>
	</body>
</html>