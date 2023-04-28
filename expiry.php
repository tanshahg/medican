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
      
      
   
<div class="col-sm-4">
<div class="form-group">
<label for="field-3" >Select Days<span class="required">*</span></label>

<input type="text" class="form-control" name=days id="days" value="120" >
</div>
</div>

     
   <div class="col-sm-4">
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
   
<div class="col-sm-4">
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
                    <h3>Stock Expiry Detail</h3>
					
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
<table class="table table-striped table-hover text-dark mb-2" id="user_data" style="width:100%;">
                        
<thead>
<tr>
<th >SNo</th>
<th >Proudct Id</th>
<th >Company</th>
<th >Group</th>
<th >Product Name</th>
<th >Batch #</th>
<th >Exp-Date</th>
<th >TP</th>
<th >MRP</th>
<th >Net Rate</th>
<th >Qunantity</th>
<th >Bonus</th>
<th >Inhand Qty</th>

</tr>
</thead>
<tbody>
<?php 
if(isset($_POST['companycode']))
        {
       
        $groupcode=$_POST['groupcode'];
        $companycode=$_POST['companycode']; 
        $days=$_POST['days'];

if($groupcode==0)
$q="SELECT a.*,b.name,b.ccode,b.gcode,c.gname,d.name FROM `stockdetail` as a,products as b,companygroups as c ,customers as d where b.ccode=$companycode and a.inhand>0 and a.expdate< NOW() + INTERVAL $days DAY and a.productcode=b.id and b.gcode=c.id and b.ccode=d.id";
else
$q="SELECT a.*,b.name,b.ccode,b.gcode,c.gname,d.name FROM `stockdetail` as a,products as b,companygroups as c ,customers as d where b.ccode=$companycode and a.inhand>0 and a.expdate< NOW() + INTERVAL $days DAY and a.productcode=b.id and b.gcode=c.id and b.ccode=d.id and b.gcode=$groupcode";


$s=$dbpdo->prepare($q);
$s->execute();
$cnt=0;
while($row = $s->fetch(PDO::FETCH_BOTH)){
    $cnt++;
    $date=date("d-m-Y",strtotime($row[5]));
echo "
<tr>
<td>$cnt</td>
<td>$row[2]</td>
<td>$row[22]</td>
<td>$row[21]</td>
<td>$row[18]</td>
<td>$row[4]</td>
<td>$date</td>
<td>$row[11]</td>
<td>$row[10]</td>
<td>$row[14]</td>
<td>$row[6]</td>
<td>$row[7]</td>
<td>$row[16]</td>

</tr>
";

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
  
  fetch_data();

 $("#companycode").change(function(e) {
  e.preventDefault();
  var cid=$("#companycode").val();
  $.post("ajaxcall/getgroups1.php",{id:cid},function(result){
  $("#groupcode").empty().append(result);
  
  });
  });

   function fetch_data()
  {
    
   var dataTable = $('#user_data').DataTable({
     
        
        "scrollY": 300,
        "scrollX": true,
     "pageLength": 100,
    
     
         "lengthMenu": [[100,500,1000, -1], [100,500,1000,"All"]],
        
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
            { extend: 'pdf', footer: true },
            { extend: 'colvis', footer: true },
            
            
        
        ],



    


  
    "order" : [],

 

   

   
  
  
  
  
  
  
  
   });
   
  }
  



  
  
 

 });
 </script>

	 