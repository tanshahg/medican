<?php
include "../db.php";
$output="";
$f1=$_POST['f1'];
$f2=$_POST['f2'];



$q="INSERT INTO `companyemails` (`id`, `ccode`, `email`)  VALUES (Null, '$f1', '$f2')";
$stmt = $dbpdo->prepare($q);
$stmt->execute();
echo json_encode(array("a"=>1));
						?>