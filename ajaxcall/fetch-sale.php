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
				
$q2="SELECT *  FROM `sale` WHERE date >='$sdate' AND  date<='$edate' ";

$stmt23 = $dbpdo->prepare($q2);
$stmt23->execute();
$trecord=$stmt23->rowCount();

// if($_POST["length"] != -1)
// {
//  $q2.= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
// }

$gtotal=0;
$stmt23 = $dbpdo->prepare($q2);
$stmt23->execute();
$frecord=$stmt23->rowCount();
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
$customer=$trow[0];
$trow=$dbpdo->query("SELECT `arianame` from `ariainfo` 
where sno='$areacode'")->fetch(PDO::FETCH_NUM);
$area=$trow[0];
$trow=$dbpdo->query("SELECT name from `customers` 
where id='$salemancode'")->fetch(PDO::FETCH_NUM);
$saleman=$trow[0];
$cdate=$crows[1];
$newDate1 = date("Ymd", strtotime($cdate));
$newDate2 = date("d-m-Y", strtotime($cdate));
$ds=$dbpdo->prepare("select * from saledetail where tableid='$sid'");
$ds->execute();
while($drow = $ds->fetch(PDO::FETCH_BOTH)){
	$pcode=$drow[2];
	$trow=$dbpdo->query("SELECT name from `products` 
where id='$pcode'")->fetch(PDO::FETCH_NUM);
$pname=$trow[0];
$packing=$trow[0];
$g=round($drow[6]*$drow[11],2);
$tamount=round($g-$drow[12],2);


$expdate=date("d-m-Y",strtotime($drow[5]));
if($drow[12])
$discount=$drow[8]*$drow[12]/100;
else $discount=0;


$sub_array = array();
$sub_array[]=$sid;
$sub_array[]="<div data-sort='$newDate1'>$newDate2</div>";
$sub_array[]=$area;
$sub_array[]=$saleman;
$sub_array[]=$customer;
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
$sub_array[]=$drow[15];
$sub_array[]=$drow[9];







$data[] = $sub_array;
}
}
}
}




else{ $trecord=0; $data=""; $frecord=0;}





$output = array(
			"draw"            => isset ( $request['draw'] ) ?
				intval( $request['draw'] ) :
				0,
			 "recordsTotal"  =>  $trecord,
 "recordsFiltered" => $frecord,
 "data"    => $data
		);

echo json_encode($output);

?>



