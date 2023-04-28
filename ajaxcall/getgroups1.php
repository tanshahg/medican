<?php
include "../db.php";
$id=$_POST['id'];
$output="";
$q="select * from companygroups where ccode='$id'";
$s = $dbpdo->prepare($q);
$s->execute();
$output="<option value='0'>All</option>";
while($row = $s->fetch(PDO::FETCH_BOTH)){
	$output.="<option value='$row[0]'>$row[2]</option>";
	}
echo $output;


						?>