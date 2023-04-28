<?php 
if(!empty($_GET['code']))
{
$code=$_GET['code'];

include "db.php";
include "include/header.php";
date_default_timezone_set("Asia/Karachi");
$q="select productcode ,batchno,expdate,mrp,sum(quantity)+sum(bonus),sum(inhand) from stockdetail where productcode='$code' group by productcode,batchno order by productcode";
$s=$dbpdo->prepare($q);
$s->execute();
while($row=$s->fetch(PDO::FETCH_BOTH))
{
	$pcode=$row[0];
	$batchno=$row[1];
	$expdate=$row[2];
	$mrp=$row[3];
	$purchase=$row[4];

	$inhand=$row[5];
	$tp=$purchase;

$qt="SELECT sum(quantity)+sum(bonus) from saledetail where productcode='$pcode' and batchno='$batchno' and expdate='$expdate' and mrp='$mrp' group by productcode,batchno";
	$row1=$dbpdo->query("SELECT sum(quantity)+sum(bonus) from saledetail where productcode='$pcode' and batchno='$batchno' and expdate='$expdate' and mrp='$mrp'")->fetch(PDO::FETCH_NUM);
	$sale=$row1[0];
	$baki=$tp-$sale;
	
	echo "$pcode $batchno $expdate $mrp   purchase=$tp sale=$sale  inhand=$inhand baki=$baki<br>";

	// $cc=$dbpdo->prepare("update stockdetail set inhand='$baki'  where productcode='$pcode' and batchno='$batchno' and expdate='$expdate' and mrp='$mrp'");
	// $cc->execute();



}

}

?>

