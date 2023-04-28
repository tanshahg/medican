<?php
session_start();
include "../db.php";
$total=0;

$item_array = array(
					'saleman'               =>     $_POST['f0'],  
					
					

				);
				$_SESSION["shopping_heads"] = $item_array;




$item_array = array(
					'date'               =>     $_POST['f1'],  
					'ptype'               =>     $_POST['f2'],  
					'customer'             =>      $_POST['f3'],  
					'amount'             =>      $_POST['f4'],  
					'description'             =>      $_POST['f5'],  
					
					

				);
				$_SESSION["shopping_cart"][] = $item_array;
				
				include "makecollectiontable.php";
				exit;


						?>