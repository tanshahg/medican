<?php
include "../db.php";
$id=$_POST['pid'];
$qty=$_POST['qty'];
$mrp=$_POST['mrp'];
$tp=$_POST['tp'];
$dis1=$_POST['dis'];
$netrate=$_POST['nrate'];
$netrate=$_POST['nrate'];
$gst=$_POST['gst'];
$extra=$_POST['extra'];
$bonus=$_POST['bonus'];
$tpamount=$_POST['tpamount'];
$gst1=0;
$extra1=0;
$subtotal=0;
$nettotal=0;
$bgst=0;
$bextra=0;

if($qty>0 || $bonus>0)
{
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
        // $us=$dbpdo->prepare("update products set `gst`='$gst' where id='$id'");
        // $us->execute();
	if($bonus)
	{
		$bonusamount=$tpamount*$bonus;
		$bgst=($bonusamount*$gst)/100;

	}

        }
    if(!empty($extra))
    {
    	
        $extra1=($amount1*$extra)/100;
        // $us=$dbpdo->prepare("update products set `extra`='$extra' where id='$id'");
        // $us->execute();

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

echo json_encode(array("a"=>$subtotal,"b"=>$nettotal));

						?>