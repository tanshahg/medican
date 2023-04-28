<?php 
include "db.php";
include "include/header.php";
date_default_timezone_set("Asia/Karachi");
?>

<style>
th {
	
	border:1px solid white !important;
}
</style>

<table class="table table-bordered">
	<thead>
		<tr>
			<th colspan=3 class="text-center bg-dark text-capitalize text-white">Product</th>
			<th colspan=3 class="text-center bg-dark text-capitalize text-white">Purchase</th>
			<th colspan=3 class="text-center bg-dark text-capitalize text-white">Purchase return </th>
			<th colspan=3 class="text-center bg-dark text-capitalize text-white">Sale</th>
			<th colspan=2 class="text-center bg-dark text-capitalize text-white">Current Status</th>
		<tr>
		<th class="text-center bg-danger text-capitalize text-white">Code</th>
		<th class="text-center bg-danger text-capitalize text-white">Batch</th>
		<th class="text-center bg-danger text-capitalize text-white">Expirydate</th>
		<th class="text-center bg-danger text-capitalize text-white">Qty</th>
		<th class="text-center bg-danger text-capitalize text-white">Bonus</th>
		<th class="text-center bg-danger text-capitalize text-white">Total</th>
		<th class="text-center bg-danger text-capitalize text-white">return</th>
		<th class="text-center bg-danger text-capitalize text-white">return Bonus</th>
		<th class="text-center bg-danger text-capitalize text-white">Total return</th>
	


		
		<th class="text-center bg-danger text-capitalize text-white">Qty</th>
		<th class="text-center bg-danger text-capitalize text-white">Bonus</th>
		<th class="text-center bg-danger text-capitalize text-white">Total Sale</th>
		<th class="text-center bg-danger text-capitalize text-white">Inhand</th>
		<th class="text-center bg-danger text-capitalize text-white">Bake</th>
		</tr>
	</thead>
	<tbody>


<?php
$q="select productcode ,batchno,expdate,mrp,sum(quantity),sum(bonus),sum(inhand) from stockdetail  group by productcode,batchno,expdate order by productcode";
$s=$dbpdo->prepare($q);
$s->execute();
while($row=$s->fetch(PDO::FETCH_BOTH))
{
	$pcode=$row[0];
	$batchno=$row[1];
	$expdate=$row[2];
	$mrp=$row[3];
	$purchase=$row[4];
	$pbonus=$row[5];
	$inhand=$row[6];
	$ptotal=$purchase+$pbonus;
	$tp=$purchase;


	$row1=$dbpdo->query("SELECT sum(quantity),sum(bonus) from  stockreturndetail where productcode='$pcode' and batchno='$batchno' and expdate='$expdate' and mrp='$mrp'")->fetch(PDO::FETCH_NUM);
	$purchaser=$row1[0];
	$purchaserbonus=$row1[1];
	$totalpurchasereturn=$purchaser+$purchaserbonus;
	


	$row1=$dbpdo->query("SELECT sum(quantity),sum(bonus) from saledetail where productcode='$pcode' and batchno='$batchno' and expdate='$expdate' and mrp='$mrp'")->fetch(PDO::FETCH_NUM);
	$sale=$row1[0];
	$bsale=$row1[1];
	$totalsale=$sale+$bsale;
	$baki=$ptotal-$totalpurchasereturn-$totalsale;
	
	if($baki!=$inhand)

	echo "
<tr class='bg-primary text-white'>
		<td>$pcode</td>
		<td>$batchno</td>
		<td>$expdate</td>
		<td>$purchase</td>
		<td>$pbonus</td>
		<td>$ptotal</td>
		<td>$purchaser</td>
		<td>$purchaserbonus</td>
		<td>$totalpurchasereturn</td>
		<td>$sale</td>
		<td>$bsale</td>
		<td>$totalsale</td>
		<td>$inhand</td>
		<td>$baki</td>
		
	</tr>
	";

// 	echo "
// <tr>
// 		<td>$pcode</td>
// 		<td>$batchno</td>
// 		<td>$expdate</td>
// 		<td>$purchase</td>
// 		<td>$pbonus</td>
// 		<td>$ptotal</td>
// 		<td>$inhand</td>
// 		<td>$sale</td>
// 		<td>$bsale</td>
// 		<td>$totalsale</td>
// 		<td>$baki</td>
		
// 	</tr>
// 	";

	// $qf="update stockdetail set inhand='$baki' where productcode='$pcode' and batchno='$batchno' and expdate='$expdate' and mrp='$mrp'";
	// $sf=$dbpdo->prepare($qf);
	// $sf->execute();

}
?>
</tbody>
</table>

<?php
include "include/footer.php";
?>



