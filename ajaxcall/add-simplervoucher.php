<?php 
session_start();
include "../db.php";
$date=$_POST['f1'];
$paymentmode=$_POST['f2'];
$cid=$_POST['f3'];
$debit=$_POST['f4'];
$description=$_POST['f5'];

$row=$dbpdo->query("SELECT max(id) from payments")->fetch(PDO::FETCH_NUM);
$pid=$row[0]+1;
$q="INSERT INTO `payments` (`id`, `date`, `accounthead`, `cid`, `paymentmode`, `tid`, `description`, `debit`, `credit`) VALUES ('$pid','$date','rsimple','$cid','$paymentmode' ,'0', '$description','$debit',null)";

$stmt = $dbpdo->prepare($q);
$stmt->execute();

echo json_encode(array("a"=>$pid));


?>