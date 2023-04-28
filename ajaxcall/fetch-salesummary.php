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
				
$q2="SELECT *  FROM `sale` WHERE date >='$sdate' AND  date<='$edate' order by date";
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
$areacode=$crows[2];
$cid=$crows[3];
$salemancode=$crows[4];


$trow=$dbpdo->query("SELECT name from `customers` 
where id='$cid'")->fetch(PDO::FETCH_NUM);
if(!empty($trow))
{
$customer=$trow[0];
}
else $customer="";
$trow=$dbpdo->query("SELECT `arianame` from `ariainfo` 
where sno='$areacode'")->fetch(PDO::FETCH_NUM);
$area=$trow[0];
$trow=$dbpdo->query("SELECT name from `customers` 
where id='$salemancode'")->fetch(PDO::FETCH_NUM);
$saleman=$trow[0];
$cdate=$crows[1];
$date1 = date("Ymd", strtotime($cdate));
$date2 = date("d-m-Y", strtotime($cdate));
$tax=$crows[6];
$net=0;
$drow=$dbpdo->query("SELECT sum(totalamount) from saledetail where tableid='$sid'")->fetch(PDO::FETCH_NUM);
$bill=$drow[0];
if($tax)
$taxamount=round($bill*$tax/100);
else
$taxamount=0;
$net=round($bill+$taxamount);
$sub_array = array();
$sub_array[]=$sid;
$sub_array[]="<div data-sort='$date1'>$date2</div>";
$sub_array[]=$area;
$sub_array[]=$saleman;
$sub_array[]=$customer;
$sub_array[]=$bill;
$sub_array[]=$tax;
$sub_array[]=$net;

$sub_array[]="
<div>
<button id='$crows[0]' class='btn btn-info btn-sm  delete'><i class='far fa-trash-alt'></i></button>
<a href=\"saleedit.php?code=$sid\"><button  class='btn btn-primary btn-sm'><i class='fas fa-edit'></i></button></a>
<a href=\"print-sale.php?code=$sid\"><button  class='btn btn-primary btn-sm'><i class='fas fa-print'></i></button></a>

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



