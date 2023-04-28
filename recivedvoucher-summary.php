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
<label for="field-3" >Select Start Date<span class="required">*</span></label>
<input type="text" class="form-control datepicker"  name=f2 id="f2" autocomplete="off" value=<?php echo $date ?> >
      </div>
       </div>
   
<div class="col-sm-6">
<div class="form-group">
<label for="field-3" >Select End  Date<span class="required">*</span></label>
<div class="input-group">
<input type="text" class="form-control datepicker"  name=f3 id="f3" autocomplete="off" value=<?php echo $date ?> >
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
                    <h3>Recieved Vouchers Summary</h3>
					
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
<table class="table table-striped table-hover text-dark mb-2" id="user_data" style="width:100%;">
                        
<thead>
<tr>
<th >Id</th>
<th >TID</th>
<th >Date</th>
<th >Amount</th>
<th >Detials</th>
</tr>
</thead>
<tbody>
<?php 
if(!empty($_POST['f2']))
        {
        $sdate=$_POST['f2']; 
        $edate=$_POST['f3']; 
      }
      else 
      {
        $sdate=date("Y-m-d");
  $edate=date("Y-m-d");
      }
        
$q2="SELECT id,date,sum(debit) FROM `payments` where date>='$sdate' and date<='$edate' and (`accounthead`='rsimple' or `accounthead`='collection') group by date";
$stmt23 = $dbpdo->prepare($q2);
$stmt23->execute();
$trecord=$stmt23->rowCount();
if($trecord)
{ 
$cnt=0;
while ($row = $stmt23->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_NEXT))
{
$rid=$row[0];
$cdate=$row[1];
$amount=$row[2];
$date1 = date("Ymd", strtotime($cdate));
$date2 = date("d-m-Y", strtotime($cdate));

$row1=$dbpdo->query("SELECT name,id from customers")->fetch(PDO::FETCH_NUM);
$saleman=$row1[0];
$salemancode=$row1[1];
$description="";
$q2="select a.debit,b.name,c.pmode
from payments as a ,customers as b,paymentmode as c
where a.cid=b.id and a.paymentmode=c.id and a.paymentmode<>1 and a.date='$cdate' and (a.accounthead='rsimple' or a.accounthead='collection') order by date";
$s1=$dbpdo->prepare($q2);
$s1->execute();
while($row1 = $s1->fetch(PDO::FETCH_BOTH)){

$description.=$row1[0]." From ".$row1[1]."payement mode $row1[2]<br>";
}

$cnt++;
echo "
<tr>
<td>$cnt</td>
<td>$row[0]</td>
<td data-sort='$date1'>$date2</td>
<td>$row[2]</td>
<td>$description</td>

</tr>";
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
      
      
            var total = api
                .column(3, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                        }, 0);

              
          
    $( api.column(3).footer() ).html(numberWithCommas(total));
        
    
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

	 