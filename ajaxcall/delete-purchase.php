<?php
session_start();
include "../db.php";
$id=$_POST['id'];

$q="delete from payments where accounthead='stock' and tid='$id'";
$stmt = $dbpdo->prepare($q);
$stmt->execute();

$q="delete from stockdetail where tableid='$id'";
$stmt = $dbpdo->prepare($q);
$stmt->execute();
$q="delete from stock where id='$id'";
$stmt = $dbpdo->prepare($q);
$stmt->execute();


						?>