<?php 
include "secure.php";
include "include/header.php";
date_default_timezone_set("Asia/Karachi");
$date=date("Y-m-d");

?>

<style>
@import url('https://fonts.googleapis.com/css2?family=Roboto&display=swap');

    @media print {


    .pagebreak { page-break-before: always; } /* page-break-after works, as well */

    .hrow  {
    background-color: #333 !important;
    color: white;
    page-break-before: always;
    
}
.hrow td {
    font-family: 'Roboto', sans-serif;
    height: 15px !important;
    font-size: 12px !important;
    border: 1px solid white;
    line-height: 15px !important;
    padding: 1px 0 0 3px !important;
    text-align: center;
    font-weight: bold;

}

.ddrow {
    font-family: 'Roboto', sans-serif;
    height: 15px !important;
    font-size: 10px !important;
    border: 1px solid white;
    line-height: 15px !important;
    padding: 1px 0 0 3px !important;
    border: 1px solid black;

}


 

.totaltext {
    font-size: 26px;
    font-weight: bold;
}


 
 @page { size: auto;  margin: 1px 40px 5px 12px; }
    html, body {
        height: auto;
        font-size: 10px; /* changing to 10pt has no impact */
        
    }

    
 

}

.hrow  {
    background-color: #584F4F !important;
    color: white;
    page-break-before: always;
    
}
.hrow td {
    font-family: 'Roboto', sans-serif;
    height: 15px !important;
    font-size: 12px !important;
    border: 1px solid white;
    line-height: 15px !important;
    padding: 1px 0 0 3px !important;
    text-align: center;
    font-weight: bold;
    background-color: #584F4F !important;

}

.ddrow {
    font-family: 'Roboto', sans-serif;
    height: 15px !important;
    font-size: 10px !important;
    border: 1px solid white;
    line-height: 15px !important;
    padding: 1px 0 0 3px !important;
    border: 1px solid black;

}

td {
     font-family: 'Roboto', sans-serif;
    height: 15px !important;
    font-size: 10px !important;
     line-height: 15px !important;
     padding: 1px 0 0 3px !important;
}
 

.totaltext {
    font-size: 26px;
    font-weight: bold;
}

    </style>
  
</head>

<body >
  <!-- <div class="loader"></div> -->
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
              
      <div class="row">
      
      <div class="col-sm-3">
      <div class="form-group">
    <label for="field-3" >Select Start Date<span class="required">*</span></label>
  
   <div class="input-group">
     <input type="text" class="form-control datepicker" place="Start Date" name=sdate id="sdate" autocomplete="off" value=<?php echo $date ?> >
   </div>
   </div>
   </div>
   
<div class="col-sm-3">
<div class="form-group">
<label for="field-3" >Select End Date<span class="required">*</span></label>

<input type="text" class="form-control datepicker" place="Start Date" name=edate id="edate" autocomplete="off" value=<?php echo $date ?> >
</div>
</div>

     
   <div class="col-sm-3">
<div class="form-group">
<label for="field-3" >Select Company<span class="required">*</span></label>
<select name="companycode" id="companycode" class="form-control" >
    <option value="">Select Company</option>
  
  <?php
$s=$dbpdo->prepare("select * from customers where customertype=2");
$s->execute();
while($row = $s->fetch(PDO::FETCH_BOTH)){
echo "<option value='$row[0]'>$row[2]</option>";
}
?>
</select>
      </div>
       </div>
   
<div class="col-sm-3">
<div class="form-group">
<label for="field-3" >Select Group<span class="required">*</span></label>
<div class="input-group">
<select name="groupcode" id="groupcode" class="form-control" >
 

</select>
<div class="input-group-append">
<button type=submit class="btn btn-danger mx-2"><i class="fa fa-search"></i></button>

</div>
   
      
      </div>
      </div>
       </div>
       </div>
     </form>
       
       </div>
       </div>
       </div></div>
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h3>Sale Stock Report</h3>
					
                  </div>
                  <div class="card-body">
                    <div class='table-responsive'>
<table class='table  text-dark mb-2' id='user_data' style='width:100%;'>
                        
