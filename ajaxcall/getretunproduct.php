<?php
include "../db.php";
$output="";
$output1="";
$output2="";
$output3="";
$pid=$_POST['pid'];




$q="select distinct batchno from stockdetail where productcode=$pid  and inhand>0";
$s=$dbpdo->prepare($q);
$btno=0;
$s->execute();
while($row = $s->fetch(PDO::FETCH_BOTH)){
	if($btno==0) $btno=$row[0];
$output2.="<option value='$row[0]'>$row[0]</option>";
}


$q="select distinct mrp from stockdetail where productcode='$pid' and batchno='$btno' and inhand>0";
$s=$dbpdo->prepare($q);
$s->execute();
$mrp=0;
while($row = $s->fetch(PDO::FETCH_BOTH)){
	if($mrp==0) $mrp=$row[0];
$output1.="<option value='$row[0]'>$row[0]</option>";
}


$q="select distinct expdate from stockdetail where productcode='$pid' and mrp='$mrp' and batchno='$btno' and inhand>0";
$s=$dbpdo->prepare($q);
$s->execute();
$expdate=0;
while($row = $s->fetch(PDO::FETCH_BOTH)){
	if($expdate==0) $expdate=$row[0];
$output3.="<option value='$row[0]'>$row[0]</option>";
}
$mrp1=$mrp;



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

echo json_encode(array("a"=>$output1,"b"=>$output2,"c"=>$output3,"d"=>$inhand));

						?>