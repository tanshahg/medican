<?php 
include "secure.php";
include "include/header.php";
date_default_timezone_set("Asia/Karachi");
$date=date("Y-m-d");
?>
<link rel="stylesheet" href="assets/css/compact.css">

  
  
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
      
   

     
   <div class="col-sm-6">
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
   
<div class="col-sm-6">
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
                    <h3>Stock Group + Batch wise Detail</h3>
					
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
<table class="table table-striped table-hover text-dark mb-2" id="user_data" style="width:100%;">
                        
<thead>
<tr>
<th >Proudct Id</th>
<th >Product Name</th>
<th >Batch #</th>
<th >Exp-Date</th>
<th >TP</th>
<th >MRP</th>
<th >Qunantity IN</th>
<th >Bonus</th>
<th >sale</th>
<th >Net Quantity</th>
</tr>
</thead>
<tbody>
<?php 
if(isset($_POST['groupcode']))
        {
       
        $companycode=$_POST['companycode']; 
        $groupcode=$_POST['groupcode']; 
     

if($groupcode==0)
$q="SELECT a.productcode,b.name,c.gname,a.batchno,a.expdate,a.mrp,a.tp,sum(a.quantity) as qty1,sum(a.bonus) as qty2 ,sum(a.inhand) FROM `stockdetail` as a,products as b,companygroups as c  where b.gcode=c.id  and a.productcode=b.id and a.inhand>0 and  b.ccode='$companycode'  GROUP by a.productcode,a.batchno,a.expdate,a.mrp,b.gcode order by b.gcode,a.productcode";
else
$q="SELECT a.productcode,b.name,c.gname,a.batchno,a.expdate,a.mrp,a.tp,sum(a.quantity) as qty1,sum(a.bonus) as qty2 ,sum(a.inhand) FROM `stockdetail` as a,products as b,companygroups as c  where b.gcode=c.id  and a.productcode=b.id and a.inhand>0 and  b.ccode='$companycode' and b.gcode='$groupcode'  GROUP by a.productcode,a.expdate,a.mrp,a.batchno,b.gcode order by b.gcode,a.productcode";

$s=$dbpdo->prepare($q);
$s->execute();
$gname="";
while($row = $s->fetch(PDO::FETCH_BOTH)){
    if($gname!=$row[2])
    {
        echo "
        <tr>
        <td>$row[2]</td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        </tr>";
        $gname=$row[2];

    }
    $pid=$row[0];
    $btno=$row[3];
    $expdate=$row[4];
    $mrp1=$row[5];


$hrow=$dbpdo->query("SELECT sum(quantity) from stockdetail where productcode='$pid'  and batchno='$btno' and expdate='$expdate' and mrp='$mrp1'  group by productcode,batchno,expdate,mrp")->fetch(PDO::FETCH_NUM);  
  if($hrow)
  $purchase=$hrow[0]; else $purchase=0;

$hrow=$dbpdo->query("SELECT sum(bonus) from stockdetail where productcode='$pid'  and batchno='$btno' and expdate='$expdate' and mrp='$mrp1' group by productcode,batchno,expdate,mrp")->fetch(PDO::FETCH_NUM);  
  
  if($hrow)
  $bonus=$hrow[0]; else $bonus=0;
$totalpurchase=$purchase+$bonus;


$hrow=$dbpdo->query("SELECT sum(quantity) from stockreturndetail where productcode='$pid'  and batchno='$btno' and expdate='$expdate' and mrp='$mrp1'  group by productcode,batchno,expdate,mrp")->fetch(PDO::FETCH_NUM);  
  if($hrow)
  $purchaser=$hrow[0]; else $purchaser=0;

$hrow=$dbpdo->query("SELECT sum(bonus) from stockreturndetail where productcode='$pid'  and batchno='$btno' and expdate='$expdate' and mrp='$mrp1' group by productcode,batchno,expdate,mrp")->fetch(PDO::FETCH_NUM);  
  
  if($hrow)
  $bonusr=$hrow[0]; else $bonusr=0;
$totalpurchaser=$purchaser+$bonusr;



$hrow=$dbpdo->query("SELECT sum(quantity) from saledetail where productcode='$pid'  and batchno='$btno' and expdate='$expdate' and mrp='$mrp1'")->fetch(PDO::FETCH_NUM); 
  if($hrow)
  $sale=$hrow[0]; else $sale=0;

$hrow=$dbpdo->query("SELECT sum(bonus) from saledetail where productcode='$pid'  and batchno='$btno' and expdate='$expdate' and mrp='$mrp1' group by productcode,batchno,expdate,mrp")->fetch(PDO::FETCH_NUM); 
  
  if($hrow)
  $sbonus=$hrow[0]; else $sbonus=0;
  $totalsale=$sale+$sbonus;


  $bonus=$bonus-$sbonus-$bonusr;

  $inhand=$purchase-$sale-$purchaser;
  $inhand=$inhand+$bonus;
   

echo "
<tr>
<td>$row[0]</td>
<td>$row[1]</td>
<td>$row[3]</td>
<td>$row[4]</td>
<td>$row[5]</td>
<td>$row[6]</td>
<td>$row[7]</td>
<td>$row[8]</td>
<td>$totalsale</td>
<td>$inhand</td>
</tr>";




}
}
?>
        </tbody>


</table>


                      
                   
                 
               </div>
            </div></div>
            </div>
              </div>
            </div>
          </div>
        </section>
        
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
  fetch_data();


   function fetch_data()
  {
    
   var dataTable = $('#user_data').DataTable({
     
        
        "scrollY": 300,
        "scrollX": true,
     "pageLength": 100,
    
     
         "lengthMenu": [[100, 250, 500,1000, -1], [100, 250, 500,1000, "All"]],
        
               "dom": "<'row '<'col-md-12'B>><'row'<'col-md-12'>><'row'<'col-md-12'flrt>>ip",
      buttons: [

            { extend: 'print', footer: true,

customize: function ( win ) {
                    
 
                    $(win.document.body).find( 'th' )
                        .addClass( 'trow' )
                        .css( 'font-size', 'inherit' );
                },
                
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

	 