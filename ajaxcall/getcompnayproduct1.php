<?php
include "../db.php";
$cid=$_POST['cid'];
$output="<option value='0'>All</option>";
$s=$dbpdo->prepare("select * from products where ccode='$cid'");
$s->execute();
while($row = $s->fetch(PDO::FETCH_BOTH)){
$output.="<option value='$row[0]'>$row[2]</option>";
}
echo $output;

						?>