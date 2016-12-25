<?php
include "mysqli_connect.inc.php";
$equip_name      =$_POST["equip_name"];
$equip_quantity  =$_POST["equip_quantity"];
$equip_date      =$_POST["equip_date"];

$query = ("insert into t1 value(?,?,?)");
$stmt = $db->prepare($query);
$stmt->bind_param('isis',$equip_name,$equip_quantity,$equip_date);
$stmt->execute();
var_dump(param_name);

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