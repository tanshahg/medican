<?php
session_start();
include "../db.php";
$total=0;



if(empty($_SESSION["shopping_heads"]))
{
$item_array = array(
					'date'               =>     $_POST['f2'],  
					'area'             =>      $_POST['f1'],  
					'customer'             =>      $_POST['f3'],  
					'saleman'             =>      $_POST['f4'],  
					'gamount'             =>      $_POST['f17'],  
					'tax'             =>      $_POST['f18'],  
					'gtotal'             =>      $_POST['f19'],  
					'vid'             =>      0,  
					

				);
				$_SESSION["shopping_heads"] = $item_array;
			}




$item_array = array(
					'product'               =>     $_POST['f5'],  
					'batch'             =>      $_POST['f7'],  
					'bclaim'             =>      $_POST['f6'],  
					'expdate'             =>      $_POST['f8'],  
					'mrp'             =>      $_POST['f9'],  
					'qty'             =>      $_POST['f10'],  
					'bqty'             =>      $_POST['f11'],  
					'srate'             =>      $_POST['f12'],  
					'discount'             =>      $_POST['f13'],  
					'subamount'             =>      $_POST['f15'],  
					'totalamount'             =>      $_POST['f16'],  
					'gst'             =>      $_POST['f220'],  
					'extra'             =>      $_POST['f2210'],  
					'netrate'             =>      $_POST['f14'],  
					'dclaim'             =>      $_POST['f100'],  
					 
					

				);
				$_SESSION["shopping_cart"][] = $item_array;
				if($_SESSION["shopping_heads"]['gamount']) $total=$_POST['f16']+$_SESSION["shopping_heads"]['gamount'];
				else $total=$_POST['f16'];
				$_SESSION["shopping_heads"]['gamount']=$total;

				

				include "makesaletable.php";
				exit;


						?>