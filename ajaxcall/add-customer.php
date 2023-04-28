<?php
include "../db.php";
$output="";
$f1=$_POST['f1'];
$f2=$_POST['f2'];
$f3=$_POST['f3'];
$f4=$_POST['f4'];
$f5=$_POST['f5'];
$f6=$_POST['f6'];
$f7=$_POST['f7'];
$f8=$_POST['f8'];
$f9=$_POST['f9'];
$f10=$_POST['f10'];
$f11=$_POST['f11'];
$f12=$_POST['f12'];

$q="INSERT INTO `customers` (`id`, `companycode`, `name`, `area`, `address`, `contactperson`, `mode`, `licence`, `ldate`, `phone`, `mobile`,`tax`,`customertype`) VALUES ('$f1', '$f2', '$f3', '$f4', '$f5', '$f6', '$f7', '$f8', '$f9', '$f10', '$f11','$f12','1')";
$stmt = $dbpdo->prepare($q);
$stmt->execute();
echo json_encode(array("a"=>1));
						?>