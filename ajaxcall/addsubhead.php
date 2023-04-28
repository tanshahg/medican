<?php
include "../db.php";
$output="";
$f1=$_POST['f1'];
$f2=$_POST['f2'];
$f3=$_POST['f3'];
$q="select * from `subheads` where sub_head_name like '$f3'";
$stmt = $dbpdo->prepare($q);
$stmt->execute();
$n=$stmt->rowcount();
if($n>0)
{
echo 1;
exit;
}

$row=$dbpdo->query("SELECT acid from mainhead where h_id='$f2'")->fetch(PDO::FETCH_NUM);
$acid=$row[0];

$q="INSERT INTO `subheads` (`sub_head_id`, `h_id`,`acid`, `sub_head_name`, `status`) VALUES
 (\"$f1\", \"$f2\",\"$acid\",\"$f3\",\"0\")";
$stmt = $dbpdo->prepare($q);
$stmt->execute();


						echo 0;
						?>