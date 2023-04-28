<?php
include "../db.php";
$pid=$_POST['pid'];
$output="";

$row=$dbpdo->query("SELECT pcode from products where id='$pid'")->fetch(PDO::FETCH_NUM);
$pcode=$row[0];


$s=$dbpdo->prepare("select * from packinginfo where id='$pcode'");
$s->execute();
while($row = $s->fetch(PDO::FETCH_BOTH)){
$output.="<option value='$row[0]'>$row[1]</option>";
}

echo $output;

						?>