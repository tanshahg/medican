<?php
include "../db.php";
$output="";
$f1=$_POST['f1'];


$q="INSERT INTO `packinginfo` (`id`, `packing`)  VALUES (Null, '$f1')";
$stmt = $dbpdo->prepare($q);
$stmt->execute();
echo json_encode(array("a"=>1));
						?>