<?php include "secure.php";
include "include/header.php";
date_default_timezone_set("Asia/Karachi");
$date=date("Y-m-d");
?>
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
<label for="field-3" >Select Customer<span class="required">*</span></label>

<select name="cid" id="cid" class="form-control" >
 <option value="0">Select all</option>
   <?php
$s=$dbpdo->prepare("SELECT id,name FROM `customers` where customertype=1");
$s->execute();
while($row = $s->fetch(PDO::FETCH_BOTH)){
echo "<option value='$row[0]'>$row[1]</option>";
}
?>
</select>
</div>
</div>


   
<div class="col-sm-3">
<div class="form-group">
<label for="field-3" >Select Product<span class="required">*</span></label>
<div class="input-group">
<select name="f1[]"  id="f1" class="selectpicker" multiple size="3">
 <?php
 

$s=$dbpdo->prepare("SELECT DISTINCT a.productcode,b.name FROM `stockdetail` as a , products as b where a.productcode=b.id and a.inhand>'0' order by b.name");
$s->execute();
while($row = $s->fetch(PDO::FETCH_BOTH)){
echo "<option value='$row[0]'>$row[1]</option>";
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
                    <h3>Customer/Product  Wise Business</h3>
          
          
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
<table class="table table-striped table-hover" id="user_data" style="width:100%;">
  
  <?php
  if(isset($_POST['cid']))
        {
          
       
        $sdate=$_POST['sdate'];
        $edate=$_POST['edate'];
        $s=date("d-M-Y",strtotime($sdate));
        $e=date("d-M-Y",strtotime($edate));
      }
      else 
      {
        $s="";
        $e="";
      }
      ?>
   <caption style="caption-side:top;font-size:16px">HR Report of <?php echo "From $s to $e";?>.</caption>                      
<thead>
                    <tr>
<th>Sno</th>
<th>Customer code</th>
<th>Customer Name</th>
<th>Product Code</th>
<th>Product  Name</th>
<th>Quantity</th>
</tr>
                </thead>
        
        
<tbody>
  <?php
  if(isset($_POST['cid']))
        {
          
        $total=0;
        $sdate=$_POST['sdate'];
        $edate=$_POST['edate'];
        $customercode=$_POST['cid'] ;
        $f1=$_POST['f1'] ;

        if($f1[0]==0)
{
  if($customercode==0)
$q="SELECT a.id,a.customercode,b.productcode,sum(b.quantity) as total,c.name,d.name
FROM `sale` as a, saledetail as b,customers as c,products as d 
where a.id=b.tableid and c.id=a.customercode and d.id=b.productcode and a.date>='$sdate' and a.date<='$edate' group by b.productcode,a.customercode";
else
$q="SELECT a.id,a.customercode,b.productcode,sum(b.quantity) as total,c.name,d.name
FROM `sale` as a, saledetail as b,customers as c,products as d 
where a.customercode='$customercode' and a.id=b.tableid and c.id=a.customercode and d.id=b.productcode and a.date>='$sdate' and a.date<='$edate' group by b.productcode,a.customercode";
}
else
{
  $f1=$_POST['f1'];
    $pides=implode(',', array_map('intval', $f1));
    if($customercode==0)
$q="SELECT a.id,a.customercode,b.productcode,sum(b.quantity) as total,c.name,d.name
FROM `sale` as a, saledetail as b,customers as c,products as d 
where  a.id=b.tableid and c.id=a.customercode and d.id=b.productcode  and b.productcode IN($pides) and a.date>='$sdate' and a.date<='$edate' group by b.productcode,a.customercode";
else
$q="SELECT a.id,a.customercode,b.productcode,sum(b.quantity) as total,c.name,d.name
FROM `sale` as a, saledetail as b,customers as c,products as d 
where a.customercode='$customercode' and a.id=b.tableid and c.id=a.customercode and d.id=b.productcode  and b.productcode IN($pides) and a.date>='$sdate' and a.date<='$edate' group by b.productcode,a.customercode";

}




$stmt23 = $dbpdo->prepare($q);
$stmt23->execute();
$trecord=$stmt23->rowCount();
if($trecord)
{ 
$n=0;
while ($crows = $stmt23->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_NEXT))
{
$n++;

echo "<tr>
<td>$n</td>
<td>$crows[1]</td>
<td>$crows[4]</td>
<td>$crows[2]</td>
<td>$crows[5]</td>
<td>$crows[3]</td>
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

    $("#cid").change(function(e) {
  e.preventDefault();
    var cid=$("#cid").val();
$.post("ajaxcall/getcustomerproducts.php",{cid:cid},function(result){
  $("#f1").empty().append(result);
  });
});

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
            { extend: 'pdf', footer: true },
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
   
   
