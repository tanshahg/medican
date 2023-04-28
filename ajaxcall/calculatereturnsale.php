<?php
include "../db.php";
$pid=$_POST['pid'];
$pcode=$_POST['pcode'];
$btno=$_POST['btno'];
$expdate=$_POST['expdate'];
$mrp=$_POST['mrp'];
$tp=$_POST['tp'];
$dis=$_POST['dis'];
$netrate=$_POST['nrate'];
$qty=$_POST['qty'];
$subtotal=0;
$nettotal=0;

    if($qty)
    {

	$amount=$tp*$qty;
	$subtotal=$amount;
	$nettotal=$amount;
	
	
	
}



echo json_encode(array("a"=>$subtotal,"b"=>$nettotal));

						?>