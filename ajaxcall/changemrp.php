<?php
include "../db.php";
	$pid=$_POST['pid'];
    $mrp=$_POST['mrp'];
    $tp=$_POST['tp'];
    $dis=$_POST['dis'];
    $nrate=$_POST['nrate'];
    $qty=$_POST['qty'];
    $gst=$_POST['gst'];
    $extra=$_POST['extra'];
    $subtotal=0;
    $nettotal=0;
    if($mrp)
    {
$q="update products set mrp='$mrp' where id='$pid'";
$stmt = $dbpdo->prepare($q);
$stmt->execute();
    }
    if($tp)
    {
$q="update products set tp='$tp' where id='$pid'";
$stmt = $dbpdo->prepare($q);
$stmt->execute();
    }
    if($dis)
    {
$q="update products set dis1='$dis' where id='$pid'";
$stmt = $dbpdo->prepare($q);
$stmt->execute();
    }
    else {
    	$q="update products set dis1=null where id='$pid'";
$stmt = $dbpdo->prepare($q);
$stmt->execute();
    }

    if($nrate>0)
    {
$q="update products set netrate='$nrate' where id='$pid'";
$stmt = $dbpdo->prepare($q);
$stmt->execute();
    }
    else {
    	$q="update products set netrate=null where id='$pid'";
$stmt = $dbpdo->prepare($q);
$stmt->execute();
    }

    if($qty)
    {
    	
$row=$dbpdo->query("SELECT * from products where id='$pid'")->fetch(PDO::FETCH_NUM);
$mrp=$row[7];
$tp=$row[8];
$dis1=$row[9];
$dis2=$row[10];
$netrate=$row[11];


if($netrate)
{
$subtotal=$netrate*$qty;
$nettotal=$netrate*$qty;
}
else
{
	$amount=$mrp*$qty;
    $amount1=$amount-($amount*$tp/100);
    if(!empty($gst))
    {
        $amount=$amount+($amount*$gst/100);
        $us=$dbpdo->prepare("update products set `gst`='$gst' where id='$pid'");
        $us->execute();
    }
    if(!empty($extra))
    {
        $amount=$amount+($amount*$extra/100);
        $us=$dbpdo->prepare("update products set `extra`='$extra' where id='$pid'");
        $us->execute();
    }

	$subtotal=round($amount,2);
	$nettotal=round($amount,2);
	if($dis1>0) $nettotal=round($nettotal-($nettotal*$dis1/100),2);

	
}
}


echo json_encode(array("a"=>$subtotal,"b"=>$nettotal));

						?>