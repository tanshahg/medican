<?php 
session_start();
include "../db.php";
$cid=$_POST['cid'];
$aid=$_POST['aid'];
$sid=$_POST['sid'];
$q="select distinct a.productcode,b.name from `saledetail` as a, products as b,sale as c where a.productcode=b.id and c.customercode='$cid' and c.salemancode=$sid and c.areacode=$aid and a.productcode=b.id";
$stmt1 = $dbpdo->prepare($q);
$stmt1->execute();
$data="<option value=''>Select product</option>";
while($row = $stmt1->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_NEXT))
{
	$data.="<option value='$row[0]'>$row[1]</option>";
}
echo $data;
	
?>