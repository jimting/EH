<?php

include "mysqli_connect.inc.php";
$room_name        =$_POST["room_name"];

$stmt = $db->prepare('Delete FROM classroom WHERE room_name=?');
$stmt->bind_param('s',$room_name);
$stmt->execute();


echo "<table border='1'>
<tr>
<th>編號</th>
<th>名稱</th>
<th>狀態</th>
<th>日期</th>
</tr>";

$query2="SELECT * FROM classroom";
	if($stmt=$db->query($query2)){
		while($result=mysqli_fetch_object($stmt)){
		echo "<tr>";
		echo "<td>".$result->room_ID."</td>";
		echo "<td>".$result->room_name."</td>";
		echo "<td>".$result->room_status."</td>";
		echo "<td>".$result->room_date."</td>";
		echo "<tr>";
		}
	}
	
	echo "</table>";

?>