<?php 
include "secure.php";
include "include/header.php";
date_default_timezone_set("Asia/Karachi");
$date=date("d M, Y");
$code=$_GET['code'];
$row=$dbpdo->query("SELECT date,salemanid from payments where id='$code'")->fetch(PDO::FETCH_NUM);
$salemancode=$row[1];
$date=$row[0];
$q2="SELECT sum(debit) FROM `payments` where salemanid='$salemancode' and date='$date'";
$stmt23 = $dbpdo->prepare($q2);
$stmt23->execute();
$row = $stmt23->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_NEXT);
$total=$row[0];
$vno=date("dm",strtotime($date))."-".$salemancode;
$row=$dbpdo->query("SELECT name from customers where id='$salemancode'")->fetch(PDO::FETCH_NUM);
$salemanname=$row[0];
?>
<style>
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
  border: 1px solid rgba(0,0,0,0.3);
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
    <div class="col-3 mt-5"><h5>Cash Receipt</h5>
      <p>
<span class="subtitle">Date:&nbsp;&nbsp;<?php echo date("d M,Y",strtotime($date))?></span>
</p>

<p>
<h5>Invoice ID:&nbsp;&nbsp;&nbsp;<?php echo $vno?></h5>

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
<img  src='barcode/barcode.php?codetype=Code39&size=40&text=77".$vno."&print=true'/>";
?>
</p>
Print Date:-&nbsp;&nbsp;&nbsp;<b><?php echo $date ?></b>
    </div>
  </div>
  
  
  </div>
  
  

  <div class="d-flex justify-content-between my-3">
  <span class="subtitle">Saleman Code:<?php echo $salemancode?></span>
  <span class="subtitle">Saleman Name:<?php echo $salemanname?></span>
     
   
  </div>

  <table class="table  my-5" style="width:100%;">
                        
<thead>
<tr>
<th >Id</th>
<th >Date</th>
<th >Name</th>
<th >Payment Mode</th>
<th >Description</th>
<th >Amount</th>

</tr>
</thead>
<tbody>
<?php 

$q2="select a.*,b.name,c.pmode
from payments as a ,customers as b,paymentmode as c
where a.cid=b.id and a.paymentmode=c.id and salemanid='$salemancode' and a.paymentmode<>1 and a.date ='$date'  order by date";
$stmt23 = $dbpdo->prepare($q2);
$stmt23->execute();
$trecord=$stmt23->rowCount();
if($trecord)
{ 
$n=0;
while ($row = $stmt23->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_NEXT))
{
$cdate=$row[1];
$date1 = date("Ymd", strtotime($cdate));
$date2 = date("d-m-Y", strtotime($cdate));
 echo "
 <tr>
<td>$row[0]</td>
<td>$date2</td>
<td>$row[10]</td>
<td>$row[11]</td>
<td>$row[6]</td>
<td>$row[8]</td>
<tr>
";
}
}

echo "
 <tr>
<td colspan=5 align='right'><strong>Total</strong></td>
<td><strong>$total</strong></td>
<tr>
";

?>

  </tbody>
</table>

  <div class="d-flex justify-content-end my-5 mr-5" style="margin-top:80px !important">
    <div class="ulo"><strong>Signature</strong></div>
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
    
  setTimeout(function(){ window.location ="rvoucheradvance-list.php" }, 1000);
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

<?php
function numberTowords($num)
{

$ones = array(
0 =>"ZERO",
1 => "ONE",
2 => "TWO",
3 => "THREE",
4 => "FOUR",
5 => "FIVE",
6 => "SIX",
7 => "SEVEN",
8 => "EIGHT",
9 => "NINE",
10 => "TEN",
11 => "ELEVEN",
12 => "TWELVE",
13 => "THIRTEEN",
14 => "FOURTEEN",
15 => "FIFTEEN",
16 => "SIXTEEN",
17 => "SEVENTEEN",
18 => "EIGHTEEN",
19 => "NINETEEN",
"014" => "FOURTEEN"
);
$tens = array( 
0 => "ZERO",
1 => "TEN",
2 => "TWENTY",
3 => "THIRTY", 
4 => "FORTY", 
5 => "FIFTY", 
6 => "SIXTY", 
7 => "SEVENTY", 
8 => "EIGHTY", 
9 => "NINETY" 
); 
$hundreds = array( 
"HUNDRED", 
"THOUSAND", 
"MILLION", 
"BILLION", 
"TRILLION", 
"QUARDRILLION" 
); /*limit t quadrillion */
$num = number_format($num,2,".",","); 
$num_arr = explode(".",$num); 
$wholenum = $num_arr[0]; 
$decnum = $num_arr[1]; 
$whole_arr = array_reverse(explode(",",$wholenum)); 
krsort($whole_arr,1); 
$rettxt = ""; 
foreach($whole_arr as $key => $i){
  
while(substr($i,0,1)=="0")
    $i=substr($i,1,5);
if($i < 20){ 
/* echo "getting:".$i; */
$rettxt .= $ones[$i]; 
}elseif($i < 100){ 
if(substr($i,0,1)!="0")  $rettxt .= $tens[substr($i,0,1)]; 
if(substr($i,1,1)!="0") $rettxt .= " ".$ones[substr($i,1,1)]; 
}else{ 
if(substr($i,0,1)!="0") $rettxt .= $ones[substr($i,0,1)]." ".$hundreds[0]; 
if(substr($i,1,1)!="0")$rettxt .= " ".$tens[substr($i,1,1)]; 
if(substr($i,2,1)!="0")$rettxt .= " ".$ones[substr($i,2,1)]; 
} 
if($key > 0){ 
$rettxt .= " ".$hundreds[$key]." "; 
}
} 
if($decnum > 0){
$rettxt .= " and ";
if($decnum < 20){
$rettxt .= $ones[$decnum];
}elseif($decnum < 100){
$rettxt .= $tens[substr($decnum,0,1)];
$rettxt .= " ".$ones[substr($decnum,1,1)];
}
}
return $rettxt;
}
?>