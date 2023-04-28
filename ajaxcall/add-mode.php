<?php
include "../db.php";
$output="";
$f1=$_POST['f1'];



$q="INSERT INTO `cus_mode` (`id`,`mode`)  VALUES (Null,'$f1')";
$stmt = $dbpdo->prepare($q);
$stmt->execute();
echo json_encode(array("a"=>1));
						?>