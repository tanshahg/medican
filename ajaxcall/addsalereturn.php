<?php
session_start();
include "../db.php";
$tax=$_POST['tax'];
$date=$_SESSION["shopping_heads"]['date'];
$areacode=$_SESSION["shopping_heads"]['area'];
$customercode=$_SESSION["shopping_heads"]['customer'];
$salemancode=$_SESSION["shopping_heads"]['saleman'];

$row=$dbpdo->query("SELECT name from customers where id='$customercode'")->fetch(PDO::FETCH_NUM);
$customer=$row[0];

$row=$dbpdo->query("SELECT max(id) from salereturn")->fetch(PDO::FETCH_NUM);
$saleid=$row[0]+1;
$user=$_SESSION['karlu-user'];
$q="INSERT INTO `salereturn` (`id`, `date`, `areacode`, `customercode`, `salemancode`, `gamount`, `tax`, `user`, `pid`) VALUES ('$saleid', '$date', '$areacode', '$customercode', '$salemancode', 0, 0, '$user',0)";

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
		$bonus=$values['bqty'];
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

$q="SELECT id,inhand from stockdetail where productcode='$productcode'  and batchno='$batchno' and mrp='$mrp' ";
$s=$dbpdo->prepare($q);
$s->execute();
$row = $s->fetch(PDO::FETCH_BOTH);
$id=$row[0];
$inhand=$row[1];
$inhand+=$tqty;
$q1="update stockdetail set inhand='$inhand' where id='$id'";
$s1=$dbpdo->prepare($q1);
$s1->execute();

		
$q="INSERT INTO `salereturndetail` (`id`, `tableid`, `productcode`,  `batchno`, `expdate`, `quantity`, `bonus`, `subamount`, `totalamount`, `mrp`, `tp`, `dis1`,`bclaim`,`gst`,`extra`,`dclaim`) VALUES (NULL, '$saleid', '$productcode', '$batchno', '$expdate', '$qty', '$bonus', '$subamount', '$totalamount', '$mrp', '$srate', '$dis1','$bclaim','$gst','$extra','$dclaim')";
$stmt = $dbpdo->prepare($q);
$stmt->execute();
}
if($tax)
$grand=$gtotal+$tax;
else
$grand=$gtotal;
$grand=round($grand);

$row=$dbpdo->query("SELECT max(id) from payments")->fetch(PDO::FETCH_NUM);
$pid=$row[0]+1;

$description="sale to ".$customer;

$q="INSERT INTO `payments` (`id`, `date`, `accounthead`, `cid`, `paymentmode`, `tid`, `description`, `debit`, `credit`) VALUES ('$pid','$date','sale','$customercode','1' ,'$saleid', '$description','$grand',null)";

$stmt = $dbpdo->prepare($q);
$stmt->execute();
$q="update `salereturn` set gamount='$gtotal',`tax`='$tax',pid='$pid' where id='$saleid'";
$stmt = $dbpdo->prepare($q);
$stmt->execute();
echo $saleid;

						?>