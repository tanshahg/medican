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
$date1 = date("Ymd", strtotime($cdate));
$date2 = date("d-m-Y", strtotime($cdate));
$cid=$crows[2];
$trow=$dbpdo->query("SELECT name from `customers` 
where id='$cid'")->fetch(PDO::FETCH_NUM);
$company=$trow[0];
$conton=$crows[3];
$corier=$crows[4];
$corierno=$crows[5];
$invoice=$crows[6];
$rdate=$crows[7];
$page=$crows[8];

$date3 = date("Ymd", strtotime($rdate));
$date4 = date("d-m-Y", strtotime($rdate));
$tax=$crows[10];
$net=0;
$drow=$dbpdo->query("SELECT sum(totalamount) from stockdetail where tableid='$sid' ")->fetch(PDO::FETCH_NUM);
$bill=round($drow[0],2);
if($tax)
$taxamount=round($bill*$tax/100,2);
else
$taxamount=0;
$net=$bill+$taxamount;
$sub_array = array();
$sub_array[]=$sid;
$sub_array[]="<div data-sort='$date1'>$date2</div>";
$sub_array[]=$company;
$sub_array[]=$corier;
$sub_array[]=$corierno;
$sub_array[]=$conton;
$sub_array[]=$page;
$sub_array[]=$invoice;
$sub_array[]="<div data-sort='$date3'>$date4</div>";
$sub_array[]=$bill;
$sub_array[]=$tax;
$sub_array[]=$net;

$sub_array[]="
<div>
<button id='$crows[0]' class='btn btn-info btn-sm  delete'><i class='far fa-trash-alt'></i></button>
<a href=\"purchaseedit.php?code=$sid\"><button  class='btn btn-primary btn-sm'><i class='fas fa-edit'></i></button></a>
<a href=\"print-purchase.php?code=$sid\" target='_blank'><button  class='btn btn-primary btn-sm'><i class='fas fa-print'></i></button></a>

</div>";

$data[] = $sub_array;
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



