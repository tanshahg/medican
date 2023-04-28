<?php
session_start();
include "../db.php";
$total=0;

$purchaseid=$_POST['code'];
$srow=$dbpdo->query("SELECT * from stock where id='$purchaseid'")->fetch(PDO::FETCH_NUM);


$item_array = array(
					'date'               =>     $srow[1],  
					'supplier'             =>      $srow[2],  
					'conton'             =>      $srow[3],  
					'courier'             =>      $srow[4],  
					'courierno'             =>      $srow[5],  
					'invoice'             =>      $srow[6],  
					'refdate'             =>      $srow[7],  
					'page'             =>      $srow[8],  
					'gamount'             =>      $srow[9],  
					'tax'             =>      $srow[10],  
					'gtotal'             =>      $srow[9], 
					'vid'             =>     $srow[0], 
					

				);
				$_SESSION["shopping_heads"] = $item_array;


$s=$dbpdo->prepare("select * from stockdetail where tableid='$purchaseid'");
$s->execute();
while($row = $s->fetch(PDO::FETCH_BOTH)){
$tp=($row[10]-$row[11])*100/$row[10];
$item_array = array(
					'pname'               =>     $row[2],  
					'bno'             =>      $row[4],  
					'expdate'             =>      $row[5],  
					'qty'             =>      $row[6],  
					'bonus'             =>      $row[7],  
					'subamount'             =>      $row[8],  
					'totalamount'             =>     $row[9],  
					'mrp'             =>      $row[10],  
					'tp'             =>      $tp,  
					'dis1'             =>      $row[12],  
					'netrate'             =>      $row[14],  
					'gst'             =>      $row[13],  
					'extra'             =>     $row[17],  
					'tpamount'             =>      $row[11],  
					

				);
				$_SESSION["shopping_cart"][] = $item_array;
			}

				

				include "maketable.php";
				exit;


						?>