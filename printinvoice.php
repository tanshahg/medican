<?php include "secure.php";
include "include/header.php";
date_default_timezone_set("Asia/Karachi");
$date=date("Y-m-d");
$title="Daily Invoice Report";
if(isset($_POST['sdate']))
        {

        $sdate=date("d M Y",strtotime($_POST['sdate']));
        $edate=date("d M Y",strtotime($_POST['edate']));
        $title=" Daily Invoice Report from $sdate to $edate";
    }
    ?>

<script>
 document.title = "<?php echo $title ?>";
 </script>
<link rel="stylesheet" href="assets/css/compact.css">
  <style>
    

    .before {
        page-break-before: always;
      }
      .after {
        page-break-after: always;
      }
      

      #pprint {
        margin:0px !important;
        padding:0px !important;

      }

.box {
  width:96%;
  border: 1px solid rgba(0,0,0,0.7);
  padding: 10px;
  margin:0px auto;
 }
 .table {
  width:100%;
  border: 1px solid rgba(0,0,0,0.7);
  padding: 5px !important;
  margin:2px 30px 0px 10px;

 }
.uline {
  width: 300px;
  margin: 0 auto;
  border-bottom: 5px solid black;
  

}
.address {
  
  font-family: Verdana;
  font-size: 10px;
  font-weight: bold;
  line-height: 15px;
  color:#000 !important;
}
.subtitle {
  font-size: 12px !important;;
  font-weight: bold;
  display: block;
  color:#000 !important;
  
}
.text {
  font-size: 12px !important;
  font-weight: bold !important;
}
.chota {
  font-size: 12px;
  font-weight: bold;
  border: 1px solid black;
  
}

td {
  border: 1px solid rgba(0,0,0,0.3);
  font-size:10px !important;
  padding:2px !important;
  height:20px !important;
  font-weight: bold;
}
th {
    background:none !important;
    background-color:none !important;
    font-size:10px !important;
    height:20px !important;
    padding:2px !important;
    color:#000 !important;
    font-weight: bold;
}
table tfoot {
    display: table-row-group;
    font-size: 10px;
    font-weight: bold;
    border-top: 1px solid black;
}
.nikabox {
  padding: 10px;


}
.war {
  font-size: 8px;
  padding: 10px;
  margin: 20px 100px 2px 100px;
  font-weight: bold;
  color: #333;
  
}



@media print {
 
 @page { size: auto;  margin: 1px 40px 5px 12px; }
    }

</style>
  
</head>

