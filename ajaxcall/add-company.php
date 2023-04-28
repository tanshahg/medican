<?php
include "../db.php";
$output="";
$f1=$_POST['f1'];
$f2=$_POST['f2'];
$f3=$_POST['f3'];
$f4=$_POST['f4'];
$f5=$_POST['f5'];
$f6=$_POST['f6'];


$q="INSERT INTO `customers` (`id`, `companycode`, `name`, `address`, `dsr`, `sas`,`customertype`)  VALUES ('$f1', '$f2', '$f3', '$f4', '$f5', '$f6','2')";
$stmt = $dbpdo->prepare($q);
$stmt->execute();
echo json_encode(array("a"=>1));
						?>