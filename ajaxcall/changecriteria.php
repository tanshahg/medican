<?php
include "../db.php";
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
$output="<option value=''>Select product</option>";
$q="SELECT DISTINCT a.productcode,b.name FROM $table as a, products as b where a.productcode=b.id";
$s = $dbpdo->prepare($q);
$s->execute();
while($row = $s->fetch(PDO::FETCH_BOTH)){
	$output.="<option value='$row[0]'>$row[1]</option>";
	}
echo $output;


						?>