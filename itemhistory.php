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
      
      <div class="col-md-12">
            <div class="card card-primary">
                        <div class="card-body ">
      <form class="forms-sample" method=post id="search-form">  
              
      <div class="row">
      
      <div class="col-sm-2">
      <div class="form-group">
    <label for="field-3" >Select Start Date<span class="required">*</span></label>
  
   <div class="input-group">
     <input type="text" class="form-control datepicker" place="Start Date" name=sdate id="sdate" autocomplete="off" value=<?php echo $date ?> >
   </div>
   </div>
   </div>
   
<div class="col-sm-2">
<div class="form-group">
<label for="field-3" >Select End Date<span class="required">*</span></label>

<input type="text" class="form-control datepicker" place="Start Date" name=edate id="edate" autocomplete="off" value=<?php echo $date ?> >
</div>
</div>


<div class="col-sm-2">
<div class="form-group">
<label for="field-3" >Criteria<span class="required">*</span></label>
<select name="f1" id="f1" class="form-control" required>
    <option value="">Select Criteria</option>
 <option value="1">Sale</option>
 <option value="2">Sale Return</option>
 <option value="3">Purchase</option>
 <option value="4">Purchase Retrun Return</option>

</select>
</div>
</div>

  
<div class="col-sm-3">
<label for="field-3" >Select Product<span class="required">*</span></label>
<select name="f2" id="f2" class="form-control" required>
  <option value="">Select product</option>
</select>
      </div>
     

<div class="col-sm-3">
<div class="form-group">
<label for="field-3" >Select Batch<span class="required">*</span></label>
<div class="input-group">
<select name="f3" id="f3" class="form-control" >
    <option value="">batch</option>
 
</select>
<div class="input-group-append">
<button type=submit class="btn btn-danger"><i class="fa fa-search"></i></button>

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
                    <h3>Product History</h3>
					
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
<table class="table table-striped table-hover text-dark mb-2" id="user_data" style="width:100%;">
                        
<thead>
<tr>
<th >Sno</th>
<th >Product Name</th>
<th >Invoice #</th>
<th >Date</th>
<th >Customer Name</th>
<th >Batch #</th>
<th >Unit Price</th>
<th >Quantity</th>
<th >Bonus</th>
<th >Discount</th>
<th >Amount</th>

</tr>
</thead>
<tbody>
<?php 
if(!empty($_POST['f1']))
        {
            $c=$_POST['f1'];
            $pid=$_POST['f2'];
            $batch=$_POST['f3'];
            $sdate=$_POST['sdate'];
            $edate=$_POST['edate'];
            switch($c)
{
    case 1:
    $table="saledetail";
    break;
    case 2:
    $table="salereturndetail";
    break;
    case 3:
    $table="stockdetail";
    break;
    case 4:
    $table="stockreturndetail";
    break;
}
$mtable=substr($table,0,-6);
if($c==1 or $c==2)
{
$sno=0;
$q="SELECT a.*,b.name as productname,c.id,c.customercode,d.name,c.date as date1
from $table as a , products as b, $mtable as c,customers as d
where a.productcode=b.id and c.id=a.tableid and c.customercode=d.id and a.productcode=$pid and c.date>='$sdate' and c.date<='$edate'";



if(!empty($batch))
$q.="  and a.batchno='$batch'";
$s = $dbpdo->prepare($q);
$s->execute();
while($row = $s->fetch(PDO::FETCH_BOTH)){

    $date2=date("d-m-Y",strtotime($row['date1']));
    $sno++;
    
       echo "
<tr>
<td>$sno</td>
<td>$row[productname]</td>
<td>$row[1]</td>
<td>$date2</td>
<td>$row[name]</td>
<td>$row[4]</td>
<td>$row[11]</td>
<td>$row[6]</td>
<td>$row[7]</td>
<td>$row[12]</td>
<td>$row[8]</td>
</tr>
       ";
        
}
}
else 
{

$sno=0;
$q="SELECT a.*,b.name as productname,c.id,c.scode,d.name 
from $table as a , products as b, $mtable as c,customers as d
where a.productcode=b.id and c.id=a.tableid and c.scode=d.id and a.productcode=$pid  and c.date>='$sdate' and c.date<='$edate'";
if(!empty($batch))
$q.="  and a.batchno='$batch'";


$s = $dbpdo->prepare($q);
$s->execute();
while($row = $s->fetch(PDO::FETCH_BOTH)){
    $sno++;
    $qty=$row[6];
    $netrate=$row[14];
    $mrp=$row[10];
    $tp=$row[11];
    $dis=$row[12];
    
    
       echo "
<tr>
<td>$sno</td>
<td>$row[productname]</td>
<td>$row[1]</td>
<td>$row[5]</td>
<td>$row[name]</td>
<td>$row[4]</td>
<td>$row[11]</td>
<td>$row[6]</td>
<td>$row[7]</td>
<td>$row[12]</td>
<td>$row[8]</td>
</tr>
       ";
        
}
}
   echo "     
        
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
";
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

$("#f1").change(function(){

var c=$("#f1").val();
  $.post("ajaxcall/changecriteria.php",{c:c},function(result){
    $("#f2").empty().append(result);

  })

});

$("#f2").change(function(){

var c=$("#f1").val();
var pid=$("#f2").val();
  $.post("ajaxcall/getbatch.php",{c:c,pid:pid},function(result){
    $("#f3").empty().append(result);

  })

});



  
  fetch_data();


   function fetch_data()
  {
    
   var dataTable = $('#user_data').DataTable({
     
        
        "scrollY": 300,
        "scrollX": true,
     "pageLength": 100,
    
     
         "lengthMenu": [[100,500,100, -1], [100,500,1000, "All"]],
        
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
      
      
            var total = api
                .column(10, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                        }, 0);

var total1 = api
                .column(7, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                        }, 0);

              
          
    $( api.column(7).footer() ).html(numberWithCommas(Math.round(total1)));
    $( api.column(10).footer() ).html(numberWithCommas(Math.round(total)));
        
    
},
  
  
  
  
   });
   

   
  }
  
  $(document).on('click', '.delete', function(){
   var id = $(this).attr("id");
   swal({
    title: 'Are you sure?',
    text: 'Once deleted, you will not be able to recover this!',
    icon: 'warning',
    buttons: true,
    dangerMode: true,
  })
    .then((willDelete) => {
      if (willDelete) {
    $.ajax({

     url:"ajaxcall/delete-voucher.php",
     method:"POST",
     data:{id:id},
     success:function(data){
     location.reload();
     }
     });
    
  } 
   });
    });


  
  
  $("#itemlist-entry-modal").on("show.bs.modal",function(event) {
  $('#item-entry').trigger("reset");
});



$("#item-entry").on('submit',(function(e) {
  e.preventDefault();
var formData = new FormData();
var others=$("#item-entry").serializeArray();
$.each(others,function(key,input) {
  formData.append(input.name,input.value)
});



  $.ajax({
         url: "ajaxcall/add-simplervoucher.php",
   method: "post",
   data:  formData,
   contentType: false,
         cache: false,
   processData:false,
   dataType: "json",
   error:function(xhr)
   {
     alert(xhr.responseText);
   },
     success: function(data)
      {
        if(data.a>0)
      {
   
  iziToast.success({
    title: 'success!',
    message: 'Record is Added in database',
    position: 'bottomRight'
  });

    $("#item-entry").trigger("reset");
    window.location.href = "print-simplervoucher.php?code="+data.a;
  }
      },          
    });
 }));

  
  

 });
 </script>

	 