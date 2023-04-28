<?php
include "../db.php";
$pid=$_POST['pid'];
$batch=$_POST['batch'];
$mrp=$_POST['mrp'];
$table=$_POST['table'];
$output="";

$q="select distinct expdate from $table where productcode=$pid and batchno='$batch' and mrp='$mrp'";
$s=$dbpdo->prepare($q);
$s->execute();
$n=1;

while($row = $s->fetch(PDO::FETCH_BOTH)){
	if($n==1) $expdate=$row[0];
$output.="<option value='$row[0]'>$row[0]</option>";
$n++;
}

$q="select quantity from stockdetail where productcode=$pid and batchno='$batch' and expdate='$expdate' and mrp='$mrp'";
$s=$dbpdo->prepare($q);
$s->execute();
$row = $s->fetch(PDO::FETCH_BOTH);
$qty=$row[0];



echo json_encode(array("a"=>$output,"b"=>$qty));


						?>