<?php
session_start();
include "../db.php";
$total=0;

$item_array = array(
					'date'               =>     $_POST['f2'],  
					'supplier'             =>      $_POST['f3'],  
					'conton'             =>      $_POST['f4'],  
					'courier'             =>      $_POST['f5'],  
					'courierno'             =>      $_POST['f6'],  
					'invoice'             =>      $_POST['f7'],  
					'refdate'             =>      $_POST['f8'],  
					'page'             =>      $_POST['f9'],  
					'gamount'             =>      $_POST['f23'],  
					'tax'             =>      $_POST['f24'],  
					'gtotal'             =>      $_POST['f25'],  
					

				);
				$_SESSION["shopping_heads"] = $item_array;




$item_array = array(
					'pname'               =>     $_POST['f10'],  
					'packing'             =>      $_POST['f11'],  
					'bno'             =>      $_POST['f12'],  
					'expdate'             =>      $_POST['f13'],  
					'qty'             =>      $_POST['f14'],  
					'bonus'             =>      $_POST['f15'],  
					'subamount'             =>      $_POST['f16'],  
					'totalamount'             =>      $_POST['f17'],  
					'mrp'             =>      $_POST['f18'],  
					'tp'             =>      $_POST['f19'],  
					'dis1'             =>      $_POST['f20'],  
					'netrate'             =>      $_POST['f21'],  
					'dis2'             =>      $_POST['f22'],  
					

				);
				$_SESSION["shopping_cart"][] = $item_array;
				if($_SESSION["shopping_heads"]['gamount']) $total=$_POST['f17']+$_SESSION["shopping_heads"]['gamount'];
				else $total=$_POST['f17'];
				$_SESSION["shopping_heads"]['gamount']=$total;

				include "maketable.php";
				exit;


						?>