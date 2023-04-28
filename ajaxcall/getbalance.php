<?php 
session_start();
include "../db.php";
$cid=$_POST['cid'];
$q="select sum(debit) as sum1 ,sum(credit) as sum2 from `payments` where cid='$cid'";
$stmt1 = $dbpdo->prepare($q);
$stmt1->execute();
$row = $stmt1->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_NEXT);
$b=$row[0]-$row[1];
if($b<0) $b="Account Receivable Amount ".abs($b);
else
$b="Account Payble Amount ".abs($b);
	echo $b;
?>