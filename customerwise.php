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
      
      <div class="col-12 col-md-12">
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
<label for="field-3" >Select Saleman<span class="required">*</span></label>
<div class="input-group">
<select class="form-control" name=salemancode id=salemancode>
    <option value="0">All Saleman</option>
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
<div class="col-sm-3">
<div class="form-group">
<label for="field-3" >Select customer<span class="required">*</span></label>
<div class="input-group">
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
                    <h3>Customer Wise Business</h3>
          
          
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
<table class="table table-striped table-hover" id="user_data" style="width:100%;">
                        
<thead>
                    <tr>
<th>Voucher #</th>
<th>date</th>
<th>Area</th>
<th>Saleman</th>
<th>Customer Name</th>
<th>Bill amount </th>
<th>Tax</th>
<th>Net Amount</th>
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
        $salemancode=$_POST['salemancode'] ;
        if($customercode==0)
        {
if($salemancode==0)            
$q2="SELECT *  FROM `sale` WHERE  date >='$sdate' AND  date<='$edate' order by date";
else
$q2="SELECT *  FROM `sale` WHERE  date >='$sdate' AND  date<='$edate' and salemancode='$salemancode' order by date";
}
else
{
    if($salemancode==0) 
$q2="SELECT *  FROM `sale` WHERE customercode='$customercode' and date >='$sdate' AND  date<='$edate' order by date";
else
$q2="SELECT *  FROM `sale` WHERE customercode='$customercode' and salemancode='$salemancode' and date >='$sdate' AND  date<='$edate' order by date";

}
$gtotal=0;
$stmt23 = $dbpdo->prepare($q2);
$stmt23->execute();
$trecord=$stmt23->rowCount();
if($trecord)
{ 
$n=0;
while ($crows = $stmt23->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_NEXT))
{

$sid=$crows[0];
$cdate=$crows[1];
$areacode=$crows[2];
$cid=$crows[3];
$salemancode=$crows[4];


$trow=$dbpdo->query("SELECT name from `customers` 
where id='$cid'")->fetch(PDO::FETCH_NUM);
if(!empty($trow))
{
$customer=$trow[0];
}
else $customer="";
$trow=$dbpdo->query("SELECT `arianame` from `ariainfo` 
where sno='$areacode'")->fetch(PDO::FETCH_NUM);
$area=$trow[0];
$trow=$dbpdo->query("SELECT name from `customers` 
where id='$salemancode'")->fetch(PDO::FETCH_NUM);
$saleman=$trow[0];
$cdate=$crows[1];
$date1 = date("Ymd", strtotime($cdate));
$date2 = date("d-m-Y", strtotime($cdate));
$tax=$crows[6];
$net=0;
$drow=$dbpdo->query("SELECT sum(totalamount) from saledetail where tableid='$sid'")->fetch(PDO::FETCH_NUM);
$bill=$drow[0];
if($tax)
$taxamount=round($bill*$tax/100);
else
$taxamount=0;
$net=round($bill+$taxamount);
echo "<tr>
<td>$sid</td>
<td data-sort>$date1</td>
<td>$area</td>
<td>$saleman</td>
<td>$customer</td>
<td>$bill</td>
<td>$tax</td>
<td>$net</td>
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
                .column(5, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                        }, 0);
                var total2 = api
                .column(6, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                        }, 0);
                var total3 = api
                .column(7, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                        }, 0);

                
          
          
    $( api.column(5).footer() ).html(numberWithCommas(Math.round(total1)));
    $( api.column(6).footer() ).html(numberWithCommas(Math.round(total2)));
    $( api.column(7).footer() ).html(numberWithCommas(Math.round(total3)));
        
        
    
},
  
  
  
  
   });
   
  }
});
    </script>
   
   
