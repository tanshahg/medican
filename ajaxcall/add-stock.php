<?php
session_start();
include "../db.php";
$total=0;

$qty=$_POST['f14'];
$mrp=$_POST['f18'];
$tp=$_POST['f19'];
$dis1=$_POST['f20'];
$netrate=$_POST['f21'];
$gst=$_POST['f22'];
$extra=$_POST['f221'];
$bonus=$_POST['f15'];
$tpamount=$_POST['f119'];
$gst1=0;
$extra1=0;
$subtotal=0;
$nettotal=0;
$bgst=0;
$bextra=0;

if($qty>0 || $bonus>0)
{

	if(!$qty) $qty=0;
	if(!$bonus) $bonus=0;

if($netrate)
{
$subtotal=$netrate*$qty;
$nettotal=$netrate*$qty;
}
else
{
	
	$amount22=$mrp*$qty;
	
	

	$amount1=$amount22-($amount22*$tp/100);
    
   $dis=0;
        if($dis1>0) $dis=($amount1*$dis1)/100;
        
        $amount1=$amount1-$dis;

    
    if(!empty($gst))
    {
    	
        $gst1=($amount1*$gst)/100;
       
	if($bonus)
	{
		$bonusamount=$tpamount*$bonus;
		$bgst=($bonusamount*$gst)/100;

	}

        }
    if(!empty($extra))
    {
    	
        $extra1=($amount1*$extra)/100;
       
        if($bonus)
	{
		$extraamount=$tpamount*$bonus;
		$bextra=($extraamount*$extra)/100;

	}

        }

        $amount1=$amount1+$gst1+$extra1+$bgst+$bextra;

	$subtotal=round($amount1-$dis,2);
	$nettotal=round($amount1,2);
	

	
}
}

if(empty($_SESSION["shopping_heads"]))
{
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
					'gtotal'             =>      $_POST['f23'],  
					'vid'             =>      0,  
					

				);
				$_SESSION["shopping_heads"] = $item_array;
			}

$totalgst=$gst1+$bgst;
$totalextra=$extra1+$bextra;


$item_array = array(
					'pname'               =>     $_POST['f10'],  
					'bno'             =>      $_POST['f12'],  
					'expdate'             =>      $_POST['f13'],  
					'qty'             =>      $_POST['f14'],  
					'bonus'             =>      $_POST['f15'],  
					'subamount'             =>      $subtotal,  
					'totalamount'             =>     $nettotal,  
					'mrp'             =>      $_POST['f18'],  
					'tp'             =>      $_POST['f19'],  
					'dis1'             =>      $dis,  
					'netrate'             =>      $_POST['f21'],  
					'gst'             =>      $totalgst,  
					'extra'             =>     $totalextra,  
					'tpamount'             =>      $_POST['f119'],  
					

				);
				$_SESSION["shopping_cart"][] = $item_array;

				

				if(!empty($_SESSION["shopping_heads"]['gamount'])) 
					$total=$nettotal+$_SESSION["shopping_heads"]['gamount'];
				else
				 $total=$nettotal;
				$_SESSION["shopping_heads"]['gamount']=round($total,2);

				include "maketable.php";
				exit;


						?>