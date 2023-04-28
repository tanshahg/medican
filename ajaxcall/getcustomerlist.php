<?php 
session_start();
include "../db.php";
$id=$_POST['id'];
$q="select id,name from `customers` where customertype='$id'";
$stmt1 = $dbpdo->prepare($q);
$stmt1->execute();
$data="<option value=''>Select Client</option>";
while($row = $stmt1->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_NEXT))
{
	$data.="<option value='$row[0]'>$row[1] --($row[0])</option>";
}
echo $data;
	
?>