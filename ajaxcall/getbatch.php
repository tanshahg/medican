<?php
include "../db.php";
$pid=$_POST['pid'];
$c=$_POST['c'];
switch($c)
{
	case 1:
	$table="saledetail";
	break;
	case 2:
	$table="salereturndetail";
	break;
	case 3:
	$table="stockdetail";
	break;
	case 4:
	$table="stockreturndetail";
	break;
}
$output="<option value=''>All</option>";
$q="select distinct batchno from $table where productcode=$pid";
$s=$dbpdo->prepare($q);
$s->execute();
while($row = $s->fetch(PDO::FETCH_BOTH)){
$output.="<option value='$row[0]'>$row[0]</option>";
}
echo $output;

						?>