<?php
session_start();
include "../db.php";
$id=$_POST['id'];


$q21="SELECT productcode,batchno,expdate,mrp,quantity,bonus from saledetail where tableid='$id'";

  $s21=$dbpdo->prepare($q21);
$s21->execute();
while($row1 = $s21->fetch(PDO::FETCH_BOTH)) {
$productcode=$row1[0];
$batchno=$row1[1];
$expdate=$row1[2];
$mrp=$row1[3];
$qty=$row1[4];
$bonus=$row1[5];
if(empty($bonus)) $bonus=0;
$qty=$qty+$bonus;
$tqty=$qty;    

$q="SELECT id,inhand,quantity,bonus from stockdetail where productcode='$productcode'  and batchno='$batchno' and mrp='$mrp' and expdate='$expdate'  order  by expdate,tableid";

  $s=$dbpdo->prepare($q);
$s->execute();

while($row = $s->fetch(PDO::FETCH_BOTH)){
  $cid=$row[0];
  $oqty=$row[2]+$row[3]-$row[1];
if($tqty>0)
{

  if($tqty>=$oqty)
{
    $majood=$oqty+$row[1];
  $q1="update stockdetail set inhand='$majood' where id='$cid'";
  $s1=$dbpdo->prepare($q1);
  $s1->execute();
  $tqty=$tqty-$oqty;
  continue;
  }


if($tqty<=$oqty)
{
  
  $majood=$tqty+$row[1];
  $q1="update stockdetail set inhand='$majood' where id='$cid'";
  $s1=$dbpdo->prepare($q1);
  $s1->execute();
  $tqty=$tqty-$majood;
  continue;
 
}



  }
  
}

}




$q="delete from payments where accounthead='sale' and tid='$id'";
$stmt = $dbpdo->prepare($q);
$stmt->execute();
$q="delete from saledetail where tableid='$id'";
$stmt = $dbpdo->prepare($q);
$stmt->execute();
$q="delete from sale where id='$id'";
$stmt = $dbpdo->prepare($q);
$stmt->execute();




						?>