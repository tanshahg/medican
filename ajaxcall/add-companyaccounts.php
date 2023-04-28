<?php
include "../db.php";
$output="";
$f1=$_POST['f1'];
$f2=$_POST['f2'];
$f3=$_POST['f3'];
$f4=$_POST['f4'];
$f5=$_POST['f5'];



$q="INSERT INTO `bankaccounts` (`id`, `ccode`, `bname`,`accountno`,`accounttile`,`bankaddress`)  VALUES (Null, '$f1', '$f2', '$f3', '$f4', '$f5')";
$stmt = $dbpdo->prepare($q);
$stmt->execute();
echo json_encode(array("a"=>1));
						?>