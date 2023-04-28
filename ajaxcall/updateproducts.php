<?php
include "../db.php";
$output="";
$id=$_POST['id'];
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

if($f12==0) $f12=NULL;
if($f13==0) $f13=NULL;



$q="update `products` set `ibl`='$f1',`name`='$f2',`ccode`='$f3',`gcode`='$f4',`fcode`='$f5',`pcode`='$f6',`mrp`='$f7',`tp`='$f8',`dis1`='$f9',`gst`='$f12',`netrate`='$f11',`extra`='$f13' where id='$id' ";
$stmt = $dbpdo->prepare($q);
$stmt->execute();
header("location:../product-list.php")
						?>