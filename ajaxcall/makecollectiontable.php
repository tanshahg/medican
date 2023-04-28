<?php 
include "../db.php";
$output="";
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
<th>date</th>
<th>from</th>
<th>type</th>
<th>amount</th>

</tr>
";
	$id=0;
	foreach($_SESSION["shopping_cart"] as $keys => $values)
	{
		
		$id++;
		$cid=$values['customer'];
		$typeid=$values['ptype'];

		$row=$dbpdo->query("SELECT name from customers where id='$cid'")->fetch(PDO::FETCH_NUM);
		$customer=$row[0];
		$row=$dbpdo->query("SELECT * from paymentmode where id='$typeid'")->fetch(PDO::FETCH_NUM);
		$ctype=$row[1];
		$date = date("d-m-Y", strtotime($values['date']));
		$output.="<tr>
		<td>
		   <button type=button class=\"delno btn btn-icons btn-inverse-info\" id=\"$cid\">
		   <i class=\"far fa-trash-alt\"></i></button> </td>      
				
					<td>$id</td>
					<td>".$date."</td>
					<td>".$customer."</td>
					<td>".$ctype."</td>
					<td>".$values['amount']."</td>
					<tr>
					";



}
	
$output.="</thead><tbody><table>";

}
echo json_encode(array("a"=>$output));
?>

	
