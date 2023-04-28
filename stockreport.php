<?php 
include "secure.php";
include "include/header.php";
date_default_timezone_set("Asia/Karachi");
$date=date("Y-m-d");
?>


  
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
<label for="field-3" >Select Company<span class="required">*</span></label>
<select name="f1" id="f1" class="form-control" >
  
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
   
<div class="col-sm-6">
<div class="form-group">
<label for="field-3" >Select Product<span class="required">*</span></label>
<div class="input-group">
<select name="f2" id="f2" class="form-control" >
 <option value="">All</option>
   <?php
$s=$dbpdo->prepare("select * from products");
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
       </div>
     </form>
       
       </div>
       </div>
       </div></div>
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h3>Stock Details</h3>
					
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
<table class="table table-striped table-hover text-dark mb-2" id="user_data" style="width:100%;">
                        
<thead>
<tr>
<th >Product Id</th>
<th >Company Name</th>
<th >Product Name</th>
<th >Batch #</th>
<th >Exp-Date</th>
<th >MRP</th>
<th >TP</th>
<th >Net Rate</th>
<th >Unit Price</th>
<th >Quantity</th>
<th >Bonus</th>
<th >Net-Qty</th>
<th >Net-Value</th>
</tr>
</thead>
<tbody>
<?php 
if(empty($_POST['f2'])) 
$s=$dbpdo->prepare("SELECT a.*,b.* FROM `products` as a, stockdetail as b
where a.id=b.productcode and  b.inhand>0 order by a.name");
else
{
  $pid=$_POST['f2'];
$s=$dbpdo->prepare("SELECT a.*,b.* FROM `products` as a, stockdetail as b
where a.id=$pid and a.id=b.productcode and  b.inhand>0 order by a.name");  
}


$s->execute();
while($row = $s->fetch(PDO::FETCH_BOTH)){
  $tp=$row[7]-round($row[7]*$row[8]/100);
  if(!empty($row[11])) $uprice=$row[11]; else
  { 
    if(!empty($row[9]))
    $uprice=round($tp-$tp*$row[9]/100);
    else
    $uprice=$tp;  
  }
if(!empty($row[19])) {
  $qty=$row[28]-$row[19];
  $bonus=$row[19];
}
else {
    $qty=$row[28];
    $bonus=0;
}
$tqty=$qty+$bonus;
$netvalue=$tqty*$uprice;
$date1=date("Ymd",strtotime($row[17]));
$date2=date("d-m-Y",strtotime($row[17]));

echo "
<tr>
<td>$row[0]</td>
<td>IBL</td>
<td>$row[2]</td>
<td>$row[16]</td>
<td data-sort='$date1'>$date2</td>
<td>$row[7]</td>
<td>$tp</td>
<td>$row[11]</td>
<td>$uprice</td>
<td>$qty</td>
<td>$bonus</td>
<td>$tqty</td>
<td>$netvalue</td>
</tr>";
}



?>
  

  
        
        


         
        
        </tbody>
<tfoot >
    <tr>
    <th ></th><th ></th><th ></th><th ></th><th ></th>
    <th ></th><th ></th><th ></th><th ></th><th ></th>
    <th ></th><th ></th><th ></th>
    
    
    
    
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
	 
    
   

<script type="text/javascript" language="javascript" >
 
 $(document).ready(function(){

$("#f3").change(function(){

var cid=$("#f3").val();
  $.post("ajaxcall/getbalance.php",{cid:cid},function(result){
    $("#ff3").val(result);

  })

});



  
  fetch_data();


   function fetch_data()
  {
    
   var dataTable = $('#user_data').DataTable({
     
        
        "scrollY": 300,
        "scrollX": true,
     "pageLength": 10,
    
     
         "lengthMenu": [[10, 25, 50,100, -1], [10, 25, 50,100, "All"]],
        
               "dom": "<'row '<'col-md-12'B>><'row'<'col-md-12'>><'row'<'col-md-12'flrt>>ip",
      buttons: [

            { extend: 'print', footer: true },
            { extend: 'excel', footer: true },
            { extend: 'pdf', footer: true },
            { extend: 'colvis', footer: true },
            <?php if($entry==1)
          echo "
       {
       text: 'Add New Voucher',
      action: function ( e, dt, button, config ) {
       window.location.href='collection.php';
        } 
        
        },  ";
?>        
            
        
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
                .column(8, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                        }, 0);
                 var total2 = api
                .column(9, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                        }, 0);

                 var total3 = api
                .column(10, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                        }, 0);

                 var total4 = api
                .column(11, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                        }, 0);

                 var total5 = api
                .column(12, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                        }, 0);

              
          
    $( api.column(8).footer() ).html(numberWithCommas(total1));
    $( api.column(9).footer() ).html(numberWithCommas(total2));
    $( api.column(10).footer() ).html(numberWithCommas(total3));
    $( api.column(11).footer() ).html(numberWithCommas(total4));
    $( api.column(12).footer() ).html(numberWithCommas(total5));
        
    
},
  
  
  
  
   });
   
  }
  
  $(document).on('click', '.delete', function(e){
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

     url:"ajaxcall/delete-collection.php",
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

	 