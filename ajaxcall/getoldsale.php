<?php
session_start();
include "../db.php";
$total=0;
$saleid=$_POST['code'];
$srow=$dbpdo->query("SELECT * from sale where id='$saleid'")->fetch(PDO::FETCH_NUM);
$tax=$srow[6];
if($tax>2)
{
$amount=$srow[5]-$srow[6];
$tax=round($srow[6]*100/$amount,1);
}

$item_array = array(
					'date'               =>     $srow[1],  
					'area'             =>      $srow[2],  
					'customer'             =>      $srow[3],  
					'saleman'             =>      $srow[4],  
					'gamount'             =>      $srow[5],  
					'tax'             =>      $tax,  
					'gtotal'             =>     $srow[5],  
					'vid'             =>     $srow[0],  
					

				);
				$_SESSION["shopping_heads"] = $item_array;

$s=$dbpdo->prepare("select * from saledetail where tableid='$saleid'");
$s->execute();
while($row = $s->fetch(PDO::FETCH_BOTH)){


$item_array = array(
					'product'               =>     $row[2],  
					'batch'             =>      $row[4],  
					'bclaim'             =>      $row[16],  
					'expdate'             =>      $row[5],  
					'mrp'             =>      $row[10],  
					'qty'             =>      $row[6],  
					'bqty'             =>      $row[7],  
					'srate'             =>      $row[11],  
					'discount'             =>      $row[12],  
					'subamount'             =>      $row[8],  
					'totalamount'             =>      $row[9],  
					'gst'             =>      $row[13],  
					'extra'             =>      $row[15],  
					'netrate'             =>     $row[16],  
					'dclaim'             =>      $row[17],  
					 
					

				);
				$_SESSION["shopping_cart"][] = $item_array;

			}


				


				include "makesaletable.php";
				exit;


						?>