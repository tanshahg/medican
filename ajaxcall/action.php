<?php
session_start();
include "../db.php";
$option=$_POST['opt'];
if($option=="del-order")
{
	
	
$code=$_POST['code'];
foreach($_SESSION["shopping_cart"] as $keys => $values)
		{
			if($keys == $_POST["code"])
			{
				unset($_SESSION["shopping_cart"][$keys]);
			}
		}
	
include "maketable.php";
}

if($option=="del-sale")
{
	
	
$code=$_POST['code'];
foreach($_SESSION["shopping_cart"] as $keys => $values)
		{
			if($values["product"] == $_POST["code"])
			{
				unset($_SESSION["shopping_cart"][$keys]);
			}
		}
	
include "makesaletable.php";
}

if($option=="del-payment")
{
	
	
$code=$_POST['code'];
foreach($_SESSION["shopping_cart"] as $keys => $values)
		{
			if($values["customer"] == $_POST["code"])
			{
				unset($_SESSION["shopping_cart"][$keys]);
			}
		}
	
include "makecollectiontable.php";
}



						?>