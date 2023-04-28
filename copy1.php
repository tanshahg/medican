<?php 
include "db.php";
include "include/header.php";
date_default_timezone_set("Asia/Karachi");
$date=date("Y-m-d");


$q="select * from fakecustomers";
$s=$dbpdo->prepare($q);
$s->execute();
while($row = $s->fetch(PDO::FETCH_BOTH)){
$f1=$row[0];
$f2=$row[1];
try {
    $q="SELECT f4 from fakeheads where id='$f1'";
$row1=$dbpdo->query("SELECT f4 from fakeheads where id='$f1'")->fetch(PDO::FETCH_NUM);
$f3=$row1[0];
}
catch (Exception $e) {
    echo $e,"code is $q";
}
$area=$row[2];

$row1=$dbpdo->query("SELECT sno from ariainfo where `ariaid`='$area'")->fetch(PDO::FETCH_NUM);
$f4=$row1[0];
$f5=$row[3];

$f6=$row[8];
$f7=$row[9];
$f8="";
$date1=explode("-",$row[5]);
$date2="20".$date1[2]."-".$date1[1]."-".$date1[0];
$f9=date("Y-m-d",strtotime($date2));
$f10="";
$f11=$row[7];
$f12=$row[10];

try {
$q1="INSERT INTO `customers` (`id`, `companycode`, `name`, `area`, `address`, `contactperson`, `mode`, `licence`, `ldate`, `phone`, `mobile`,`tax`,`customertype`) VALUES ('$f1', '$f2', '$f3', '$f4', '$f5', '$f6', '$f7', '$f8', '$f9', '$f10', '$f11','$f12','1')";
$stmt1 = $dbpdo->prepare($q1);
$stmt1->execute();
}
catch (Exception $e) {
    echo $q1;
}

}

  
?>