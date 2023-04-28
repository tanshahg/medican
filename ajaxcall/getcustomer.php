<?php 
session_start();
include "../db.php";
$code=$_POST['code'];
$cashpaid=$_POST['cash'];
$q="select * from `salevoucher` where id='$code'";
$stmt1 = $dbpdo->prepare($q);
$stmt1->execute();
$row1 = $stmt1->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_NEXT);
$cid=$row1[2];
$date=$row1[1];
$cname=$row1[4];
$con=$row1[5];
$con=$row1[5];
$credit=$row1[6];
if($credit==1)
{

$_SESSION["cashpaid"]=$cashpaid;
}	
$q="select * from `randomsale` where customerid='$cid'";
$stmt1 = $dbpdo->prepare($q);
$stmt1->execute();
while($row1 = $stmt1->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_NEXT))
{
	$pcode=$row1[2];
	$pname=$row1[3];
	$qty=$row1[4];
	$price=$row1[5];
	
$item_array = array(
					'customerid'               =>     $cid,  
					'itemcode'             =>     $pcode,  
					'itemname'         =>     $pname,
					'qty'         =>          $qty,
					'price'         =>          $price,
					'date'         =>          $date,
					'cname'         =>          $cname,
					'concession'         =>          $con,

				);
				$_SESSION["shopping_cart"][] = $item_array;
			
}
include "maketable.php";
?>