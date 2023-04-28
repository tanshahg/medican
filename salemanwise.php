<?php include "secure.php";
include "include/header.php";
date_default_timezone_set("Asia/Karachi");
$date=date("Y-m-d");
$title="SALE  STOCK SUMMARY";
if(isset($_POST['sdate']))
        {
        $sdate=$_POST['sdate'];
        $f1=$_POST['f1'];
        
        

        $sdate=date("d M Y",strtotime($_POST['sdate']));
       
        $title="SALE  STOCK SUMMARY $sdate from Invoice #: $f1 ";
    }
    ?>

<script>
 document.title = "<?php echo $title ?>";
 </script>

 
<style>


@media print {

@import url('https://fonts.googleapis.com/css2?family=Roboto&display=swap');

    .pagebreak { page-break-before: always; } /* page-break-after works, as well */

    .hrow  {
    background-color: #333 !important;
    color: white;
    page-break-before: always;
    
}
td.hrow  {
    font-family: 'Roboto', sans-serif;
    height: 15px !important;
    font-size: 12px !important;
    border: 1px solid white;
    line-height: 15px !important;
    padding: 1px 0 0 3px !important;
    text-align: center;
    font-weight: bold;

}

td.ddrow {
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
    

    
    td.grow {
     font-family: 'Roboto', sans-serif;
    height: 30px !important;
    font-size: 16px !important;
     line-height: 30px !important;
     padding: 15px 0 0 15px !important;
     font-weight: bold;
}

 

}


 

    .hrow  {
    background-color: #333 !important;
    color: white;
    page-break-before: always;
    
}
td.hrow  {
    font-family: 'Roboto', sans-serif;
    height: 15px !important;
    font-size: 12px !important;
    border: 1px solid white;
    line-height: 15px !important;
    padding: 1px 0 0 3px !important;
    text-align: center;
    font-weight: bold;

}

td.ddrow {
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


 
 

    
    td.grow {
     font-family: 'Roboto', sans-serif;
    height: 30px !important;
    font-size: 16px !important;
     line-height: 30px !important;
     padding: 15px 0 0 15px !important;
     font-weight: bold;
}

 




    </style>
  
</head>

<body>

  <div class="loader"></div>
  <?php include "include/menu.php"; ?>
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-body">
      <div class="row">
      
      <div class="col-md-12">
            <div class="card card-primary">
                        <div class="card-body ">
      <form class="forms-sample" method=post id="search-form">  
              
      <div class="row">
      
<div class="col-md-3">
       <div class="form-group">
    <label for="field-3" >Select Compnay<span class="required">*</span></label>

  <select name="companycode" id="companycode" class="form-control" required>
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


      <div class="col-md-3">
      <div class="form-group">
    <label for="field-3" >Select Start Date<span class="required">*</span></label>
     <input type="text" class="form-control datepicker" placeholder="Start Date" name=sdate id="sdate" autocomplete="off" value=<?php echo $date ?> >
   </div>
   </div>

   <div class="col-sm-3">
<label for="field-3" >Select End Date<span class="required">*</span></label>
<input type="text" class="form-control datepicker" place="Start Date" name=edate id="edate" autocomplete="off" value=<?php echo $date ?> >

   
      
      </div>
     

    

     

   
<div class="col-sm-3">
<div class="form-group">
<label for="field-3" >Select Saleman<span class="required">*</span></label>
<div class="input-group">
<select class="form-control" name=f1 id=f1>
 <?php
$s=$dbpdo->prepare("select * from customers where customertype='3' order by name");
$s->execute();
while($row = $s->fetch(PDO::FETCH_BOTH)){
echo "<option value='$row[0]'>$row[2]</option>";
}
?>
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
                    <h3>Saleman Wise Daily Report</h3>
          
          
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
<table class="table table-striped table-hover" id="user_data" style="width:100%;">
                        
<thead>
<th></th><th></th><th></th><th></th><th></th>
<th></th><th></th><th></th><th></th><th></th>
</thead>
        
        
<tbody>
  <?php
  if(isset($_POST['sdate']) && !empty($_POST['companycode']))
        {
          
        
        $sdate=$_POST['sdate'];
        $edate=$_POST['edate'];
        $f1=$_POST['f1'];
        $companycode=$_POST['companycode']; 
        
        $row=$dbpdo->query("SELECT name from customers where id='$f1'")->fetch(PDO::FETCH_NUM);
        $saleman=$row[0];


  $q2="SELECT a.id,a.date,c.name,b.mrp,b.quantity,b.bonus,b.tp,b.subamount,b.dis1,b.totalamount,d.gname,d.id from sale as a,saledetail as b ,products as c,companygroups as d where a.id=b.tableid and a.date>='$sdate' and  a.date<='$edate' and a.salemancode='$f1' and b.productcode=c.id and c.gcode=d.id and c.ccode='$companycode' order by  c.gcode,a.date";       
  
   $total=0;
   $gtotal=0;     


$stmt23 = $dbpdo->prepare($q2);
$stmt23->execute();
$trecord=$stmt23->rowCount();
if($trecord)
{ 
$n=0;
$group="abc";

echo "<tr>
<td  class='grow'>Saleman:- $f1 $saleman</td>
<td style='display:none'></td><td style='display:none'></td><td style='display:none'></td><td style='display:none'></td><td style='display:none'></td>
<td style='display:none'></td><td style='display:none'></td><td style='display:none'></td><td style='display:none'></td>
</tr>"; 

while ($crows = $stmt23->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_NEXT))
{
    $n++;

    if($group!=$crows[10] && $n!=1)
{
 echo "<tr>

<td style='display:none'></td><td style='display:none'></td><td style='display:none'></td><td style='display:none'></td><td style='display:none'></td>
<td style='display:none'></td><td style='display:none'></td><td style='display:none'></td><td style='display:none'></td>
<td  class='grow' align='right'>Group Total:- $gtotal</td>
</tr>"; 
$gtotal=0;




}

if($group!=$crows[10])
{
 echo "<tr>
<td colspan=10 class='grow'>Group Name:- $crows[11] $crows[10]</td>
<td style='display:none'></td><td style='display:none'></td><td style='display:none'></td><td style='display:none'></td><td style='display:none'></td>
<td style='display:none'></td><td style='display:none'></td><td style='display:none'></td><td style='display:none'></td>
</tr>"; 

echo "<tr>
<td class='hrow'>Vno</td>
<td class='hrow'>date</td>
<td class='hrow'>Product name</td>
<td class='hrow'>MRP</td>
<td class='hrow'>Quantity</td>
<td class='hrow'>Bonus</td>
<td class='hrow'>Unit Price</td>
<td class='hrow'>Toal</td>
<td class='hrow'>Discount</td>
<td class='hrow'>Net-Total</td>
</tr>";  

$group=$crows[10];
}


$cdate=$crows[1];
$date1 = date("Ymd", strtotime($cdate));
$date2 = date("d M Y", strtotime($cdate));
echo "<tr>
<td class='ddrow'>$crows[0]</td>
<td class='ddrow' data-sort='$date1'>$date2</td>
<td class='ddrow'>$crows[2]</td>
<td class='ddrow'>$crows[3]</td>
<td class='ddrow'>$crows[4]</td>
<td class='ddrow'>$crows[5]</td>
<td class='ddrow'>$crows[6]</td>
<td class='ddrow'>$crows[7]</td>
<td class='ddrow'>$crows[8]</td>
<td class='ddrow'>$crows[9]</td>
</tr>";
$gtotal+=$crows[9];
$total+=$crows[9];
}

echo "<tr>

<td style='display:none'></td><td style='display:none'></td><td style='display:none'></td><td style='display:none'></td><td style='display:none'></td>
<td style='display:none'></td><td style='display:none'></td><td style='display:none'></td><td style='display:none'></td>
<td  class='grow' align='right'>Group Total:- $gtotal</td>
</tr>"; 

echo "<tr>

<td style='display:none'></td><td style='display:none'></td><td style='display:none'></td><td style='display:none'></td><td style='display:none'></td>
<td style='display:none'></td><td style='display:none'></td><td style='display:none'></td><td style='display:none'></td>
<td  class='grow' align='right'>$saleman Saleman Total Sale:- $total</td>
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
   <script>
$(document).ready(function(){

fetch_data();
  
  

function commaSeparateNumber(val) {
    while (/(\d+)(\d{3})/.test(val.toString())) {
        val = val.toString().replace(/(\d+)(\d{3})/, '$1' + ',' + '$2');
    }
    return val;
}



  function fetch_data()
  {
    
   var dataTable = $('#user_data').DataTable({
     
        
        
     "pageLength": -1,
    
     
         
        
               "dom": "<'row '<'col-md-12'B>><'row'<'col-md-12'>><'row'<'col-md-12'rt>>",
      buttons: [

            { extend: 'print', footer: true },
            { extend: 'excel', footer: true },
            { extend: 'pdf', footer: true,  orientation: 'portrait', 
                     customize: function (doc) {
        
        
        
        doc.pageMargins = [20, 60, 20, 30];
        // Set the font size fot the entire document
        
        
       
       
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



    


    "processing" : true,
    "serverSide" : false,
   "bDestroy":true,

  language: {
          processing: "<img src='assets/img/typing.svg'>"
      },
    "order" : [],

    

   

   
  
  
  
  
  
  
  
  
  
  
   });
   
  }
});
    </script>
   
   
