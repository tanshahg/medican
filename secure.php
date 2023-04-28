<?php
session_start();
$currentuser=$_SESSION['karlu-user'];
if(!empty($currentuser))
{
$currentcader=$_SESSION['cad1'];
$currentpage=basename($_SERVER['PHP_SELF']);
include "db.php";
$row=$dbpdo->query("select pageid from pages where pagelink='$currentpage'")->fetch(PDO::FETCH_NUM);
$currentpageid=0;
if($row)
$currentpageid=$row[0];
if($currentpageid)
{	
$row=$dbpdo->query("select op1,op2,op3  from role where cader='$currentcader' and  pageid='$currentpageid'")->fetch(PDO::FETCH_NUM);
$read=$row[0];
$entry=$row[1];
$edit=$row[2];
$_SESSION['edit']=$edit;
if($read==0) header("location:user.php");
}
}
else
{
    session_start();

session_unset();

session_destroy();
    header("location:index.php");
}

?>