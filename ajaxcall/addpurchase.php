<?php
session_start();
include "../db.php";
$tax=$_POST['tax'];



$date=$_SESSION["shopping_heads"]['date'];
$scode=$_SESSION["shopping_heads"]['supplier'];
$conton=$_SESSION["shopping_heads"]['conton'];
$courier=$_SESSION["shopping_heads"]['courier'];
$courierno=$_SESSION["shopping_heads"]['courierno'];
$invoice=$_SESSION["shopping_heads"]['invoice'];
$refdate=$_SESSION["shopping_heads"]['refdate'];
$page=$_SESSION["shopping_heads"]['page'];
$vid=$_SESSION["shopping_heads"]['vid'];

$user=$_SESSION['karlu-user'];

$row=$dbpdo->query("SELECT name from customers where id='$scode'")->fetch(PDO::FETCH_NUM);
$compnay=$row[0];
if($vid>0)
{
$q="delete from payments where accounthead='stock' and tid='$vid'";
$stmt = $dbpdo->prepare($q);
$stmt->execute();

$q="delete from stockdetail where tableid='$vid'";
$stmt = $dbpdo->prepare($q);
$stmt->execute();
$q="delete from stock where id='$vid'";
$stmt = $dbpdo->prepare($q);
$stmt->execute();
$stockid=$vid;
}
else {
$row=$dbpdo->query("SELECT max(id) from stock")->fetch(PDO::FETCH_NUM);
$stockid=$row[0]+1;
}
$q="INSERT INTO `stock` (`id`, `date`, `scode`, `conton`, `courier`, `courierno`, `invoice`, `refdate`, `page`,`gamount`,`tax`,`user`,`pid`) VALUES ('$stockid', '$date', '$scode', '$conton', '$courier', '$courierno', '$invoice', '$refdate','$page','0','0','$user',0)";

$stmt = $dbpdo->prepare($q);
$stmt->execute();

	$gtotal=0;
	foreach($_SESSION["shopping_cart"] as $keys => $values)
	{
		
		$productcode=$values['pname'];
		$packingcode=null;
		$batchno=$values['bno'];
		$expdate=$values['expdate'];
		$qty=$values['qty'];
		$bonus=$values['bonus'];
		$subamount=round($values['subamount'],2);
		$totalamount=round($values['totalamount'],2);
		$mrp=$values['mrp'];
		$tp=round($values['tpamount'],2);
		$dis1=round($values['dis1'],2);
		$gst=round($values['gst'],2);
		$extra=round($values['extra'],2);
		$netrate=$values['netrate'];
		$gtotal+=round($totalamount,2);
		if(empty($bonus)) $bonus=0;
		$inhand=$qty+$bonus;

		
$q="INSERT INTO `stockdetail` (`id`, `tableid`, `productcode`, `packingcode`, `batchno`, `expdate`, `quantity`, `bonus`, `subamount`, `totalamount`, `mrp`, `tp`, `dis1`, `gst`,`extra`,`netrate`,`inhand`) VALUES (NULL, '$stockid', '$productcode', '$packingcode', '$batchno', '$expdate', '$qty', '$bonus', '$subamount', '$totalamount', '$mrp', '$tp', '$dis1', '$gst','$extra','$netrate','$inhand')";
$stmt = $dbpdo->prepare($q);
$stmt->execute();
}
if($tax)
$grand=round($gtotal+$tax);
else
$grand=round($gtotal);

$row=$dbpdo->query("SELECT max(id) from payments")->fetch(PDO::FETCH_NUM);
$pid=$row[0]+1;
$description="Purchase from ".$compnay;

$q="INSERT INTO `payments` (`id`, `date`, `accounthead`, `cid`, `paymentmode`, `tid`, `description`, `debit`, `credit`) VALUES ('$pid','$date','stock','$scode','1' ,'$stockid', '$description','$grand', null)";

$stmt = $dbpdo->prepare($q);
$stmt->execute();


$q="update `stock` set gamount='$gtotal',`tax`='$tax',pid='$pid' where id='$stockid'";
$stmt = $dbpdo->prepare($q);
$stmt->execute();
echo $stockid;

						?>