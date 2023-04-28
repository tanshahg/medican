<?php
include "../db.php";
$pid=$_POST['pid'];
$pcode=$_POST['pcode'];
$btno=$_POST['btno'];
$expdate=$_POST['expdate'];
$q="select * from  stockdetail where productcode='$pid' and packingcode='$pcode' and batchno='$btno' and expdate='$expdate';
";


$s=$dbpdo->prepare($q);
$s->execute();
$n=1;
$mrp="";
while($row = $s->fetch(PDO::FETCH_BOTH)){
$mrp="<option value='$row[10]'>$row[10]</option>";
if($n==1)
{
$tp=$row[11];
$dis=0;
$netrate=$row[14];
}
}

$hrow=$dbpdo->query("SELECT sum(inhand) from stockdetail where productcode='$pid'  and batchno='$btno' and expdate='$expdate'")->fetch(PDO::FETCH_NUM);	
  if($hrow)
  $inhand=$hrow[0]; else $inhand=0;

$hrow=$dbpdo->query("SELECT sum(bonus) from stockdetail where productcode='$pid'  and batchno='$btno' and expdate='$expdate'")->fetch(PDO::FETCH_NUM);	
  
  if($hrow)
  $bonus=$hrow[0]; else $bonus=0;



$hrow=$dbpdo->query("SELECT sum(bonus) from saledetail where productcode='$pid'  and batchno='$btno' and expdate='$expdate'")->fetch(PDO::FETCH_NUM);	
  
  if($hrow)
  $sbonus=$hrow[0]; else $sbonus=0;


  $bonus=$bonus-$sbonus;

  $inhand=$inhand-$bonus;



echo json_encode(array("a"=>$mrp,"b"=>$tp,"c"=>$dis,"d"=>$netrate,"e"=>$inhand,"f"=>$bonus));

						?>