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
      
      <div class="col-6 col-sm-6 offset-sm-3 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-6 offset-xl-3">
            <div class="card card-primary">
                        <div class="card-body ">
      <form class="forms-sample" method=post id="search-form">  
              
      <div class="row">
      
      <div class="col-sm-12">
      <div class="input-group">
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
<div class="input-group-append">
<button type=submit class="btn btn-danger"><i class="fa fa-search"></i></button>

</div>
   </div>
   </div>
  
   
       </div>
     </form>
       
       </div>
       </div>
       </div>

   </div>
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h3>Franchise Data Format</h3>
					
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
<table class="table table-striped table-hover text-dark mb-2" id="user_data" style="width:100%;">
                        
<thead>
<tr>
<th >Dis-Code</th>
<th >ProductID</th>
<th >Company Code</th>
<th >Product Name</th>
<th >BNO</th>
<th >Expiry Date</th>
<th >Quantity</th>
<th >Value</th>
<th >Date</th>
</tr>
</thead>
<tbody>
<?php 
if(!empty($_POST['companycode']))
$companycode=$_POST['companycode'];
else
 $companycode="1013000084";
    
$q="SELECT a.*,b.id,b.ibl,b.name from stockdetail as a ,products as b where a.productcode=b.id and a.inhand>0 and b.ccode=$companycode ";

$s=$dbpdo->prepare($q);
$s->execute();
$cnt=0;
while($row = $s->fetch(PDO::FETCH_BOTH)){
    $cnt++;
    $qty=$row[16];
    $netrate=$row[14];
    $tpamount=$row[11];
    $dis1=$row[12];
    $gst1=$row[13];
    $extra1=$row[17];
    

    if($netrate)
{
$subtotal=$netrate*$qty;
$nettotal=$netrate*$qty;
}
else
{
    
    $amount1=$tpamount*$qty;
    
    

    
   $dis1=0;
        if($dis1>0) $dis1=($amount1*$dis1)/100;
        
        $amount1=$amount1-$dis1;

    
    if(!empty($gst))
    {
        
        $gst1=($amount1*$gst)/100;
       
    
        }
    if(!empty($extra))
    {
        
        $extra1=($amount1*$extra)/100;
        

        
        }

        $amount1=$amount1+$gst1+$extra1;

        $nettotal=round($amount1,2);
    }

    $amount= number_format(round($nettotal));
    
    $date1=date("d-m-Y",strtotime($row[5]));
    $date2=date("d-m-Y");
    
echo "
<tr>
<td>2000187205</td>
<td>$row[2]</td>
<td>$row[19]</td>
<td>$row[20]</td>
<td>$row[4]</td>
<td>$date1</td>
<td>$row[16]</td>
<td>$amount</td>
<td>$date2</td>
</tr>
";

}

?>
  

 <tfoot>
<th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th>
 </tfoot>
        
        


         
        
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


   function fetch_data()
  {
    
   var dataTable = $('#user_data').DataTable({
     
        
        "scrollY": 300,
        "scrollX": true,
     "pageLength": 100,
    
     
         "lengthMenu": [[100,500,1000,-1], [100,500,1000, "All"]],
        
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

 

   
footerCallback: function ( row, data, start, end, display ) {
     
    
            var api = this.api(),data;
      
            // Remove the formatting to get integer data for summation
            var intVal = function ( i ) {
                return typeof i === 'string' ?
                    i.replace(/[\$,]/g, '')*1 :
                    typeof i === 'number' ?
                        i : 0;
            };
      
      function numberWithCommas(x) {
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}
      
      
            var total1 = api
                .column(6, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                        }, 0);
                 
              
          
    $( api.column(6).footer() ).html(numberWithCommas(total1));
    
        
    
},
  
   
  
  
  
  
  
  
  
   });
   
  }
  



  
  
 

 });
 </script>

	 