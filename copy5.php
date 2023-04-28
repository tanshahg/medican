<?php 
include "db.php";
include "include/header.php";
date_default_timezone_set("Asia/Karachi");
$date=date("Y-m-d");
$q="select * from sale";
$s=$dbpdo->prepare($q);
$s->execute();
$cnt=0;
while($row = $s->fetch(PDO::FETCH_BOTH)){
$tax=$row[6];
$date=$row[1];
$customercode=$row[3];
$rowss=$dbpdo->query("SELECT name from customers where id='$customercode'")->fetch(PDO::FETCH_NUM);
$customer=$rowss[0];
$salemancode=$row[4];
$saleid=$row[0];
$row11=$dbpdo->query("SELECT sum(totalamount) FROM `saledetail` WHERE `saleid` = $saleid")->fetch(PDO::FETCH_NUM);
$total=round($row11[0]);
if($total) {
$rowx=$dbpdo->query("SELECT max(id) from payments")->fetch(PDO::FETCH_NUM);
$paid=$rowx[0]+1;
$description="sale to ".$customer;
$q1="INSERT INTO `payments` (`id`, `date`, `accounthead`, `cid`, `paymentmode`, `tid`, `description`, `debit`, `credit`) VALUES ('$paid','$date','sale','$customercode','1' ,'$saleid', '$description',null,'$total')";
$stmt1 = $dbpdo->prepare($q1);
$stmt1->execute();
}
}
echo "Done";
 
?>