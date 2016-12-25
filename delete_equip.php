<?php
include "mysqli_connect.inc.php";
$equip_ID        =$_POST["equip_ID"];

//$query = ("Delete FROM equipment WHERE equip_ID=?");
$stmt = $db->prepare("Delete FROM equipment WHERE equip_ID='$equip_ID'");
$stmt->bind_param('i',$equip_ID);
$stmt->execute();


echo "<table border='1'>
<tr>
<th>編號</th>
<th>名稱</th>
<th>數量</th>
<th>日期</th>
</tr>";

$query2="SELECT * FROM equipment";
	if($stmt=$db->query($query2)){
		while($result=mysqli_fetch_object($stmt)){
		echo "<tr>";
		echo "<td>".$result->equip_ID."</td>";
		echo "<td>".$result->equip_name."</td>";
		echo "<td>".$result->equip_quantity."</td>";
		echo "<td>".$result->equip_date."</td>";
		echo "<tr>";
		}
	}
	
	echo "</table>";

?>