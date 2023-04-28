<?php
include "../db.php";
$output="";
$f1=$_POST['f1'];
$f2=$_POST['f2'];
$f3=$_POST['f3'];
$f4=$_POST['f4'];
$f5=$_POST['f5'];
$f6=null;
$f7=$_POST['f7'];
$f8=$_POST['f8'];
$f9=$_POST['f9'];
$f10=$_POST['f10'];
$f11=$_POST['f11'];
$f12=$_POST['f12'];
$f13=$_POST['f13'];

$q="INSERT INTO `products` (`id`,`ibl`,`name`,`ccode`,`gcode`,`fcode`,`pcode`,
`mrp`,`tp`,`dis1`,`gst`,`netrate`,`extra`) VALUES (Null,'$f1', '$f2', '$f3', '$f4', '$f5', '$f6', '$f7', '$f8', '$f9', '$f12', '$f11','$f13')";
$stmt = $dbpdo->prepare($q);
$stmt->execute();
echo json_encode(array("a"=>1));
						?>