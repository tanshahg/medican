<?php
session_start();
include "../db.php";
$tax=$_POST['tax'];
$a=$_POST['a'];
$b=$_POST['b'];
$x=round($a+$a*$b/100);
$_SESSION["shopping_heads"]['tax']=$tax;
echo $x;
?>