<?php
include "../db.php";

$cid=$_POST['cid'];
$q="select tax from customers where id='$cid'";
$s=$dbpdo->prepare($q);
$s->execute();
$row = $s->fetch(PDO::FETCH_BOTH);
echo $row[0];



						?>