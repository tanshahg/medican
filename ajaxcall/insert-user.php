<?php
include "../db.php";
$msg="";
if(isset($_POST["f1"], $_POST["f2"]))
{
$u=$_POST['f1'];
$p=$_POST['f2'];
$p=md5($p);
$c=$_POST['f3'];
$s=$_POST['f4'];
$q="INSERT INTO `users` (`username`, `password`, `cader`, `ip`, `lastlogindate`, `status`, `pic`) 
values(\"$u\",\"$p\",\"$c\",\"192.168.1.1\",\"2019-12-05 00:00:00\",\"$s\",'No pic') ";
$s=$dbpdo->prepare($q);
$s->execute();
$msg= 'Data Inserted';
echo $msg;
 }
?>