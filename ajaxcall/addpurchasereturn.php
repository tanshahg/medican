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
$row=$dbpdo->query("SELECT max(id) from stockreturn")->fetch(PDO::FETCH_NUM);
$stockid=$row[0]+1;
$user=$_SESSION['karlu-user'];

$row=$dbpdo->query("SELECT name from customers where id='$scode'")->fetch(PDO::FETCH_NUM);
$compnay=$row[0];
$q="INSERT INTO `stockreturn` (`id`, `date`, `scode`, `conton`, `courier`, `courierno`, `invoice`, `refdate`, `page`,`gamount`,`tax`,`user`,`pid`) VALUES ('$stockid', '$date', '$scode', '$conton', '$courier', '$courierno', '$invoice', '$refdate','$page','0','0','$user',0)";

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

$q="INSERT INTO `stockreturndetail` (`id`, `tableid`, `productcode`, `packingcode`, `batchno`, `expdate`, `quantity`, `bonus`, `subamount`, `totalamount`, `mrp`, `tp`, `dis1`, `gst`,`extra`,`netrate`,`inhand`) VALUES (NULL, '$stockid', '$productcode', '$packingcode', '$batchno', '$expdate', '$qty', '$bonus', '$subamount', '$subamount', '$mrp', '$tp', '$dis1', '$gst','$extra','$netrate','$inhand')";
$stmt = $dbpdo->prepare($q);
$stmt->execute();


$tqty=$inhand;    

$q="SELECT id,inhand from stockdetail where productcode='$productcode'  and batchno='$batchno' and mrp='$mrp' and expdate='$expdate' and inhand>0 order  by expdate,tableid";
  $s=$dbpdo->prepare($q);
$s->execute();
while($row = $s->fetch(PDO::FETCH_BOTH)){
	$id=$row[0];
if($tqty>0)
{

if($row[1]<$tqty)
{
	$majood=$row[1];
	$q1="update stockdetail set inhand=0 where id='$id'";
 	$s1=$dbpdo->prepare($q1);
	$s1->execute();
	$tqty-=$majood;
	continue;
}
if($row[1]>=$tqty)
{

	$majood=$row[1]-$tqty;
	$q1="update stockdetail set inhand='$majood' where id='$id'";
 	$s1=$dbpdo->prepare($q1);
	$s1->execute();
	break;
}

	}
	
}
}


if($tax)
$grand=round($gtotal+$tax);
else
$grand=round($gtotal);

$row=$dbpdo->query("SELECT max(id) from payments")->fetch(PDO::FETCH_NUM);
$pid=$row[0]+1;
$description="Purchase return to ".$compnay;

$q="INSERT INTO `payments` (`id`, `date`, `accounthead`, `cid`, `paymentmode`, `tid`, `description`, `debit`, `credit`) VALUES ('$pid','$date','stock-return','$scode','1' ,'$stockid', '$description', null,'$grand')";

$stmt = $dbpdo->prepare($q);
$stmt->execute();


$q="update `stockreturn` set gamount='$gtotal',`tax`='$tax',pid='$pid' where id='$stockid'";
$stmt = $dbpdo->prepare($q);
$stmt->execute();
echo $stockid;

						?>