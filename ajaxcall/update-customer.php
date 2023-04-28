<?php
include "../db.php";
$output="";
$id=$_POST['id'];
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

$q="update `customers` set `companycode`='$f2', `name`='$f3', `area`='$f4', `address`='$f5', `contactperson`='$f6', `mode`='$f7', `licence`='$f8', `ldate`='$f9', `phone`='$f10', `mobile`='$f11',`tax`='$f12' where id='$id'";
$stmt = $dbpdo->prepare($q);
$stmt->execute();
header("location: ../customer-list.php");
						?>