<?php
include "../db.php";
$pid=$_POST['pid'];
$pcode=$_POST['pcode'];
$btno=$_POST['btno'];
$expdate=$_POST['expdate'];
$mrp=$_POST['mrp'];
$row=$dbpdo->query("SELECT tp from stockdetail where productcode='$pid'  and batchno='$btno' and mrp='$mrp' ")->fetch(PDO::FETCH_NUM);
$tpamount=$row[0];
$dis1=$_POST['dis'];
$netrate=$_POST['nrate'];
$qty=$_POST['qty'];
$gst=$_POST['gst'];
$extra=$_POST['extra'];
$bonus=$_POST['bonus'];
$rr=$_POST['rr'];
$subtotal=0;
$nettotal=0;
$totalgst=0;
$totalextra=0;


$dis=0;
if($qty || $bonus)
	{
		
		if(!$qty) $qty=0;
		if(!$bonus) $bonus=0;
	$row=$dbpdo->query("SELECT sum(inhand) from stockdetail where productcode='$pid'  and batchno='$btno' and mrp='$mrp' ")->fetch(PDO::FETCH_NUM);

$inahnd=$row[0];
if(!$rr)
if($inahnd<$qty+$bonus)
{
	
	echo json_encode(array("x"=>0));
exit;
}

$gst1=0;
$extra1=0;
$subtotal=0;
$nettotal=0;
$bgst=0;
$bextra=0;
$totalgst=0;
$totalextra=0;
$damount=0;
if($netrate)
{
$subtotal=$netrate*$qty;
$nettotal=$netrate*$qty;
}
else
{

$amount1=$tpamount*$qty;
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
	$totalgst=round($gst1+$bgst,2);
	$totalextra=round($extra1+$bextra,2);
	$damount=round($dis,2);
	
	
}



}

$mrp1=$_POST['mrp'];
  $hrow=$dbpdo->query("SELECT sum(quantity) from stockdetail where productcode='$pid'  and batchno='$btno' and expdate='$expdate' and mrp='$mrp1'  group by productcode,batchno,expdate,mrp")->fetch(PDO::FETCH_NUM);  
  if($hrow)
  $purchase=$hrow[0]; else $purchase=0;

$hrow=$dbpdo->query("SELECT sum(bonus) from stockdetail where productcode='$pid'  and batchno='$btno' and expdate='$expdate' and mrp='$mrp1' group by productcode,batchno,expdate,mrp")->fetch(PDO::FETCH_NUM);  
  
  if($hrow)
  $bonus=$hrow[0]; else $bonus=0;
$totalpurchase=$purchase+$bonus;


$hrow=$dbpdo->query("SELECT sum(quantity) from stockreturndetail where productcode='$pid'  and batchno='$btno' and expdate='$expdate' and mrp='$mrp1'  group by productcode,batchno,expdate,mrp")->fetch(PDO::FETCH_NUM);  
  if($hrow)
  $purchaser=$hrow[0]; else $purchaser=0;

$hrow=$dbpdo->query("SELECT sum(bonus) from stockreturndetail where productcode='$pid'  and batchno='$btno' and expdate='$expdate' and mrp='$mrp1' group by productcode,batchno,expdate,mrp")->fetch(PDO::FETCH_NUM);  
  
  if($hrow)
  $bonusr=$hrow[0]; else $bonusr=0;
$totalpurchaser=$purchaser+$bonusr;



$hrow=$dbpdo->query("SELECT sum(quantity) from saledetail where productcode='$pid'  and batchno='$btno' and expdate='$expdate' and mrp='$mrp1'")->fetch(PDO::FETCH_NUM); 
  if($hrow)
  $sale=$hrow[0]; else $sale=0;

$hrow=$dbpdo->query("SELECT sum(bonus) from saledetail where productcode='$pid'  and batchno='$btno' and expdate='$expdate' and mrp='$mrp1' group by productcode,batchno,expdate,mrp")->fetch(PDO::FETCH_NUM); 
  
  if($hrow)
  $sbonus=$hrow[0]; else $sbonus=0;
  $totalsale=$sale+$sbonus;


  $bonus=$bonus-$sbonus-$bonusr;

  $inhand=$purchase-$sale-$purchaser;

echo json_encode(array("a"=>$subtotal,"b"=>$nettotal,"c"=>$totalgst,"d"=>$totalextra,"e"=>$dis,"i"=>$inhand,"j"=>$bonus,"k"=>$tpamount));
?>