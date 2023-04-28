<?php include "secure.php";
include "include/header.php";
date_default_timezone_set("Asia/Karachi");
$date=date("Y-m-d");
$title="SALE  STOCK SUMMARY";
if(isset($_POST['sdate']))
        {
        $sdate=$_POST['sdate'];
        $f1=$_POST['f1'];
        $f2=$_POST['f2'];
        

        $sdate=date("d M Y",strtotime($_POST['sdate']));
       
        $title="SALE  STOCK SUMMARY $sdate from Invoice #: $f1 to $f2";
    }
    ?>

<script>
 document.title = "<?php echo $title ?>";
 </script>

 <link rel="stylesheet" href="assets/css/compact.css">
 
</head>

<body>

  <div class="loader"></div>
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
      
    
     <div class="col-sm-2">
      <div class="form-group">
    <label for="field-3" >From<span class="required">*</span></label>
     <input type="text" class="form-control" placeholder="From" name="f1" id="f1">
   </div>
   </div>

    <div class="col-sm-2">
      <div class="form-group">
    <label for="field-3" >To<span class="required">*</span></label>
     <input type="text" class="form-control" placeholder="TO"  name="f2" id="f2">
   </div>
   </div>

     

   
<div class="col-sm-4">
<div class="form-group">
<label for="field-3" >Select Option<span class="required">*</span></label>
<div class="input-group">
<select class="form-control" name=f3 id=f3>
<option value="1">Sale</option>
<option value="2">Sale Return</option>
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
                    <h3>Sale Stock Summary</h3>
          
          
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
<table class="table table-striped table-hover" id="user_data" style="width:100%;">
                        
<thead>
                    <tr>
<th>Sno</th>
<th>Group</th>
<th>Product Name</th>
<th>MRP</th>
<th>Batch No</th>
<th>Expiry Date</th>
<th>Quantity</th>
<th>Bonus</th>
<th>Bonus-claim</th>
<th>Total</th>
</tr>
                </thead>
        
        
<tbody>
  <?php
  if(isset($_POST['f1']))
        {
          
        
        
        $f1=$_POST['f1'];
        $f2=$_POST['f2'];
        $f3=$_POST['f3'];
        $list=[];
        for($i=$f1;$i<=$f2;$i++)
            $list[]=$i;
        $ids = implode (", ", $list);

 if($f3==1)
 $q2="SELECT c.name,b.mrp,b.batchno,b.expdate,sum(b.quantity),sum(b.bonus),sum(b.bclaim),b.productcode,c.gcode,d.gname  FROM saledetail as b,products as c,companygroups as d WHERE b.tableid IN(".$ids.") and b.productcode=c.id and c.gcode=d.id  group by c.gcode,b.productcode,c.name,b.batchno,b.mrp,b.expdate";       
    else
    $q2="SELECT c.name,b.mrp,b.batchno,b.expdate,sum(b.quantity),sum(b.bonus),sum(b.bclaim),b.productcode,c.gcode,d.gname  FROM salereturndetail as b,products as c,companygroups as d WHERE b.tableid IN(".$ids.") and b.productcode=c.id and c.gcode=d.id  group by c.gcode,b.productcode,c.name,b.batchno,b.mrp,b.expdate";      
  


        
// $q2="SELECT a.*,b.name,c.arianame  FROM `sale` as a ,customers as b ,ariainfo as c  where a.date >='$sdate' AND  a.date<='$edate' and a.customercode=b.id and a.areacode=c.sno order by date";

$stmt23 = $dbpdo->prepare($q2);
$stmt23->execute();
$trecord=$stmt23->rowCount();
if($trecord)
{ 
$n=0;
while ($crows = $stmt23->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_NEXT))
{
    $n++;


$cdate=$crows[3];
$date1 = date("Ymd", strtotime($cdate));
$date2 = date("d-m-Y", strtotime($cdate));
echo "<tr>
<td>$n</td>
<td>$crows[9]</td>
<td>$crows[0]</td>
<td>$crows[1]</td>
<td>$crows[2]</td>
<td data-sort='$date1'>$date2</td>
<td>$crows[4]</td>
<td>$crows[5]</td>
<td>$crows[6]</td>
<td>".$crows[4]+$crows[5]+$crows[6]."</td>
</tr>";
}
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
     
        
        "scrollY": 300,
        "scrollX": true,
     "pageLength": 100,
    
     
         "lengthMenu": [[100,500,1000, -1], [100,500,1000, "All"]],
        
               "dom": "<'row '<'col-md-12'B>><'row'<'col-md-12'>><'row'<'col-md-12'flrt>>ip",
      buttons: [

            { extend: 'print', footer: true },
            { extend: 'excel', footer: true },
            { extend: 'pdf', footer: true,  orientation: 'portrait'},
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
   
   
