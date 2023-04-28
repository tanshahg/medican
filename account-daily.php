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
         
  
   
<div class="col-md-6 mx-auto">
<div class="form-group">
<label for="field-3" >Select Date<span class="required">*</span></label>
<div class="input-group">
<input type="text" class="form-control datepicker" place="Start Date" name=date id="date" autocomplete="off" value=<?php echo $date ?> >
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
                    <h3>Account Wise Daily Report</h3>
					
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
<table class="table table-striped table-hover text-dark mb-2" id="user_data" style="width:100%;">
                        
<thead>
<tr>
<th >SNo</th>
<th >Customer code</th>
<th >Customer Name</th>
<th >Invoice Type</th>
<th >Busniess Line</th>
<th >Bill Number</th>
<th >Amount</th>
</tr>
</thead>
<tbody>
<?php 
if(isset($_POST['date']))
        {
       
        $date=$_POST['date'];
    
$q="SELECT a.gamount,b.companycode,b.name,a.id from sale as a ,customers as b where a.customercode=b.id and  a.date='$date'";

$s=$dbpdo->prepare($q);
$s->execute();
$cnt=0;
while($row = $s->fetch(PDO::FETCH_BOTH)){
    $cnt++;
    $amount= number_format(round($row[0]));
    
echo "
<tr>
<td>$cnt</td>
<td>$row[1]</td>
<td>$row[2]</td>
<td>Cash</td>
<td></td>
<td>$row[3]</td>
<td>$amount</td>
</tr>
";

}
}
?>
  

 <tfoot>
<th></th><th></th><th></th><th></th><th></th><th></th><th></th>
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
    
     
         "lengthMenu": [[100,500,1000, -1], [100,500,1000, "All"]],
        
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

	 