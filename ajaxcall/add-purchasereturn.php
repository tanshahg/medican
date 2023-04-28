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
					'bno'             =>      $_POST['f12'],  
					'expdate'             =>      $_POST['f13'],  
					'qty'             =>      $_POST['f14'],  
					'bonus'             =>      $_POST['f15'],  
					'subamount'             =>     $_POST['f16'],
					'totalamount'             =>    $_POST['f16'], 
					'mrp'             =>      $_POST['f18'],  
					'tp'             =>      $_POST['f19'],  
					'dis1'             =>     $_POST['f20'],  
					'netrate'             =>      $_POST['f21'],  
					'gst'             =>      $_POST['f77'],  
					'extra'             =>     $_POST['f88'],  
					'tpamount'             =>      $_POST['f19'],  
					

				);
				$_SESSION["shopping_cart"][] = $item_array;
				if($_SESSION["shopping_heads"]['gamount']) 
					$total=$_POST['f16']+$_SESSION["shopping_heads"]['gtotal'];
				else
				 $total=$_POST['f16'];
				$_SESSION["shopping_heads"]['gamount']=round($total,2);

				include "maketable.php";
				exit;


						?>