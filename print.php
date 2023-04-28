<?php session_start();?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Karlu Computer & Accessories.</title>

	<style>
	@media print {
 
 @page { size: auto;  margin: 1px 40px 5px 12px; }
    html, body {
        height: auto;
        font-size: 10px; /* changing to 10pt has no impact */
        
    }

	table {
        height: auto;
        font-size: 12px; /* changing to 10pt has no impact */
        font-family:"Arial";
        font-weight: bold;
		
    }
	table {
    border-collapse: collapse;
}

 th {
    border: 2px solid black !important;
	font-size:14px;
	padding:5px;
	font-weight: bold;
}
td {
    
    border-left: 1px solid black !important;
    border-right: 1px solid black !important;
    padding:2px;
	
	
}
}
.box {
	border:1px solid black!important;
	padding:5px 5px 15px 15px;
	margin-bottom:10px;
	width:60%;
}

.ms {
	border-bottom: 1px solid black!important;
padding-bottom: 5px;
}
h3 {

	text-align: center;
}

h3 {
  
  font-family:"Hobo Std";
  font-size:30px;
  font-weight: normal;
}

.hh4 {
	font-size:14px;
	text-decoration: underline;

}
.deal {
margin-top:-20px;
text-align: center;
font-size:12px;
}
.bbox { 
	margin-top:0px;
font-size:14px;
font-family:"Arial";
letter-spacing: 1px;
	
	font-weight:bold;
	text-align: center;
	line-height:14px;

 -webkit-print-color-adjust: exact; 
}
.address {
width:100%;
margin:10px auto;
font-family:"Arial";
font-size:14px;
text-align: center;
}
.invoiceto {
	width:100%;
	float:left;
	padding:5px;
	font-family:"Arial";
font-size:14px;
}

.invc {
	font-weight: bold;
}

td {border-bottom:0px solid rgba(0,0,0,0.3) !important;}

.blank  {
	border:0px solid rgba(0,0,0,0.3) !important;
	border-top:1px solid black !important;
	font-family:"Arial"; 
	font-size:10px;
	font-weight: normal;
}

.blank1  {
	border:0px solid rgba(0,0,0,0.3) !important;
	font-family:"sans-serif";text-align: 
	font-size:12px;
}
.half {
    width:68%;
    text-align:center;
    float:left;
    border-right:1px solid black !important;
    border-bottom:1px solid black !important;
    
}
.otherhalf {
    width:30%;
    text-align:center;
    margin-top:25px;
    float:right;
    font-family:"Arial"; 
	font-size:25px;
	font-weight: bold;

}
.invoice{
    width:100px;
    border:2px solid black;
    padding:10px;
    margin:0 auto;
    border-radius:5px;
    font-family:"Arial"; 
	font-size:20px;
}
.rightline {
    margin-top:15px;
    font-size:16px;
    text-align: center;
    font-weight: normal;
}

.lin {
    border-bottom:1px solid black !important
}
	.headingright {
		font-weight: bold;
	}

	.row {
		margin-top:10px;
	}
	.col-8 {
		width:65%;
		float:left;
	}
	.col-4 {
		width:35%;
		float:left;
	}
	.bsbox {
	font-size: 12px; /* changing to 10pt has no impact */
        font-family:"Arial";
        
	font-weight:normal;
	
	
	}
	.lvalue{
		font-size: 12px; /* changing to 10pt has no impact */
        font-family:"Arial";
        font-weight: bold;
	float:right;
	/*border:1px solid black;*/
	
	}
	.tabel1 {
		border:none !important;
		width:100%;
	}
	.tabel1 td {
		border:none !important;
		line-height:18px;
	}
	.lbox {
		font-size: 12px; /* changing to 10pt has no impact */
        font-family:"Arial";
        font-weight: bold;
	float:right;
		border:1px solid black !important;
		padding:5px;
	}
</style>
	</head>
	<body onload="javascript:window.print();">
	<?php
 
include "db.php";
$part1 = array_column($_SESSION["shopping_cart"], 'customerid');
$part2 = array_column($_SESSION["shopping_cart"], 'cname');
$part3 = array_column($_SESSION["shopping_cart"], 'date');
$part4 = array_column($_SESSION["shopping_cart"], 'concession');
$cname=$part2[0];
$cname=str_repeat('&nbsp;', 5).$cname.str_repeat('&nbsp;', 5);
$cid=$part1[0];
$date=$part3[0];
$cons=$part4[0];
					
$ctotal=0;
$output="";
$output1="";
$originalDate = $date;
?>
    <div class="half">
<h3>K-SANI COMPUTERS</h3>
<div class="deal">Deals In:</div>
<div class=bbox>New & Used Computers, Laptop,<br> Printers, LCD’s, LED’s & Accessories</div>
<div class="address">Shop # 9-10, Street # 4, Mehsud Market,<br> East Circular Road, D.I.Khan.<br>
Tel: 0966-714871, 714793 Cell: 0333-9960660
</div>
</div>
<div class="otherhalf">
	<?php 
	if(isset($_SESSION["cashpaid"])) 
		echo '
<div class="invoice">
Credit <br>
Invoice
</div>';
else
	echo "
<div class='invoice'>
Invoice

</div>";
?>






