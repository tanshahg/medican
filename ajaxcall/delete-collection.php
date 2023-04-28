<?php
session_start();
include "../db.php";
$code=$_POST['id'];
$row=$dbpdo->query("SELECT date,salemanid from payments where id='$code'")->fetch(PDO::FETCH_NUM);
$salemancode=$row[1];
$date=$row[0];
$q="delete from payments where salemanid='$salemancode' and date='$date'";
$stmt = $dbpdo->prepare($q);
$stmt->execute();
?>