<thead>
<tr style='display:none'>
<th ></th><th ></th><th ></th><th ></th><th ></th><th ></th><th ></th><th ></th><th ></th>
<th ></th><th ></th><th ></th><th ></th><th ></th><th ></th><th ></th><th ></th><th ></th>
</tr>
</thead>
<tbody>
    <?php 

    

 if(!empty($_POST)) 
 {
    $sdate=$_POST['sdate'];
    $edate=$_POST['edate'];

    $newdate1=date("M d, Y",strtotime($sdate));
    $newdate2=date("M d, Y",strtotime($edate));
    $pdate="<h3>From ".$newdate1." To ".$newdate2."</h3>";
    $edate=$_POST['edate'];
    $compnaycode=$_POST['companycode'];
    $groupcode=$_POST['groupcode'];

    $data="<tr>
<th >$pdate</th><th ></th><th ></th><th ></th><th ></th><th ></th><th ></th><th ></th><th ></th>
<th ></th><th ></th><th ></th><th ></th><th ></th><th ></th><th ></th><th ></th><th ></th>
</tr>";
  
if($groupcode!=0)
    $q="SELECT a.gname,b.name,c.id,c.name,c.mrp,c.tp,a.id FROM `companygroups`as a ,`customers` as b ,`products` as c where a.ccode=$compnaycode and a.ccode=b.id and a.id=c.gcode and c.gcode=$groupcode order by c.gcode,c.name";
else
    $q="SELECT a.gname,b.name,c.id,c.name,c.mrp,c.tp,a.id FROM `companygroups`as a ,`customers` as b ,`products` as c where a.ccode=$compnaycode and a.ccode=b.id and a.id=c.gcode order by c.gcode,c.name";
$aid=0;

$s=$dbpdo->prepare($q);
$s->execute();
$cnt=0;
$sum1=0;
$sum2=0;
$sum3=0;
$sum4=0;
$sum5=0;
$sum6=0;
$sum7=0;
$sum8=0;
$tsum1=0;
$tsum2=0;
while($row = $s->fetch(PDO::FETCH_BOTH)){
    $cnt++;
    $gid=$row[6];
    $gname=$row[0];


 if($gid != $aid && $cnt!=1)
    {
        

        $data.= "<tr >
        <td class='hrow'></td><td class='hrow'></td>
        <td class='hrow'></td><td class='hrow'>$sum1</td>
        <td class='hrow'></td><td class='hrow'>$sum2</td>
        <td class='hrow'></td><td class='hrow'>$sum3</td>
        <td class='hrow'></td><td class='hrow'>$sum4</td>
        <td class='hrow'></td><td class='hrow'>$sum5</td>
        <td class='hrow'></td><td class='hrow'>$sum6</td>
        <td class='hrow'></td><td class='hrow'>$sum7</td>
        <td class='hrow'></td><td class='hrow'>$sum8</td>
        
        </tr>";

        $data.= "<tr class='noline'>
        <td style='display:none' class='noline'></td>
        <td style='display:none' class='noline'></td>
        <td style='display:none' class='noline'></td>
        <td style='display:none' class='noline'></td>
        <td style='display:none' class='noline'></td>
        <td style='display:none' class='noline'></td>
        <td style='display:none' class='noline'></td>
        <td style='display:none' class='noline'></td>
        <td style='display:none' class='noline'></td>
        <td style='display:none' class='noline'></td>
        <td style='display:none' class='noline'></td>
        <td style='display:none' class='noline'></td>
        <td style='display:none' class='noline'></td>
        <td style='display:none' class='noline'></td>
        <td style='display:none' class='noline'></td>
        <td style='display:none' class='noline'></td>
        <td style='display:none' class='noline'></td>
        <td colspan=18 class='totaltext noline' align='right'>Grand Total Sale:$sum7</td>
        ";
        $data.= "<tr class='noline'>
        <td style='display:none' class='noline'></td>
        <td style='display:none' class='noline'></td>
        <td style='display:none' class='noline'></td>
        <td style='display:none' class='noline'></td>
        <td style='display:none' class='noline'></td>
        <td style='display:none' class='noline'></td>
        <td style='display:none' class='noline'></td>
        <td style='display:none' class='noline'></td>
        <td style='display:none' class='noline'></td>
        <td style='display:none' class='noline'></td>
        <td style='display:none' class='noline'></td>
        <td style='display:none' class='noline'></td>
        <td style='display:none' class='noline'></td>
        <td style='display:none' class='noline'></td>
        <td style='display:none' class='noline'></td>
        <td style='display:none' class='noline'></td>
        <td style='display:none' class='noline'></td>
        <td colspan=18 class='totaltext noline' align='right'>Closing Value:$sum8<div class='brow'></div></td>
        ";
        $tsum1+=$sum7;
        $tsum2+=$sum8;
        $sum1=0;
$sum2=0;
$sum3=0;
$sum4=0;
$sum5=0;
$sum6=0;
$sum7=0;
$sum8=0;
    }

        
        
 if($gid != $aid)
    {

        

        $data.= "<tr  >
        <td colpsan='17' class='noline' style='height:50px !important;padding:10px !important'><h5>$gname<h5></td>
        <td style='display:none'></td><td style='display:none'></td><td style='display:none'></td>
        <td style='display:none'></td><td style='display:none'></td><td style='display:none'></td>
        <td style='display:none'></td><td style='display:none'></td><td style='display:none'></td>
        <td style='display:none'></td><td style='display:none'></td><td style='display:none'></td>
        <td style='display:none'></td><td style='display:none'></td><td style='display:none'></td>
        <td style='display:none'></td><td style='display:none'></td></tr>";

        $data.= "<tr >
        <td class='hrow'></td><td class='hrow'></td>
        <td colspan=2 aling='center' class='hrow'>Opening</td><td style='display:none'></td>
        <td colspan=2 aling='center' class='hrow'>Purchase</td><td style='display:none'></td>
        <td colspan=2 aling='center' class='hrow'>Purchase-R</td><td style='display:none'></td>
        <td colspan=2 aling='center' class='hrow'>Available Stock</td><td style='display:none'></td>
        <td colspan=2 aling='center' class='hrow'>Sale</td><td style='display:none'></td>
        <td colspan=2 aling='center' class='hrow'>Sale-R</td><td style='display:none'></td>
        <td colspan=2 aling='center' class='hrow'>Net Sale</td><td style='display:none'></td>
        <td colspan=2 aling='center' class='hrow'>Closing</td><td style='display:none'></td>
        </tr>";

        $data.= "

        <tr >
        <td class='hrow'>Product Name</td><td class='hrow'>T.P</td>
        <td class='hrow'>Qty</td><td class='hrow'>Value</td>
        <td class='hrow'>Qty</td><td class='hrow'>Value</td>
        <td class='hrow'>Qty</td><td class='hrow'>Value</td>
        <td class='hrow'>Qty</td><td class='hrow'>Value</td>
        <td class='hrow'>Qty</td><td class='hrow'>Value</td>
        <td class='hrow'>Qty</td><td class='hrow'>Value</td>
        <td class='hrow'>Qty</td><td class='hrow'>Value</td>
        <td class='hrow'>Qty</td><td class='hrow'>Value</td>
        
    </tr>
        
    ";

        
        $aid=$gid;
        
        }
    
$pid=$row[2];
$productname=$row[3];
$mrp=$row[4];
$tp=$row[5];
$tpv=round($mrp-($mrp*$tp/100),2);


$trow=$dbpdo->query("SELECT sum(quantity) as total from stockdetail where productcode='$pid' and  tableid IN (SELECT id FROM stock where date<'$sdate')")->fetch(PDO::FETCH_NUM); 
$pqty=$trow[0];

$trow=$dbpdo->query("SELECT sum(quantity) as total  from stockreturndetail where productcode='$pid' and  tableid IN (SELECT id FROM stockreturn where date<'$sdate')")->fetch(PDO::FETCH_NUM); 
$pqty1=$trow[0];

$totalpurchaseqty=$pqty-$pqty1;
$trow=$dbpdo->query("SELECT sum(quantity) as total  from saledetail where productcode='$pid' and tableid IN (SELECT id FROM sale where date<'$sdate')")->fetch(PDO::FETCH_NUM); 
$sqty=$trow[0];


$trow=$dbpdo->query("SELECT sum(quantity) as total from salereturndetail where productcode='$pid' and tableid IN (SELECT id FROM salereturn where date<'$sdate')")->fetch(PDO::FETCH_NUM); 
$sqty1=$trow[0];

$totalsaleqty=$sqty-$sqty1;

$openingqty=abs($totalpurchaseqty-$totalsaleqty);

if($openingqty>0) $amount1=round($openingqty*$tpv); else $amount1=0;
$sum1+=$amount1;


$trow=$dbpdo->query("SELECT sum(quantity) as total  from stockdetail where productcode='$pid' and  tableid IN (SELECT id FROM stock where date>='$sdate' and date<='$edate')")->fetch(PDO::FETCH_NUM); 
$purchaseqty=$trow[0];
if($purchaseqty) {
$amount2=round($purchaseqty*$tpv);
} 
else {
    $purchaseqty=0;
    $amount2=0;
}
$sum2+=$amount2;


$trow=$dbpdo->query("SELECT sum(quantity) as total,sum(subamount)  from stockreturndetail where productcode='$pid' and  tableid IN (SELECT id FROM stockreturn where date>='$sdate' and date<='$edate')")->fetch(PDO::FETCH_NUM); 
$preturnqty=$trow[0];
if($preturnqty) {
$amount3=round($preturnqty*$tpv);
} 
else {
    $preturnqty=0;
    $amount3=0;
}
$sum3+=$amount3;

$astock=$openingqty+$purchaseqty-$preturnqty;
$astockprice=$amount1+$amount2-$amount3;
$sum4+=$astockprice;

$trow=$dbpdo->query("SELECT sum(quantity) as total,sum(subamount)  from saledetail where productcode='$pid' and  tableid IN (SELECT id FROM sale where date>='$sdate' and date<='$edate')")->fetch(PDO::FETCH_NUM); 
$saleqty=$trow[0];
$saleamount=$trow[1];
if($saleqty) {
$amount4=round($saleamount);
} 
else {
    $saleqty=0;
    $amount4=0;
}
$sum5+=$amount4;


$trow=$dbpdo->query("SELECT sum(quantity) as total,sum(subamount)  from salereturndetail where productcode='$pid' and  tableid IN (SELECT id FROM salereturn where date>='$sdate' and date<='$edate')")->fetch(PDO::FETCH_NUM); 
$sreturnqty=$trow[0];
$salereturnamount=$trow[1];
if($sreturnqty) {
$amount5=round($salereturnamount);
} 
else {
    $sreturnqty=0;
    $amount5=0;
}
$sum6+=$amount5;

$netsaleqty=$saleqty-$sreturnqty;
$netsaleamount=round($amount4-$amount5);
$sum7+=$netsaleamount;

$closingstock=$astock-$netsaleqty;
$closingamount=round($closingstock*$tpv);
$sum8+=$closingamount;

$data.= "<tr>
    <td class='ddrow'>$productname </td>
    <td class='ddrow'>$tpv</td>
    <td class='ddrow'>$openingqty</td>
    <td class='ddrow'>$amount1</td>
    <td class='ddrow'>$purchaseqty</td>
    <td class='ddrow'>$amount2</td>
    <td class='ddrow'>$preturnqty</td>
    <td class='ddrow'>$amount3</td>
    <td class='ddrow'>$astock</td>
    <td class='ddrow'>$astockprice</td>
    <td class='ddrow'>$saleqty</td>
    <td class='ddrow'>$amount4</td>
    <td class='ddrow'>$sreturnqty</td>
    <td class='ddrow'>$amount5</td>
    <td class='ddrow'>$netsaleqty</td>
    <td class='ddrow'>$netsaleamount</td>
    <td class='ddrow'>$closingstock</td>
    <td class='ddrow'>$closingamount</td>


</tr>";



}


        $data.= "<tr class='hrow'>
        <td></td><td></td>
        <td></td><td>$sum1</td>
        <td></td><td>$sum2</td>
        <td></td><td>$sum3</td>
        <td></td><td>$sum4</td>
        <td></td><td>$sum5</td>
        <td></td><td>$sum6</td>
        <td></td><td>$sum7</td>
        <td></td><td>$sum8</td>
        
        </tr>";

        $data.= "<tr>
        <td style='display:none' class='noline'></td>
        <td style='display:none' class='noline'></td>
        <td style='display:none' class='noline'></td>
        <td style='display:none' class='noline'></td>
        <td style='display:none' class='noline'></td>
        <td style='display:none' class='noline'></td>
        <td style='display:none' class='noline'></td>
        <td style='display:none' class='noline'></td>
        <td style='display:none' class='noline'></td>
        <td style='display:none' class='noline'></td>
        <td style='display:none' class='noline'></td>
        <td style='display:none' class='noline'></td>
        <td style='display:none' class='noline'></td>
        <td style='display:none' class='noline'></td>
        <td style='display:none' class='noline'></td>
        <td style='display:none' class='noline'></td>
        <td style='display:none' class='noline'></td>
        <td colspan=18 class='totaltext noline' align='right'>Grand Total Sale:$sum7</td>
        </tr>
        ";
        $data.= "<tr>
        <td style='display:none' class='noline'></td>
        <td style='display:none' class='noline'></td>
        <td style='display:none' class='noline'></td>
        <td style='display:none' class='noline'></td>
        <td style='display:none' class='noline'></td>
        <td style='display:none' class='noline'></td>
        <td style='display:none' class='noline'></td>
        <td style='display:none' class='noline'></td>
        <td style='display:none' class='noline'></td>
        <td style='display:none' class='noline'></td>
        <td style='display:none' class='noline'></td>
        <td style='display:none' class='noline'></td>
        <td style='display:none' class='noline'></td>
        <td style='display:none' class='noline'></td>
        <td style='display:none' class='noline'></td>
        <td style='display:none' class='noline'></td>
        <td style='display:none' class='noline'></td>
        <td colspan=18 class='totaltext noline' align='right'>Closing Value:$sum8</td>
        </tr>
        ";

        $tsum1+=$sum7;
        $tsum2+=$sum8;

        $data.= "<tr>
         <td colspan=2  class=' totaltext noline'  align='right'>Total Sale of Company:-</td>
        <td colspan=7 class='totaltext noline' align='left'>$tsum1</td>
        <td style='display:none' class='noline'></td>
        <td style='display:none' class='noline'></td>
        <td style='display:none' class='noline'></td>
        <td style='display:none' class='noline'></td>
        <td style='display:none' class='noline'></td>
        <td style='display:none' class='noline'></td>
        <td style='display:none' class='noline'></td>
        <td style='display:none' class='noline'></td>
       
        ";
        $data.= "
        <td colspan=2 class='totaltext noline' align='right'>Closing Value of Company:-</td>
        <td colspan=6 class='totaltext noline' align='left'>$tsum2</td>
        <td style='display:none' class='noline'></td>
        <td style='display:none' class='noline'></td>
        <td style='display:none' class='noline'></td>
        <td style='display:none' class='noline'></td>
        <td style='display:none' class='noline'></td>
        <td style='display:none' class='noline'></td>
       
        
       
        
        </tr>
        ";



        echo $data;
    }
      
  
