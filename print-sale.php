<?php 
include "secure.php";
include "include/header.php";
date_default_timezone_set("Asia/Karachi");
$date=date("d M, Y");
$row=$dbpdo->query("SELECT *  FROM `sale` WHERE id=".$_GET['code'])->fetch(PDO::FETCH_NUM);
$sid=$row[0];
$cdate=$row[1];
$date1 = date("Ymd", strtotime($cdate));
$date2 = date("d-m-Y", strtotime($cdate));
$cid=$row[3];
$areacode=$row[2];
$salemancode=$row[4];
$invoice=$row[0];
$trow=$dbpdo->query("SELECT name from `customers` 
where id='$cid'")->fetch(PDO::FETCH_NUM);
$customer=$trow[0];
$trow=$dbpdo->query("SELECT `arianame` from `ariainfo` 
where sno='$areacode'")->fetch(PDO::FETCH_NUM);
$area=$trow[0];
$trow=$dbpdo->query("SELECT name from `customers` 
where id='$salemancode'")->fetch(PDO::FETCH_NUM);
$saleman=$trow[0];

$tax=$row[6];
$net=0;
$drow=$dbpdo->query("SELECT sum(totalamount) from saledetail where tableid='$sid' ")->fetch(PDO::FETCH_NUM);
$bill=$drow[0];
if($tax)
$taxamount=round($bill*$tax/100);
else
$taxamount=0;
$net=$bill+$taxamount;
?>
<style>
body {
  background: white !important;
  font-size: 12px !important;
}
.box {
  border: 1px solid rgba(0,0,0,0.7);
  padding: 10px;
  margin-top: 20px;
  margin-bottom: 20px;
}
.uline {
  width: 400px;
  margin: 0 auto;
  border-bottom: 2px solid black;
  margin-bottom: 20px;

}
.address {
  
  font-family: Verdana;
  font-size: 12px;
  font-weight: bold;
  line-height: 15px;
}
.subtitle {
  font-size: 18px;
  font-weight: bold;
  display: block;
  line-height: 40px;
}
.text {
  font-size: 16px !important;
  font-weight: 500 !important;
}
.chota {
  font-size: 14px;
  font-weight: bold;
  border: 1px solid black;
  
}
th {
  padding: 5px !important;
  font-size:16px;
  font-weight: bold;
  border: 1px solid black !important;
}
td {
  border: 1px solid rgba(0,0,0,0.3);
  
  font-size:16px !important;
}
table tfoot {
    display: table-row-group;
    font-size: 16px;
    font-weight: bold;
    border-top: 1px solid black;
}
.nikabox {
  padding: 10px;


}
.war {
  font-size: 12px;
  padding: 10px;
  margin: 100px;
  font-weight: bold;
  color: #333;
  border: 1px solid black;
}

@media print {
 
 @page { size: auto;  margin: 1px 40px 5px 12px; }
    }

</style>
  
  
</head>
<body onload="javascript:window.print();">
<div class="container">
<div class="box">
  <div class="row">
    <div class="col-3 mt-5"><h5>Sale  Invoice</h5>
      <p>
<span class="subtitle">Date:&nbsp;&nbsp;<?php echo date("d M,Y",strtotime($row[1]))?></span>
</p>

<p>
<h5>Invoice ID:&nbsp;&nbsp;&nbsp;<?php echo $row[0]?></h5>

</p>

    </div>
    <div class="col-6 text-center pt-5"><h3>Mohammad Medicine Company</h3>
      <div class="uline"></div>
<div class="text-center address">Khushal Town Near Daraban Choungi Dera Ismail Khan</div>
      <div class="text-center address">Contact detail:. 03327239656
03327241482</div>
    </div>
    <div class="col-3 text-right">
      <img src="assets/img/logo1.png" width=100>
      <p>
       <?php  echo "
<img  src='barcode/barcode.php?codetype=Code39&size=40&text=888283".$sid."&print=true'/>";
?>
</p>
Print Date:-&nbsp;&nbsp;&nbsp;<b><?php echo $date ?></b>
    </div>
  </div>
  
  
  </div>

  
  <div class="row">
    <div class="col-6">
      
      <span class="subtitle">Customer ID:<span class="text">&nbsp;&nbsp;<?php echo $row[3]?></span></span>
      <span class="subtitle">Customer Name:<span class="text">&nbsp;&nbsp;<?php echo $customer?></span>
    </div>
    
    <div class="col-6" style="marigh-left:20px">
      <span class="subtitle">Sale Area: <span class="text">&nbsp;&nbsp;<?php echo $area?></span>
      <span class="subtitle">Saleman:<span class="text">&nbsp;&nbsp;<?php echo $saleman?></span>
      
    </div>
  </div>
  
  <div class="row mt-3">
    <table class="table ">
      <thead>
<th>Product name</th>
<th>T.P</th>
<th>Qty</th>
<th>Bonus</th>
<th>B-Claim</th>
<th>Batch</th>
<th>Exp-Date</th>
<th>Gross</th>
<th>Discount</th>
<th>D-claim</th>
<th>Taxable Amount</th>
<th>Sale Tax</th>
<th>Futher Tax</th>
<th>Total</th>
      </thead>
      <tbody>
        <?php 



$ds=$dbpdo->prepare("select * from saledetail where tableid='$sid'");
$ds->execute();
while($drow = $ds->fetch(PDO::FETCH_BOTH)){
   $pcode=$drow[2];
  $trow=$dbpdo->query("SELECT name from `products` 
where id='$pcode'")->fetch(PDO::FETCH_NUM);
$pname=$trow[0];
$g=round($drow[6]*$drow[11],2);
$tamount=round($g-$drow[12],2);


$expdate=date("d-m-Y",strtotime($drow[5]));
if($drow[12])
$discount=$drow[8]*$drow[12]/100;
else $discount=0;

if(!empty($drow[17]))
{
$dis2=round($drow[8]*$drow[17]/100,2);
$dis2.=" (".$drow[17]."%)";
}
else
  $dis2=null;

echo "
<tr>
<td>$pname</td>
<td>$drow[11]</td>
<td>$drow[6]</td>
<td>$drow[7]</td>
<td>$drow[16]</td>
<td>$drow[4]</td>
<td>$expdate</td>
<td>$g</td>
<td>$drow[12]</td>
<td>$dis2</td>
<td>$tamount</td>
<td>$drow[13]</td>
<td>$drow[15]</td>
<td>$drow[9]</td>
</tr>
";
}

echo "
<tfoot>
<tr>
<td  colspan=13>Net Total</td>
<td>".round($bill)."</td>
</tr>
<tr>
<td  colspan=13>Tax</td>
<td>$taxamount</td>
</tr>
<tr>
<td  colspan=13>Grand Total</td>
<td>".round($net)."</td>
</tr>
</tfoot>
";
        ?>



      </tbody>
    </table>
    </div>
    </div>
  </div>

<p class="war"><span class="h6">Warranty</span><br>
Under sections 23(1) of the Drug Act 1976, I Hina Khalid in Pakistan Currying on Business of Mohammad Medicine Company Khushal Town Near Daraban Choungi DIKHAN do here due this warranty that drugs described are sold by me / Sepecified & control in invoice do not contravene in any way the provsion of the section 23 of the Drug Act 1976.Expiry will be accepted before <b>120 days</b> of expiry date</p>

</div>
<body >
  <script>
  
  (function() {

    var beforePrint = function() {
        console.log('Functionality to run before printing.');
    };

    var afterPrint = function() {
    
  setTimeout(function(){ window.location =history.back(); }, 1000);
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