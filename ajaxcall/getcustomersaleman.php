<?php 
session_start();
include "../db.php";
$cid=$_POST['cid'];
$q="select distinct a.salemancode,b.name from `sale` as a, customers as b where a.salemancode=b.id ";
$stmt1 = $dbpdo->prepare($q);
$stmt1->execute();
$data="<option value=''>Select Saleman</option>";
while($row = $stmt1->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_NEXT))
{
	$data.="<option value='$row[0]'>$row[1]</option>";
}
echo $data;


	
?>