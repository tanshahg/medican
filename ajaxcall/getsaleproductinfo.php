<?php
include "../db.php";
$output="";
$output1="";
$output2="";
$pid=$_POST['pid'];


$q="select distinct batchno from saledetail where productcode=$pid";
$s=$dbpdo->prepare($q);
$btno=0;
$s->execute();
while($row = $s->fetch(PDO::FETCH_BOTH)){
	if($btno==0) $btno=$row[0];
$output1.="<option value='$row[0]'>$row[0]</option>";
}

$q="select distinct expdate from saledetail where productcode='$pid' and batchno='$btno' ";
$s=$dbpdo->prepare($q);
$s->execute();
$expdate=0;
while($row = $s->fetch(PDO::FETCH_BOTH)){
	if($expdate==0) $expdate=$row[0];
$output2.="<option value='$row[0]'>$row[0]</option>";
}



$q="select * from  saledetail where productcode='$pid' and batchno='$btno' and expdate='$expdate';
";
$s=$dbpdo->prepare($q);
$s->execute();
$n=1;
$mrp="";
while($row = $s->fetch(PDO::FETCH_BOTH)){
$mrp="<option value='$row[10]'>$row[10]</option>";
if($n==1)
{
$mrp1=$row[10];
$productcode=$row[2];
$trow=$dbpdo->query("SELECT gst,extra from products where id='$productcode'")->fetch(PDO::FETCH_NUM);
$tp=$row[11];
$gst=$trow[0];
$extra=$trow[1];
$dis=0;
$netrate=$row[14];
$inhand=$row[6]+$row[7];
}
}


echo json_encode(array("a"=>$output1,"b"=>$output2,"c"=>$mrp,"d"=>$tp,"e"=>$dis,"f"=>$netrate,"g"=>$gst,"h"=>$extra,"i"=>$inhand));

						?>

					