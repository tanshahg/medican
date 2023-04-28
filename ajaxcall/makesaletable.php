<?php 
include "../db.php";
$output="";
$pid="";
$cname="";
$ctotal=0;
$atotal=0;
if(count($_SESSION["shopping_cart"]))
{
$output.="
<div class='col-lg-12 grid-margin'>
              <div class='card'>
                <div class='card-body'>
<table class='table table-condensed'>
<th>Action</th>
<th>Sno</th>
<th>Product name</th>
<th>T.P</th>
<th>Qty</th>
<th>Bonus</th>
<th>Batch</th>
<th>Exp-Date</th>
<th>Gross</th>
<th>discount</th>
<th>d-claim</th>
<th>Taxable Amount</th>
<th>Sale Tax</th>
<th>Futher Tax</th>
<th>Total</th>
</tr>
";
	$id=0;
	$atotal=0;
	foreach($_SESSION["shopping_cart"] as $keys => $values)
	{
		
		$id++;
		

		$pid=$values['product'];

		$row=$dbpdo->query("SELECT name from products where id='$pid'")->fetch(PDO::FETCH_NUM);
		$pname=$row[0];
			
	$newxdate = date("d-m-Y", strtotime($values['expdate']));
		$id++;
$gst=$values['gst'];
$extra=$values['extra'];
$netrate=$values['netrate'];
$mrp=$values['mrp'];
$dis=$values['discount'];
$tp=round($values['srate'],2);
$qty=$values['qty'];
if(!$qty) $qty=0;
if(!empty($dis))
$dis=round($values['discount']); else $dis=null;
if(!empty($dis1))
$dis1=round($values['dclaim'],2); else $dis1=null;
$tpamount=$values['srate'];
$tpamount=round($tpamount,2);
$gross=round($tpamount*$qty,2);
$tamount=round($gross-$dis,2);
$dis2=$values['dclaim'];
if(!empty($dis2))
$dis2=round($tpamount*$dis2/100,2);
else
	$dis2=null;
if(!empty($values['gst']))
$gst=round($values['gst'],2); else $gst=null;
if(!empty($values['extra']))
$extra=round($values['extra'],2); else $extra=null;
$gst1=0;
$extra1=0;
$tp1=0;
$dis1=0;


		$pid=$values['product'];

		$row=$dbpdo->query("SELECT name from products where id='$pid'")->fetch(PDO::FETCH_NUM);
		$pname=$row[0];
				
	$packing=null;
	$newxdate = date("d-m-Y", strtotime($values['expdate']));





		$output.="<tr>
		<td>
		   <button type=button class=\"delno btn btn-icons btn-inverse-info\" id=\"$pid\">
		   <i class=\"far fa-trash-alt\"></i></button> </td>      
				
					<td>$id</td>
					<td>".$pname."</td>
					<td>".$tpamount."</td>
					<td>".$values['qty']."</td>
					<td>".$values['bqty']."</td>
					<td>".$values['batch']."</td>
					<td>".$newxdate."</td>
					<td>".$gross."</td>
					<td>".$dis."</td>
					<td>".$dis2."</td>
					<td>".$tamount."</td>
					<td>".$gst."</td>
					<td>".$extra."</td>
					<td>".round($values['totalamount'])."</td>
					<tr>
					";
$atotal=$atotal+$values['totalamount'];
}
	
$output.="</thead><tbody><table>";

}

$_SESSION["shopping_heads"]['gamount']=$atotal;
$total1=$_SESSION["shopping_heads"]['gamount'];
$total2=$_SESSION["shopping_heads"]['tax'];
if($total2)
$total3=round($total1+$total1*$total2/100); else $total3=$total1;

$total1=round($total1);
$total3=round($total3);


echo json_encode(array("a"=>$output,"b"=>$total1,"c"=>$total2,"d"=>$total3));
?>

	