<?php
$newDate = date("d-m-Y", strtotime($originalDate));
if(!empty($_SESSION["warranty"])) $note=$_SESSION["warranty"]; else $note="";
$output.="
<div class='rightline'>Invoice No: <br><span class='headingright'>
<img  src='barcode/barcode.php?codetype=Code39&size=40&text=".$cid."&print=true'/>
</span></div>
<div class='rightline'>Invoice Date: <br><span class='headingright'>$newDate</span></div>
</div>

<div class='invoiceto'>Invoice to: &nbsp;<span class='invc'>$cname</span></div>
<div class='col-lg-12 grid-margin'>
              <div class='card'>
                <div class='card-body'>
<table class='table table-condensed align=center' style='width:100%'>
<thead>
<tr>
<th >S.#</th>
<th >ITEM / DESCRIPTION</th>
<th >QTY</th>
<th >RATE</th>
<th >AMOUNT</th>
</tr>
";
	$id=0;
	$totalline=count($_SESSION["shopping_cart"]);
	foreach($_SESSION["shopping_cart"] as $keys => $values)
	{
		
		$id++;
					$itemcode=$values['itemcode'];
					$itemname=$values['itemname'];
					$itemqty=$values['qty'];
					$itemprice=$values['price'];
					
if($itemqty>0) $ctotal=$ctotal+($itemprice*$itemqty); else $ctotal=$ctotal+$itemprice;
if($itemqty>0) $pprice1=number_format($itemprice*$itemqty); else $pprice1=number_format($itemprice);
$itemprice=number_format($itemprice);
if($itemqty==0) $itemqty="";
$output.="
<tr>
<td align='center'>$id</td>

<td >$itemname</td>
<td align='center'>$itemqty</td>
<td align='right'>$itemprice</td>
<td align='right'>$pprice1</td>
</tr>";
}
if(!empty($note)) $newtotal=18-$totalline; else $newtotal=20-$totalline;
if(isset($_SESSION["cashpaid"])) $newtotal=16-$totalline;

for($i=1;$i<=$newtotal;$i++)
$output.="
<tr>
<td align='center'>&nbsp;</td>

<td >&nbsp;</td>
<td align='center'>&nbsp;</td>
<td align='right'>&nbsp;</td>
<td align='right'>&nbsp;</td>
</tr>";	
$output.="
<tr>
<td style='border-bottom:1px solid black !important'></td>
<td style='border-bottom:1px solid black !important'></td>
<td style='border-bottom:1px solid black !important'></td>
<td style='border-bottom:1px solid black !important'></td>
<td style='border-bottom:1px solid black !important'></td>
</tr>";	

$output.= "</tbody></table>";
$atotal=number_format($ctotal-$cons);
$atotal1=$ctotal-$cons;
$ctotal=number_format($ctotal);
$output.="
<div class='row'>
	<div class='col-8'>";
    if(!empty($note))
    {
    $output.="<span class='lbox'>
$note
</span>
<br>";
    }
    $output.="
<span class='hh4'>NO WARRANTY</span><br><br>
GOODS ONCE SOLD CAN NOT BE RETURNED OR REPLACED<br>
NO WARRANTY ON IMPORTED GOODS<br>
NO BURN & BREAK WARRANTY<br>
<p  style='float:left;margin-top:10px;padding-bottom:20px;border-bottom:1px solid  black;width:100px'><br>Signature</p>
	</div>
	<div class='col-4'>
	<table class='tabel1'>";
	if($cons>0 || isset($_SESSION["cashpaid"]))
	$output.="
<tr><td class='bsbox'>Total</td><td class='lvaluel' align='right'>$ctotal</td</tr>";

else
$output.="
<tr><td class='bsbox'>Total</td><td class='lvaluel'><span class='lbox'>$ctotal</span> </td</tr>";

if($cons>0)
{
$output.="
<tr><td class='bsbox'>
Discount </td><td class='lvalue'>$cons</td></tr>
<tr><td class='bsbox'>Net Total </td><td class='lvalue'><span class='lbox'>$atotal</span></td></tr>";
}
if(isset($_SESSION["cashpaid"]))
{
$cashpaid1=$_SESSION["cashpaid"];
$atotal1=number_format($atotal1-$cashpaid1);
$cashpaid1=number_format($cashpaid1);
$output.="
<tr><td class='bsbox'>cash Paid </td><td class='lvalue'>$cashpaid1</td></tr>
<tr><td class='bsbox'>Credit Amount </td><td class='lvalue'><span class='lbox'>$atotal1</span></td></tr>";
}
$output.="
</tabel>

	</div>
</div>";









echo $output;
?>
</body>
</html>

	<script>
	
	(function() {

    var beforePrint = function() {
        console.log('Functionality to run before printing.');
    };

    var afterPrint = function() {
		
  setTimeout(function(){ window.location ="sale.php"; }, 1000);
    };

    if (window.matchMedia) {
        var mediaQueryList = window.matchMedia('print');
        mediaQueryList.addListener(function(mql) {
            if (mql.matches) {
                beforePrint();
            } else {
                afterPrint();
            }
        });
    }

    window.onbeforeprint = beforePrint;
    window.onafterprint = afterPrint;

}());

	 


</script>