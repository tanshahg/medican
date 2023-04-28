<?php
include "../db.php";
$output="";
$f1=$_POST['f1'];
$f2=$_POST['f2'];


$q="INSERT INTO `ariainfo` (`sno`, `ariaid`,`arianame`,`status`)  VALUES (Null, '$f1','$f2', 0)";
$stmt = $dbpdo->prepare($q);
$stmt->execute();
echo json_encode(array("a"=>1));
						?>