<?php 
session_start();
include "../db.php";
$aid=$_POST['aid'];
$q="select a.id,a.name from `customers` as a ,sale as b  where a.id=b.customercode and customertype='1' and area='$aid'";


$stmt1 = $dbpdo->prepare($q);
$stmt1->execute();
$data="<option value=''>Select Customer</option>";
while($row = $stmt1->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_NEXT))
{
	$data.="<option value='$row[0]'>$row[1] --($row[0])</option>";
}
echo $data;


	
?>