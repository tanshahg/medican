<?php
session_start();
include "../db.php";

$data="";
				if(isset($_POST['sdate']))
				{
					$data = array();
				$total=0;
				$sdate=$_POST['sdate'];
				$edate=$_POST['edate'];	
				
$q2="SELECT *  FROM `stock` WHERE date >='$sdate' AND  date<='$edate' order by date";
$gtotal=0;
$stmt23 = $dbpdo->prepare($q2);
$stmt23->execute();
$trecord=$stmt23->rowCount();
if($trecord)
{	
$n=0;
while ($crows = $stmt23->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_NEXT))
{

$sid=$crows[0];
$cdate=$crows[1];
$cid=$crows[2];


$trow=$dbpdo->query("SELECT name from `customers` 
where id='$cid'")->fetch(PDO::FETCH_NUM);
$company=$trow[0];

$newDate1 = date("Ymd", strtotime($cdate));
$newDate2 = date("d-m-Y", strtotime($cdate));


$ds=$dbpdo->prepare("select * from stockdetail where tableid='$sid'");
$ds->execute();
while($drow = $ds->fetch(PDO::FETCH_BOTH)){
	$pcode=$drow[2];
	$trow=$dbpdo->query("SELECT name from `products` 
where id='$pcode'")->fetch(PDO::FETCH_NUM);
if(empty($trow[0])) echo $pcode,"<br>";
$pname=$trow[0];

$g=round($drow[6]*$drow[11],2);
$tamount=round(($g-$drow[12]),2);


$expdate=date("d-m-Y",strtotime($drow[5]));
if($drow[12])
$discount=$drow[12];
else $discount=0;




$sub_array = array();
$sub_array[]=$sid;
$sub_array[]="<div data-sort='$newDate1'>$newDate2</div>";
$sub_array[]=$company;
$sub_array[]=$pcode;
$sub_array[]=$pname;

$sub_array[]=$drow[11];
$sub_array[]=$drow[6];
$sub_array[]=$drow[7];
$sub_array[]=$drow[4];
$sub_array[]=$expdate;
$sub_array[]=$g;
$sub_array[]=$drow[12];
$sub_array[]=$tamount;
$sub_array[]=$drow[13];
$sub_array[]=$drow[17];
$sub_array[]=$drow[9];







$data[] = $sub_array;
}
}
}
}




else{ $trecord=0; $data="";}


$output = array(
 "draw"    => intval(1),
 "recordsTotal"  =>  $trecord,
 "recordsFiltered" => $trecord,
 "data"    => $data
);

echo json_encode($output);

?>



