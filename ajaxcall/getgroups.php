<?php
include "../db.php";
$id=$_POST['id'];
$output="";
$q="select * from companygroups where ccode='$id'";
$s = $dbpdo->prepare($q);
$s->execute();
while($row = $s->fetch(PDO::FETCH_BOTH)){
	$output.="<option value='$row[0]'>$row[2]</option>";
	}
echo $output;


						?>