<?php 
include "db.php";
include "include/header.php";
date_default_timezone_set("Asia/Karachi");
$sdate=date("Y-m-d",strtotime("2022-08-01"));
$edate=date("Y-m-d",strtotime("2022-08-31"));
$q="SELECT a.productcode,a.quantity,a.tp,b.date,b.tax from saledetail as a ,sale as b  where b.date between date_sub(now(),INTERVAL 1 WEEK) and now() and a.tableid=b.id";
$s=$dbpdo->prepare($q);
$s->execute();
$profit=0;
while($row = $s->fetch(PDO::FETCH_BOTH)){
	$productcode=$row[0];
	$qty=$row[1];
	$tp=$row[2];
	$sdate=$row[3];
	$tax=$row[4];
	$amount=$qty*$tp;
	$amount=$amount+$amount*$tax/100;
	$samount=round($amount,2);
	
	$q1="SELECT a.tp,a.dis1,quantity from stockdetail as a ,stock as b  where a.tableid=b.id and b.date<='$sdate' and a.productcode='$productcode' order by b.date DESC limit 1";
	$s1=$dbpdo->prepare($q1);
	$s1->execute();
	$row1 = $s1->fetch(PDO::FETCH_BOTH);
	$tp1=$row1[0];
	$dis=$row1[1];
	$pqty=$row1[2];
	$unitprice=$tp1;
	if($dis>0)
	{
		if(strlen($dis)==1) {  $dis=$tp1*$dis/100; }
		else
		{
			
			$dis=$dis/$pqty;
			

		}
		$unitprice=$tp-$dis;
		
	}
	
	$pamount=$unitprice*$qty;
	$profit+=$samount-$pamount;

	
	}

	


?>
