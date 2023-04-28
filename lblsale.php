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
      
      <div class="col-12 col-sm-6 offset-sm-3 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-6 offset-xl-3">
            <div class="card card-primary">
                        <div class="card-body ">
                            <form class="forms-sample" method=post id="search-form">  
              
      <div class="row">
      
      <div class="col-sm-4">
      <div class="form-group">
    <label for="field-3" >Select Start Date<span class="required">*</span></label>
  
   <div class="input-group">
     <input type="text" class="form-control datepicker" place="Start Date" name=sdate id="sdate" autocomplete="off" value=<?php echo $date ?> >
   </div>
   </div>
   </div>
   
<div class="col-sm-4">
<div class="form-group">
<label for="field-3" >Select End Date<span class="required">*</span></label>
<input type="text" class="form-control datepicker" place="Start Date" name=edate id="edate" autocomplete="off" value=<?php echo $date ?> >
</div>
</div>


<div class="col-sm-4">
    <label for="field-3" >Select Compnay<span class="required">*</span></label>
      <div class="input-group">
    

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
       
       </div>
       </div>
       </div></div>
      


            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h3>Sale Ledger</h3>
          
          
                  </div>
                  <div class="card-body">

                    
                    <div class="table-responsive">
<table class="table table-striped table-hover" id="user_data" style="width:100%;">
                        
<thead>
                    <tr>
<th>Order No </th> 
<th>Date</th>
<th>Invoice No</th>
<th>Channel</th>
<th>F-Code</th>
<th>CustomerID</th>
<th>IBL-C-Code</th>
<th>Customer name</th>
<th>Product Code</th>
<th>Company P-Ocde</th>
<th>Product Name</th>
<th>Quantity</th>
<th>Amount</th>
<th>Discount</th>
<th>FOC</th>

</tr>
</thead>
<tbody>

  <?php 
if(!empty($_POST['sdate'])  && !empty($_POST['edate'])) 
{
    $sdate=$_POST['sdate'];
    $edate=$_POST['edate'];

    if(!empty($_POST['companycode']))
$companycode=$_POST['companycode'];
else
 $companycode="1013000084";

$s=$dbpdo->prepare("SELECT a.id,a.tableid,a.productcode,a.quantity,a.totalamount,a.dis1,b.date,b.customercode,c.companycode,c.name ,d.ibl,d.name,e.companycode,e.name,f.mode
FROM `saledetail` as a, sale as b ,customers as c ,products as d, customers as e,cus_mode as f
where  d.ccode=$companycode and b.date>='$sdate' and b.date<='$edate' and  a.tableid=b.id and b.customercode=c.id and a.productcode=d.id and b.customercode=e.id and c.mode=f.id");


$s->execute();
while($row = $s->fetch(PDO::FETCH_BOTH)){

    $date11=date("d-m-Y",strtotime($row[6]));

    echo "
    <tr>
    <td>$row[1]</td>
    <td>$date11</td>
    <td>$row[0]</td>
    <td>$row[14]</td>
    <td>2000187205</td>
    <td>$row[7]</td>
    <td>$row[8]</td>
    <td>$row[9]</td>
    <td>$row[2]</td>
    <td>$row[10]</td>
    <td>$row[11]</td>
    <td>$row[3]</td>
    <td>$row[4]</td>
    <td>$row[5]</td>
    <td>0</td>

</tr>
    ";



}
}
?>
        
        


         
        
        </tbody>
<tfoot >
    <tr>
    <th></th><th></th><th></th><th></th><th></th>
    <th></th><th></th><th></th><th></th><th></th>
    <th></th><th></th><th></th><th></th><th></th>
   
    
</tr></tfoot>

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
     "pageLength": 10,
     "length":10,
     
    
     
         "lengthMenu": [[10,100, 500,1000, -1], [10,100, 500,1000, "All"]],
        
               "dom": "<'row '<'col-md-12'B>><'row'<'col-md-12'>><'row'<'col-md-12'flrt>>ip",
      buttons: [

            { extend: 'print', footer: true },
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



    


    "processing" : true,
    "bDestroy":true,

  language: {
          processing: "<img src='assets/img/typing.svg'>"
      },
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
      
     
      var total = api
                .column(12, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                        }, 0);

            var total1 = api
                .column(13, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                        }, 0);

                
          
    $( api.column(12).footer() ).html(numberWithCommas(total.toFixed(0)));
    $( api.column(13).footer() ).html(numberWithCommas(total1.toFixed(0)));
   
    
},
  
  
  
  
   });
   
  }
  


  
  
  
  
  
  
  
  
  
});

   </script>
   
   
