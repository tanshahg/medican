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

$row=$dbpdo->query("SELECT max(id) from customers where customertype='3'")->fetch(PDO::FETCH_NUM);
if(!empty($row[0])) $id=$row[0]+1; else $id=101;

$q="INSERT INTO `customers` (`id`, `name`, `address`,`areaofwork`, `nic`, `ldate`, `phone`, `mobile`, `area`,`customertype`)  VALUES ('$id','$f1', '$f2', '$f3', '$f4', '$f5', '$f6','$f7','$f8','3')";
$stmt = $dbpdo->prepare($q);
$stmt->execute();
echo json_encode(array("a"=>1));
						?>