<?php
session_start();
include "../db.php";
$id=$_POST['id'];
$q="delete from payments where id='$id'";
$stmt = $dbpdo->prepare($q);
$stmt->execute();
?>