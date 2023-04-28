<?php
session_start();
include "../db.php";
$saleman=$_SESSION["shopping_heads"]['saleman'];
$user=$_SESSION['karlu-user'];
$gtotal=0;
	foreach($_SESSION["shopping_cart"] as $keys => $values)
	{
			
		$date=$values['date'];
		$paymentmode=$values['ptype'];
		$debit=$values['amount'];
		$cid=$values['customer'];
		$description=$values['description'];
		
$row=$dbpdo->query("SELECT max(id) from payments")->fetch(PDO::FETCH_NUM);
$pid=$row[0]+1;
$q="INSERT INTO `payments` (`id`, `date`, `accounthead`, `cid`, `paymentmode`, `tid`, `description`, `debit`, `credit`,`salemanid`) VALUES ('$pid','$date','collection','$cid','$paymentmode' ,'0', '$description','$debit',null,'$saleman')";

$stmt = $dbpdo->prepare($q);
$stmt->execute();
}
echo $pid;

						?>