?>


                      
               </tbody>
               </table>   

               <form target="_blank" method=post id="printform" action="print-salestock.php">
                <input type=hidden name=data value="<?php echo $data ?>">
               </form> 
                 
               </div>
            </div></div>
            </div>
              </div>
            </div>
          </div></section>
      </div>
        

        
     <?php include "include/footer.php";?>
	 
    
   

<script type="text/javascript" language="javascript" >
 
 $(document).ready(function(){


    $("#companycode").change(function(e) {
  e.preventDefault();
  var cid=$("#companycode").val();
  $.post("ajaxcall/getgroups1.php",{id:cid},function(result){
  $("#groupcode").empty().append(result);
  
  });
  });


$("#f3").change(function(){

var cid=$("#f3").val();
  $.post("ajaxcall/getbalance.php",{cid:cid},function(result){
    $("#ff3").val(result);

  })

});



  
  fetch_data();


   function fetch_data()
  {
    
   var dataTable = $('#user_data').DataTable({
     
        
      
     "pageLength": -1,
    
     
         
        
               "dom": "<'row '<'col-md-12'B>><'row'<'col-md-12'>><'row'<'col-md-12'rt>>",
      buttons: [

      {
       text: 'Print ',
       className: "buttons-print",
      action: function ( e, dt, button, config ) {
       $("#printform").submit();
        } 
        
        },  
       


            
            { extend: 'excel', footer: true },
            { extend: 'pdf', footer: true,  orientation: 'landscape', 
                     customize: function (doc) {
        
        
        
        doc.pageMargins = [20, 60, 20, 30];
        // Set the font size fot the entire document
        doc.defaultStyle.fontSize = 7;
        // Set the fontsize for the table header
        doc.styles.tableHeader.fontSize = 7;
        
       
       
        // Change dataTable layout (Table styling)
        // To use predefined layouts uncomment the line below and comment the custom lines below
        // doc.content[0].layout = 'lightHorizontalLines'; // noBorders , headerLineOnly
        var objLayout = {};
        objLayout['hLineWidth'] = function (i) {return .5;};
        objLayout['vLineWidth'] = function (i) {return .5;};
        objLayout['hLineColor'] = function (i) {return '#aaa';};
        objLayout['vLineColor'] = function (i) {return '#aaa';};
        objLayout['paddingLeft'] = function (i) {return 4;};
        objLayout['paddingRight'] = function (i) {return 4;};
        doc.content[0].layout = objLayout;
      }    

},
            { extend: 'colvis', footer: true },
            
   
            


          
       
        
        ],



    


    
    "order" : [],

      
  
  
  
  
 
  
  
  
   });
   
  }
  
  

 });
 </script>

	 