<?php
include "../db.php";
$output="";
$f1=$_POST['f1'];
$f2=$_POST['f2'];
$f3=$_POST['f3'];
$q="select * from `mainhead` where head_name like '$f3'";
$stmt = $dbpdo->prepare($q);
$stmt->execute();
$n=$stmt->rowcount();
if($n>0)
{
echo 1;
exit;
}

$q="INSERT INTO `mainhead` (`h_id`, `acid`, `head_name`, `status`) VALUES
 (\"$f1\", \"$f2\",\"$f3\",\"0\")";
$stmt = $dbpdo->prepare($q);
$stmt->execute();


						echo 0;
						?>