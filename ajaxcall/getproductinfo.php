<?php
include "../db.php";
$id=$_POST['pid'];
$row=$dbpdo->query("SELECT * from products where id='$id'")->fetch(PDO::FETCH_NUM);
$mrp=$row[7];
$tp=$row[8];
$dis1=$row[9];
$gst=$row[10];
$extra=$row[12];
$netrate=$row[11];
$tpvalue=round($mrp-($mrp*$tp/100),2);

echo json_encode(array("a"=>$mrp,"b"=>$tp,"c"=>$dis1,"d"=>$gst,"e"=>$netrate,"f"=>$tpvalue,"g"=>$extra));

						?>