<body>

  
  <?php include "include/menu.php"; ?>
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-body">
      <div class="row">
      
      <div class="col-12 col-sm-6 offset-sm-3 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-6 offset-xl-3">
            <div class="card card-primary">
                        <div class="card-body ">
      <form class="forms-sample" method=post id="search-form">  
              
      <div class="row justify-content-center">

        <div class="col-sm-4">
      <div class="form-group">
    <label for="field-3" >From<span class="required">*</span></label>
     <input type="text" class="form-control" placeholder="From" name="f1" id="f1">
   </div>
   </div>

    <div class="col-sm-4">
      <div class="form-group">
    <label for="field-3" >To<span class="required">*</span></label>
    <div class="input-group">
     <input type="text" class="form-control" placeholder="TO"  name="f2" id="f2">
      <button type=submit class="btn btn-danger mx-2" stlye="marin"><i class="fa fa-search"></i></button>

   </div>
   </div>
   </div>

   



       </div>
     </form>
       
       </div>
       </div>
       </div>


   </div>
      


                    <?php 

  if(!empty($_POST['f1']) && !empty($_POST['f2']))
        {
            $output="";
          
        
        
        $f1=$_POST['f1'];
        $f2=$_POST['f2'];
        $list=[];
        for($i=$f1;$i<=$f2;$i++)
            $list[]=$i;
          if(count($list))
 {   
        $ids = implode (", ", $list);
        
     
$q2="SELECT id FROM `sale` where  id IN(".$ids.") order by id";

$stmt23 = $dbpdo->prepare($q2);
$stmt23->execute();
$trecord=$stmt23->rowCount();
if($trecord==0)
{ 
echo "<h1 class='text-center'>No data found check voucher no</h1>";
exit;
  }
if($trecord)
{ 
$n=0;
while ($crows = $stmt23->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_NEXT))
{
    $n++;
$code=$crows[0];
date_default_timezone_set("Asia/Karachi");
$date=date("d M, Y");
$row=$dbpdo->query("SELECT *  FROM `sale` WHERE id=".$code)->fetch(PDO::FETCH_NUM);
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

$date1=date('d M,Y',strtotime($row[1]));
$output.="
  
<div class='box'>
  <div class='row'>
    <div class='col-3 mt-5'><h6>Sale  Invoice</h6>
      <p>
<span class='subtitle'>Date:&nbsp;&nbsp;$date1</span>
</p>

<p>
<h6>Invoice ID:&nbsp;&nbsp;&nbsp;".$row[0]."</h6>
</p>

    </div>
    <div class='col-6 text-center pt-5'><h5>Mohammad Medicine Company</h5>
      <div class='uline'></div>
<div class='text-center address'>Khushal Town Near Daraban Choungi Dera Ismail Khan</div>
      <div class='text-center address'>Contact detail:. 03327239656
03327241482</div>
    </div>
    <div class='col-3 text-right'>
      <img src='assets/img/logo1.png' width=70>
      <p>
       
<img  src='barcode/barcode.php?codetype=Code39&size=40&text=888283'".$sid."'&print=true'/>';

</p>
Print Date:-&nbsp;$date
    </div>
  </div>
  
  
  </div>

  
  <div class='row' style='margin-top:10px'>
    <div class='col-6'>
      
      <span class='subtitle'>Customer ID:<span class='text'>&nbsp;&nbsp;".$row[3]."</span></span>
      <span class='subtitle'>Customer Name:<span class='text'>&nbsp;&nbsp;$customer</span>
    </div>
        <div class='col-6' style='marigh-left:20px'>
      <span class='subtitle'>Sale Area: <span class='text'>&nbsp;&nbsp;$area</span>
      <span class='subtitle'>Saleman:<span class='text'>&nbsp;&nbsp;$saleman</span>
      
    </div>
  </div>
  
  <div class='row mt-3'>
    <table class='table '>
      <thead>
<th>Product</th>
<th>T.P</th>
<th>Qty</th>
<th>Bonus</th>
<th>B-Claim</th>
<th>Batch</th>
<th>Exp-Date</th>
<th>Gross</th>
<th>Discount</th>
<th>D-claim</th>
<th>Tax Amount</th>
<th>Sale Tax</th>
<th>Futher Tax</th>
<th>Total</th>
      </thead>
      <tbody>";






$ds=$dbpdo->prepare("select * from saledetail where tableid='$sid'");
$ds->execute();
$sno=$ds->rowcount();
$lo=0;
while($drow = $ds->fetch(PDO::FETCH_BOTH)){
    $lo++;
   $pcode=$drow[2];
  $trow=$dbpdo->query("SELECT name from `products` 
where id='$pcode'")->fetch(PDO::FETCH_NUM);
$pname=$trow[0];
$g=round($drow[6]*$drow[11],2);
$tamount=round($g-$drow[12],2);


$expdate=date("d M Y",strtotime($drow[5]));
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

$output.="
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
if($lo==37)
    $output.="<tr class='after'></tr>";

$output.= "
<tfoot>
<tr>
<th  colspan=13>Net Total</th>
<th>".round($bill)."</th>
</tr>
<tr>
<th  colspan=13>Tax</th>
<th>$taxamount</th>
</tr>
<tr>
<th  colspan=13>Grand Total</th>
<th>".round($net)."</th>
</tr>
</tfoot>
";
    $output.="



      </tbody>
    </table>
    </div>";
    
 if($lo==30)
    $output.="<p class='after'></p>";

$output.="<p class='war'><strong>Warranty</strong><br>
Under sections 23(1) of the Drug Act 1976, I Hina Khalid in Pakistan Currying on Business of Mohammad Medicine Company Khushal Town Near Daraban Choungi DIKHAN do here due this warranty that drugs described are sold by me / Sepecified & control in invoice do not contravene in any way the provsion of the section 23 of the Drug Act 1976.Expiry will be accepted before <b>120 days</b> of expiry date</p>";
  


if($n!=$trecord)
    $output.="<p class='after'></p>";

}
}

echo "
<div style='display:none'>
<div id='pprint'>$output</div>
</div>";

}
}


?>
                    



                      
                   
                 
               </div>
            </div></div>
            </div>
              </div>
            </div>
          </div>
        </section>
        
     <?php include "include/footer.php";?>
<script src="pdf/html2pdf.bundle.js"></script>

<script>

    $(document).ready(function(){

test();
    });
 function test() {
        // Get the element.
        var element = document.getElementById('pprint');
      // Choose pagebreak options based on mode.
        var mode = 'specify';
        var pagebreak = (mode === 'specify') ?
            { mode: '', before: '.before', after: '.after', avoid: '.avoid' } :
            { mode: mode };

        // Generate the PDF.
        html2pdf().from(element).set({
            margin:  0.20,

          filename: 'vouchers.pdf',
          pagebreak: pagebreak,
          jsPDF: {orientation: 'portrait', unit: 'in', format: 'letter', compressPDF: false}
        }).save();
      }
     
    </script>

    </script>
   
   
