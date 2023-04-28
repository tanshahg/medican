<?php 
include "db.php";
include "include/header.php";
date_default_timezone_set("Asia/Karachi");
$date=date("Y-m-d");


$q="select * from fakeproducts";
$s=$dbpdo->prepare($q);
$s->execute();
$cnt=0;
while($row = $s->fetch(PDO::FETCH_BOTH)){
	
$id=$row[0];
$ibl=$row[1];
$name=$row[2];
$companyid="201002";
$mrp=$row[4];
$tp=$row[5];
$dis=$row[7];
$gid=$row[8];
$netrate=$row[9];


$q1="INSERT INTO `products` (`id`, `ibl`, `name`, `ccode`, `gcode`, `fcode`, `pcode`, `mrp`, `tp`, `dis1`, `gst`, `netrate`, `extra`) VALUES ('$id','$ibl', '$name', '$companyid', '$gid', '1', null,'$mrp', '$tp', '$dis',null, '$netrate', null)";
$stmt1 = $dbpdo->prepare($q1);
$stmt1->execute();


}

  echo "done";
?>