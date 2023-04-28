<?php
session_start();
include "../db.php";
$tax=$_POST['tax'];
$date=$_SESSION["shopping_heads"]['date'];
$areacode=$_SESSION["shopping_heads"]['area'];
$customercode=$_SESSION["shopping_heads"]['customer'];
$salemancode=$_SESSION["shopping_heads"]['saleman'];
$vid=$_SESSION["shopping_heads"]['vid'];

$row=$dbpdo->query("SELECT name from customers where id='$customercode'")->fetch(PDO::FETCH_NUM);
$customer=$row[0];

if($vid>0)
{

$q1="SELECT productcode,batchno,expdate,mrp,quantity,bonus from saledetail where tableid='$vid'";
$s1=$dbpdo->prepare($q1);
$s1->execute();
while($row1 = $s1->fetch(PDO::FETCH_BOTH)) {
$productcode=$row1[0];
$batchno=$row1[1];
$expdate=$row1[2];
$mrp=$row1[3];
$qty=$row1[4];
if(!$qty) $qty=0;
$bonus=$row1[5];
if(empty($bonus)) $bonus=0;
$qty=$qty+$bonus;

$q="SELECT id,inhand from stockdetail where productcode='$productcode'  and batchno='$batchno' and mrp=$mrp and expdate='$expdate'";
  $s=$dbpdo->prepare($q);
$s->execute();
$row = $s->fetch(PDO::FETCH_BOTH);
$pinhand=$row[1];
$did=$row[0];
$pinhand=$pinhand+$qty;
$q="update stockdetail set inhand='$pinhand' where id='$did'";
$s=$dbpdo->prepare($q);
$s->execute();
}

$q="delete from payments where accounthead='sale' and tid='$vid'";
$stmt = $dbpdo->prepare($q);
$stmt->execute();
$q="delete from saledetail where tableid='$vid'";
$stmt = $dbpdo->prepare($q);
$stmt->execute();
$q="delete from sale where id='$vid'";
$stmt = $dbpdo->prepare($q);
$stmt->execute();
$saleid=$vid;
}
else
{
$row=$dbpdo->query("SELECT max(id) from sale")->fetch(PDO::FETCH_NUM);
$saleid=$row[0]+1;
}
$user=$_SESSION['karlu-user'];
$q="INSERT INTO `sale` (`id`, `date`, `areacode`, `customercode`, `salemancode`, `gamount`, `tax`, `user`, `pid`) VALUES ('$saleid', '$date', '$areacode', '$customercode', '$salemancode', 0, 0, '$user',0)";

$stmt = $dbpdo->prepare($q);
$stmt->execute();

	$gtotal=0;
	foreach($_SESSION["shopping_cart"] as $keys => $values)
	{


$productcode=$values['product'];
		$packingcode=null;
		$bclaim=$values['bclaim'];
		$batchno=$values['batch'];
		$expdate=$values['expdate'];
		$dclaim=$values['dclaim'];
		$qty=$values['qty'];
		if(!$qty) $qty=0;
		$bonus=$values['bqty'];
		if(!$bonus) $bonus=0;
		$subamount=round($values['subamount'],2);
		$totalamount=round($values['totalamount'],2);
		$mrp=$values['mrp'];
		$tp=round($values['srate'],2);
		$srate=round($values['srate'],2);
		if(!empty($values['discount']))
		$dis1=round($values['discount'],2); else $dis1=null;
	if(!empty($values['gst']))
		$gst=round($values['gst'],2); else $gst=null;
	if(!empty($values['extra']))
		$extra=round($values['extra'],2); else $extra=null;
		$netrate=$values['netrate'];
		$gtotal+=round($totalamount,2);
		if(empty($bonus)) $bonus=0;		
		$tqty=$qty+$bonus;		

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


		if(!$dis1) $dis1=0;
			if(!$bclaim) $bclaim=0;
			if(!$gst) $gst=0;
			if(!$extra) $extra=0;
				if(!$dclaim) $dclaim=0;
$q="INSERT INTO `saledetail` (`id`, `tableid`, `productcode`,  `batchno`, `expdate`, `quantity`, `bonus`, `subamount`, `totalamount`, `mrp`, `tp`, `dis1`,`bclaim`,`gst`,`extra`,`dclaim`) VALUES (NULL, '$saleid', '$productcode', '$batchno', '$expdate', '$qty', '$bonus', '$subamount', '$totalamount', '$mrp', '$srate', '$dis1','$bclaim','$gst','$extra','$dclaim')";
$stmt = $dbpdo->prepare($q);
$stmt->execute();
}
if($tax)
$grand=$gtotal+$gtotal*$tax/100;
else
$grand=$gtotal;
$grand=round($grand);

$row=$dbpdo->query("SELECT max(id) from payments")->fetch(PDO::FETCH_NUM);
$pid=$row[0]+1;

$description="sale to ".$customer;

$q="INSERT INTO `payments` (`id`, `date`, `accounthead`, `cid`, `paymentmode`, `tid`, `description`, `debit`, `credit`) VALUES ('$pid','$date','sale','$customercode','1' ,'$saleid', '$description',null,'$grand')";

$stmt = $dbpdo->prepare($q);
$stmt->execute();





$q="update `sale` set gamount='$grand',`tax`='$tax',pid='$pid' where id='$saleid'";
$stmt = $dbpdo->prepare($q);
$stmt->execute();
echo $saleid;

						?>