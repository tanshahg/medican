<?php include "secure.php";
include "include/header.php";
date_default_timezone_set("Asia/Karachi");
$date=date("Y-m-d");
$title="Daily Invoice Report";
if(isset($_POST['sdate']))
        {

        $sdate=date("d M Y",strtotime($_POST['sdate']));
        $edate=date("d M Y",strtotime($_POST['edate']));
        $title=" Daily Invoice Report from $sdate to $edate";
    }
    ?>

<script>
 document.title = "<?php echo $title ?>";
 </script>

 <link rel="stylesheet" href="assets/css/compact.css">
 <style>
 @media print { h1 
    { 
        font-size: 16pt !important; 
        margin-top: 10px;
        font-weight: bold;

    } }
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
      
      <div class="col-12 col-sm-6 offset-sm-3 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-6 offset-xl-3">
            <div class="card card-primary">
                        <div class="card-body ">
      <form class="forms-sample" method=post id="search-form">  
              
      <div class="row justify-content-center">

        <div class="col-sm-4">
      <div class="form-group">
    <label for="field-3" >From<span class="required">*</span></label>
     <input type="text" class="form-control" placeholder="From" name="f1" id="f1">
   </div>
   </div>

    <div class="col-sm-4">
      <div class="form-group">
    <label for="field-3" >To<span class="required">*</span></label>
    <div class="input-group">
     <input type="text" class="form-control" placeholder="TO"  name="f2" id="f2">
      <button type=submit class="btn btn-danger mx-2" stlye="marin"><i class="fa fa-search"></i></button>

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
                    <h3>Daily Invoice Report</h3>
          
          
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
<table class="table table-striped table-hover" id="user_data" style="width:100%;">
                        
<thead>
                    <tr>
<th>Inovice #</th>
<th>date</th>
<th>Customer Name</th>
<th>Area Name</th>
<th>Total</th>
<th>Sale Tax</th>
<th>Sale Tax amount</th>
<th>Net Total</th>
<th>Signature 1</th>
<th>Signature 2</th>
<th>Remarks</th>
</tr>
                </thead>
        
        
<tbody>
  <?php
  if(isset($_POST['f1']))
        {
          
        
        
        $f1=$_POST['f1'];
        $f2=$_POST['f2'];
        $list=[];
        for($i=$f1;$i<=$f2;$i++)
            $list[]=$i;
        $ids = implode (", ", $list);
        
        
$q2="SELECT a.*,b.name,c.arianame  FROM `sale` as a ,customers as b ,ariainfo as c  where  a.id IN(".$ids.")  and a.customercode=b.id and a.areacode=c.sno order by a.id";

$stmt23 = $dbpdo->prepare($q2);
$stmt23->execute();
$trecord=$stmt23->rowCount();
if($trecord)
{ 
$n=0;
while ($crows = $stmt23->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_NEXT))
{
$t=0;
$total=$crows[5];
$tax=$crows[6];
if(!$tax) {$tax=0; }
$oamount=$total-$tax;
if($t)
$t=round($tax*100/$oamount,1);
$cdate=$crows[1];
$date1 = date("Ymd", strtotime($cdate));
$date2 = date("d-m-Y", strtotime($cdate));
echo "<tr>
<td>$crows[0]</td>
<td data-sort='$date1'>$date2</td>
<td>$crows[9]</td>
<td>$crows[10]</td>
<td>$oamount</td>
<td>$tax</td>
<td>$t</td>
<td>$total</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>

</tr>";
}
}
}

?>
     
        
        </tbody>
<tfoot >
    <tr>
    <th ></th>
    <th ></th>
    <th ></th>
    <th ></th>
    <th ></th>
    <th ></th>
    <th ></th>
    <th ></th>
    <th ></th>
    <th ></th>
    <th ></th>
    
        
    
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
     "pageLength": 100,
    
     
         "lengthMenu": [[100,500,1000, -1], [100,500,1000, "All"]],
        
               "dom": "<'row '<'col-md-12'B>><'row'<'col-md-12'>><'row'<'col-md-12'flrt>>ip",
      buttons: [

            { extend: 'print', footer: true },
            { extend: 'excel', footer: true },
            { extend: 'pdf', footer: true,  orientation: 'portrait', 
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
    "serverSide" : false,
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
                .column(4, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                        }, 0);

            var total1 = api
                .column(5, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                        }, 0);
                
                var total2 = api
                .column(7, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                        }, 0);

                
          
    $( api.column(4).footer() ).html(numberWithCommas(Math.round(total)));
    $( api.column(5).footer() ).html(numberWithCommas(Math.round(total1)));
    $( api.column(7).footer() ).html(numberWithCommas(Math.round(total2)));
        
    
},
  
  
  
  
   });
   
  }
});
    </script>
   
   
