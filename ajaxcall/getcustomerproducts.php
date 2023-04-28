<?php 
session_start();
include "../db.php";
$cid=$_POST['cid'];
$q="SELECT b.productcode,c.name
FROM `sale` as a, saledetail as b ,products as c 
where a.customercode='$cid' and a.id=b.tableid and c.id=b.productcode order by c.name";
$stmt1 = $dbpdo->prepare($q);
$stmt1->execute();
$data="<option value='0' selected>Select All Products</option>";
while($row = $stmt1->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_NEXT))
{
	$data.="<option value='$row[0]'>$row[1] --($row[0])</option>";
}
echo $data;


	
?>