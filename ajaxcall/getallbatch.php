<?php
include "../db.php";
$pid=$_POST['pid'];
$pcode=$_POST['pcode'];
$output="<option value=''>Select Batch</option>";
$pid=$_POST['pid'];
$q="select distinct batchno from stockdetail where productcode=$pid and packingcode='$pcode'";
$s=$dbpdo->prepare($q);
$s->execute();
while($row = $s->fetch(PDO::FETCH_BOTH)){
$output.="<option value='$row[0]'>$row[0]</option>";
}



echo json_encode(array("a"=>$output));

						?>