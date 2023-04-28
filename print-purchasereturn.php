<?php 
include "secure.php";
include "include/header.php";
date_default_timezone_set("Asia/Karachi");
$date=date("d M, Y");
$row=$dbpdo->query("SELECT *  FROM `stockreturn` WHERE id=".$_GET['code'])->fetch(PDO::FETCH_NUM);
$sid=$row[0];
$cdate=$row[1];
$date1 = date("Ymd", strtotime($cdate));
$date2 = date("d-m-Y", strtotime($cdate));
$cid=$row[2];
$trow=$dbpdo->query("SELECT name from `customers` 
where id='$cid'")->fetch(PDO::FETCH_NUM);
$company=$trow[0];
$conton=$row[3];
$corier=$row[4];
$corierno=$row[5];
$invoice=$row[6];
$rdate=$row[7];
$page=$row[8];
$date3 = date("Ymd", strtotime($rdate));
$date4 = date("d-m-Y", strtotime($rdate));
$tax=$row[10];
$net=0;
$drow=$dbpdo->query("SELECT sum(totalamount) from stockdetail where tableid='$sid' ")->fetch(PDO::FETCH_NUM);
$bill=$drow[0];
if($tax)
$taxamount=round($bill*$tax/100,2);
else
$taxamount=0;
$net=round($bill+$taxamount,2);
?>
<style>
  @import url('https://fonts.googleapis.com/css2?family=Roboto&display=swap');
body {
  background: white !important;
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
  padding: 10px !important;
  font-size:16px;
  font-weight: bold;
  border: 1px solid black !important;
}
td {
  font-family: 'Roboto', sans-serif;
    height: 30px !important;
    font-size: 14px !important;
    border: 1px solid white;
    line-height: 30px !important;
    padding: 1px 5 0 5px !important;
    border: 1px solid black;
}
table tfoot {
    display: table-row-group;
    font-size: 14px;
    font-weight: bold;
    border-top: 1px solid black;
}
.nikabox {
  padding: 10px;


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
    <div class="col-3 mt-5"><h5>Purchase Return Invoice</h5>
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
<img  src='barcode/barcode.php?codetype=Code39&size=40&text=778283".$sid."&print=true'/>";
?>
</p>
Print Date:-&nbsp;&nbsp;&nbsp;<b><?php echo $date ?></b>
    </div>
  </div>
  
  
  </div>
  
  <div class="row">
    <div class="col-4">
      </span>
      <span class="subtitle">Company ID:<span class="text">&nbsp;&nbsp;<?php echo $row[2]?></span></span>
      <span class="subtitle">Company Name:<span class="text">&nbsp;&nbsp;<?php echo $company?></span>
    </div>
    <div class="col-4"></div>
    <div class="col-4">
      <span class="subtitle">Courier Services: <span class="text">&nbsp;&nbsp;<?php echo $corier?></span>
      <span class="subtitle">Courier #:<span class="text">&nbsp;&nbsp;<?php echo $corierno?></span>
      
    </div>
  </div>
  <div class="d-flex justify-content-between chota mb-5">
    <div class="nikabox">Total Cotton:&nbsp;&nbsp;<?php echo $conton ?></div>
    <div class="nikabox">Ref Date:&nbsp;&nbsp;<?php echo $date4?></div>
    <div class="nikabox">Page #:&nbsp;&nbsp;<?php echo $page ?></div>
    
  </div>
  <div class="row">
    <table class="table ">
      <thead>
<th>Product name</th>
<th>T.P</th>
<th>Qty</th>
<th>Bonus</th>
<th>Batch</th>
<th>Exp-Date</th>
<th>Gross</th>
<th>Discount</th>
<th>Taxable Amount</th>
<th>Sale Tax</th>
<th>Futher Tax</th>
<th>Total</th>
      </thead>
      <tbody>
        <?php 

$ds=$dbpdo->prepare("select * from stockreturndetail where tableid='$sid'");
$ds->execute();
while($drow = $ds->fetch(PDO::FETCH_BOTH)){
  $pcode=$drow[2];
  $trow=$dbpdo->query("SELECT name from `products` 
where id='$pcode'")->fetch(PDO::FETCH_NUM);
$pname=$trow[0];
$g=round($drow[6]*$drow[11],2);
$tamount=round(($g-$drow[12]),2);


$expdate=date("d-m-Y",strtotime($drow[5]));
if($drow[12])
$discount=$drow[12];
else $discount=0;

echo "
<tr>
<td>$pname</td>
<td>$drow[11]</td>
<td>$drow[6]</td>
<td>$drow[7]</td>
<td>$drow[4]</td>
<td>$expdate</td>
<td>$g</td>
<td>$drow[12]</td>
<td>$tamount</td>
<td>$drow[13]</td>
<td>$drow[17]</td>
<td>$drow[9]</td>
</tr>
";
}

echo "
<tfoot>
<tr>
<td  colspan=11>Net Total</td>
<td>".round($bill)."</td>
</tr>
<tr>
<td  colspan=11>Tax</td>
<td>$taxamount</td>
</tr>
<tr>
<td  colspan=11>Grand Total</td>
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

</div>
<body >
  <script>
  
  (function() {

    var beforePrint = function() {
        console.log('Functionality to run before printing.');
    };

    var afterPrint = function() {
    
  setTimeout(function(){ 
    if(history.back()==undefined)  window.close();
    else 
    window.location =history.back(); }, 1000);
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