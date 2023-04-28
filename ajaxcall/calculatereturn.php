<?php
include "../db.php";
$pid=$_POST['pid'];
$btno=$_POST['batch'];
$batch=$_POST['batch'];
$mrp=$_POST['mrp'];
$expdate=$_POST['expdate'];
$pqty=$_POST['pqty'];
$table=$_POST['table'];


$q="select quantity,inhand,bonus,tp,dis1,gst,extra,netrate from stockdetail where productcode=$pid and batchno='$batch' and expdate='$expdate' and mrp='$mrp'";
$s=$dbpdo->prepare($q);
$s->execute();
$row = $s->fetch(PDO::FETCH_BOTH);
$qty=$row[0];
$inhand=$pqty;
$bonus=$row[2];
$tp=$row[3];
$dis=$row[4];
$gst=$row[5];
$extra=$row[6];
$netrate=$row[7];
$unitdiscount=round($dis/($qty+$bonus),2);
$unitgst=round($gst/($qty+$bonus),2);
$unitextra=round($extra/($qty+$bonus),2);
if(empty($bonus)) $bonus=0;
$totaltp=$row[3]*($inhand-$bonus);
$totaldiscount=round($unitdiscount*$inhand,2);
$totalgst=round($unitgst*$inhand,2);
$totalextra=round($unitextra*$inhand,2);
$subamount=round($totaltp-$totaldiscount,2);
$netamount=$subamount;

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





echo json_encode(array("a"=>$tp,"b"=>$totaldiscount,"c"=>$netrate,"d"=>$inhand,"e"=>$bonus,"f"=>$totalgst,"g"=>$totalextra,"h"=>$subamount,"i"=>$netamount));

						?>