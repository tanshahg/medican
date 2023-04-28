<?php
include "../db.php";

$pid=$_POST['pid'];
$btno=$_POST['btno'];
$output="";
$expdate=0;
$mrp1=0;

$q="select distinct expdate from stockdetail where productcode='$pid' and batchno='$btno' and inhand>0";
$s=$dbpdo->prepare($q);
$s->execute();
while($row = $s->fetch(PDO::FETCH_BOTH)){
	if($expdate==0) $expdate=$row[0];
$output.="<option value='$row[0]'>$row[0]</option>";
}


$mrp="";
$tp=0;
$q1="select * from stockdetail where productcode='$pid' and batchno='$btno' and expdate='$expdate' and inhand>0";
$s1=$dbpdo->prepare($q1);
$s1->execute();
while($row1 = $s1->fetch(PDO::FETCH_BOTH))
{
  if($mrp1==0) $mrp1=$row1[10];
  if($tp==0) $tp=$row1[11];
  $mrp.="<option value='$row1[10]'>$row1[10]</option>";
}

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




echo json_encode(array("a"=>$output,"b"=>$inhand,"c"=>$mrp,"d"=>$tp,"e"=>$bonus,
  "f"=>$totalpurchase,
  "g"=>$totalsale,
  "h"=>$inhand,
  "i"=>$purchaser
));





						?>