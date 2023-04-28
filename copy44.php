<?php 
include "db.php";
include "include/header.php";
date_default_timezone_set("Asia/Karachi");
$date=date("Y-m-d");


$q="SELECT * FROM `fakesale` where `f2`='R'";
$s=$dbpdo->prepare($q);
$s->execute();
$cnt=0;
while($row = $s->fetch(PDO::FETCH_BOTH)){
$id=$row[0];
$stockid=$row[0];
$scode=$row[14];
$date11=explode("-",trim($row[2]));
$date22="20".$date11[2]."-".$date11[1]."-".$date11[0];
$date=date("Y-m-d",strtotime(trim($date22)));
if($date=="1970-01-01") { echo $date=$date22;}
$areaid=$row[13];
$row11=$dbpdo->query("SELECT sno FROM `ariainfo` where ariaid='$areaid'")->fetch(PDO::FETCH_NUM);
$area=$row11[0];
$saleman=$row[15];
$submaount=abs($row[16]);
$tax=$row[18];
$gamount=abs($row[19]);
$user="admin";

$row11=$dbpdo->query("SELECT name from customers where id='$scode'")->fetch(PDO::FETCH_NUM);
$customer=$row11[0];

$row11=$dbpdo->query("SELECT max(id) from payments")->fetch(PDO::FETCH_NUM);
$paid=$row11[0]+1;
$description="Sale Return from ".$customer;

$q22="INSERT INTO `payments` (`id`, `date`, `accounthead`, `cid`, `paymentmode`, `tid`, `description`, `debit`, `credit`) VALUES ('$paid','$date','sale','$scode','1' ,'$stockid', '$description','$gamount', null)";
$stmt22 = $dbpdo->prepare($q22);
$stmt22->execute();

$q22="INSERT INTO `salereturn` (`id`, `date`, `areacode`, `customercode`, `salemancode`, `gamount`, `tax`, `user`, `pid`) VALUES ('$stockid', '$date', '$area', '$scode', '$saleman', '$gamount','$tax','$user','$paid')";
$stmt22 = $dbpdo->prepare($q22);
$stmt22->execute();



$s1=$dbpdo->prepare("SELECT *  FROM `fakdetail` WHERE `f2` LIKE '$stockid'");
$s1->execute();
$n=$s1->rowcount();
if($n)
{

while($row1 = $s1->fetch(PDO::FETCH_BOTH)){	
		$productcode=$row1[3];
		$packingcode=null;
		$batchno=$row1[4];
		$date1=explode("-",trim($row1[5]));
		$dd=$date1[0];
		$mm=$date1[1];
		$yy="20".$date1[2];
		switch($mm)
		{
			case 'Jan':
			$mm=1;
			break;
			case 'Feb':
			$mm=2;
			break;
			case 'Mar':
			$mm=3;
			break;
			case 'Apr':
			$mm=4;
			break;
			case 'May':
			$mm=5;
			break;
			case 'Jun':
			$mm=6;
			break;
			case 'Jul':
			$mm=7;
			break;
			case 'Aug':
			$mm=8;
			break;
			case 'Sep':
			$mm=9;
			break;
			case 'Oct':
			$mm=10;
			break;
			case 'Nov':
			$mm=11;
			break;
			case 'Dec':
			$mm=12;
			break;
			default:
			$mm=1;
		}

		$date2=$yy."-".$mm."-".$dd;
		$expdate=date("Y-m-d",strtotime($date2));
		$mrp=$row1[6];
		$qty=abs($row1[7]);
		$bonus=$row1[8];
		$tp=$row1[9];
		$netrate=$row1[10];
		$subamount=abs($row1[12]);
		$dis1=$row1[14];
		$dis2=$row1[15];
		$totalamount=abs($row1[17]);
		if(empty($bonus)) $bonus=0;
		$inhand=$qty+$bonus;

		
$q23="INSERT INTO `salereturndetail` (`id`, `tableid`, `productcode`, `packingcode`, `batchno`, `expdate`, `quantity`, `bonus`, `subamount`, `totalamount`, `mrp`, `tp`, `dis1`, `gst`, `netrate`, `extra`, `bclaim`, `dclaim`) VALUES (NULL, '$stockid', '$productcode', null, '$batchno', '$expdate', '$qty', '$bonus', '$subamount', '$totalamount', '$mrp', '$tp', '$dis1', null, '$netrate',null,null,null)";
$stmt23 = $dbpdo->prepare($q23);
$stmt23->execute();
}
}


}

echo "done";
  
?>