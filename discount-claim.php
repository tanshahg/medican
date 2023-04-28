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
                    <h3>Discount Calim Detail</h3>
					
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
<table class="table table-striped table-hover text-dark mb-2" id="user_data" style="width:100%;">
                        
<thead>
<tr>
<th >SNo</th>
<th >Date</th>
<th >Customer Name</th>
<th >Proudct Id</th>
<th >Company</th>
<th >Group</th>
<th >Product Name</th>
<th >Batch #</th>
<th >Exp-Date</th>
<th >TP</th>
<th >MRP</th>
<th >Subamount</th>
<th >Qunantity</th>
<th >Bonus</th>
<th >Discount Claim</th>

</tr>
</thead>
<tbody>
<?php 
if(isset($_POST['companycode']))
        {
       
        $sdate=$_POST['sdate'];
    $edate=$_POST['edate'];
    $compnaycode=$_POST['companycode'];
    $groupcode=$_POST['groupcode'];

if($groupcode==0)
$q="SELECT a.*,b.name,b.ccode,b.gcode,c.gname,d.name,f.name,e.date FROM `saledetail` as a,products as b,companygroups as c ,customers as d,sale as e, customers as f where b.ccode=$compnaycode and a.productcode=b.id and b.gcode=c.id and b.ccode=d.id and a.tableid=e.id and e.date>='$sdate' and e.date<='$edate' and a.dclaim>0 and e.customercode=f.id";
else
    $q="SELECT a.*,b.name,b.ccode,b.gcode,c.gname,d.name,f.name,e.date FROM `saledetail` as a,products as b,companygroups as c ,customers as d,sale as e, customers as f where b.ccode=$compnaycode and a.productcode=b.id and b.gcode=c.id and b.ccode=d.id and a.tableid=e.id and e.date>='$sdate' and e.date<='$edate' and a.dcalaim>0 and e.customercode=f.id and b.gcode=$groupcode";



$s=$dbpdo->prepare($q);
$s->execute();
$cnt=0;
while($row = $s->fetch(PDO::FETCH_BOTH)){
    $cnt++;
    $date=date("d-m-Y",strtotime($row[5]));
    $date1=date("d-m-Y",strtotime($row[24]));

$dis2=round($row[8]*$row[17]/100,2);
echo "
<tr>
<td>$cnt</td>
<td>$date1</td>
<td>$row[23]</td>
<td>$row[2]</td>
<td>$row[22]</td>
<td>$row[21]</td>
<td>$row[18]</td>
<td>$row[4]</td>
<td>$date</td>
<td>$row[11]</td>
<td>$row[10]</td>
<td>$row[8]</td>
<td>$row[6]</td>
<td>$row[7]</td>
<td>$dis2 ($row[17] %)</td>

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
    
     
         "lengthMenu": [[100, 150, 250,300, -1], [100, 150, 250,300, "All"]],
        
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

	 