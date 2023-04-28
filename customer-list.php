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
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h3>Customer List</h3>
					
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
<table class="table table-striped table-hover text-dark mb-2" id="user_data" style="width:100%;">
                        
<thead>
<tr>
<th >Edit</th>
<th >Cusotmer Id</th>
<th >Cusotmer Company Id</th>
<th >Cusotmer Name</th>
<th >Area</th>
<th >Address</th>
<th >Contact Person</th>
<th >Mode</th>
<th >licence</th>
<th >licence Expiry Date</th>
<th >Phone #</th>
<th >Mobile #</th>
<th >Tax</th>


</tr>
</thead>
<tbody>

  
<?php
include "db.php";
$q="select a.*,b.arianame,c.mode
from customers as a ,ariainfo as b,cus_mode as c
where a.area=b.sno and a.mode=c.id and a.customertype=1 order by a.id DESC;
";

$s=$dbpdo->prepare($q);
$s->execute();
while($row = $s->fetch(PDO::FETCH_BOTH)){

echo "<tr>
<td>";
if($_SESSION['edit']==1)
echo "<a href='editcustomer.php?id=$row[0]'><i class='fas fa-edit'></i></a>";
else
echo "";
echo "
</td>
<td>$row[0]</td>
<td>$row[1]</td>
<td>$row[2]</td>
<td>$row[arianame]</td>
<td>$row[4]</td>
<td>$row[5]</td>
<td>$row[mode]</td>
<td>$row[7]</td>
<td>$row[8]</td>
<td>$row[9]</td>
<td>$row[10]</td>
<td>$row[tax]</td>

</tr>
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
	 <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
          aria-hidden="true" id="itemlist-entry-modal">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="myLargeModalLabel">Customer Entry Form</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
        
        
              <div class="modal-body">
        
        <div class="card">
                  
                  <div class="card-body">
          
<form class="forms-sample" id="item-entry">

  <div class="row">
    <div class="col-md-6">

      <div class="form-group">
<?php
$row=$dbpdo->query("SELECT max(id) from customers where customertype=1")->fetch(PDO::FETCH_NUM);
$tcid=$row[0]+1;
?>
<label for="item">Customer ID</label>
<input type="text" id="f1" name=f1 class="form-control"  placeholder="Customer ID" value ="<?php echo $tcid;?>" readonly>
</div>

       <div class="form-group">

<label for="item">Customer Company Code</label>
<input type="text" id="f2" name=f2 class="form-control"  placeholder="Customer Company ID" autocomplete="off" required>
</div>

  <div class="form-group">

<label for="item">Customer Name</label>
<input type="text" id="f3" name=f3 class="form-control"  placeholder="Customer Name" autocomplete="off" required>
</div>


<div class="form-group ">
<label for="item">Area</label>
<select name="f4" id="f4" class="form-control">
  <?php
$s=$dbpdo->prepare("select * from ariainfo");
$s->execute();
while($row = $s->fetch(PDO::FETCH_BOTH)){
echo "<option value='$row[0]'>$row[2]</option>";
}
?>
</select>

                    </div>

 <div class="form-group">

<label for="item">Address</label>
<input type="text" id="f5" name=f5 class="form-control"  placeholder="Address" autocomplete="off">
</div>

<div class="form-group">
<label for="item">Contact Persoan</label>
<input type="text" id="f6" name=f6 class="form-control"  placeholder="Contact Person" autocomplete="off">
</div>




  </div>
  <div class="col-md-6">
    <div class="form-group ">
<label for="item">Mode</label>
<select name="f7" id="f7" class="form-control">
  <?php
$s=$dbpdo->prepare("select * from cus_mode");
$s->execute();
while($row = $s->fetch(PDO::FETCH_BOTH)){
echo "<option value='$row[0]'>$row[1]</option>";
}
?>
</select>

                    </div>

    <div class="form-group">

<label for="item">Customer Licence</label>
<input type="text" id="f8" name=f8 class="form-control"  placeholder="Customer Licence" autocomplete="off">
</div>

    
      <div class="form-group">
    <label for="field-3" >Licence Validity Date<span class="required">*</span></label>
  
   <div class="input-group">
     <input type="text" class="form-control datepicker"  name=f9 id="f9" autocomplete="off" value=<?php echo $date ?> >
   </div>
   </div>

 <div class="form-group">
<label for="item">Phono #</label>
<input type="text" id="f10" name="f10" class="form-control"  placeholder="Phone #" autocomplete="off">
</div>


 <div class="form-group">
<label for="item">Mobile #</label>
<input type="text" id="f11" name="f11" class="form-control"  placeholder="Mobile #" autocomplete="off" required>
</div>
    

<div class="form-group">
<label for="item">Tax</label>
<input type="text" id="f12" name=f12 class="form-control"  placeholder="Tax" autocomplete="off">
</div>
</div>
</div>
<div class="card-footer">
                    <button type="submit" class="btn btn-primary btn-block mr-2">Add Customer</button>
                  </div>
          
            </div>



              </div>
            </div>
          </div>
        </div>
    
   

<script type="text/javascript" language="javascript" >
 
 $(document).ready(function(){


  
  fetch_data();

  function fetch_data()
  {
    
   var dataTable = $('#user_data').DataTable({
     
        
        "scrollY": 300,
        "scrollX": true,
     
     "scrollX": true,
     "pageLength": 50,
     "deferLoading": 50,
     
     
         "lengthMenu": [[10, 25, 50,100, -1], [10, 25, 50,100, "All"]],
        
               "dom": "<'row '<'col-md-12'B>><'row'<'col-md-12'>><'row'<'col-md-12'flrt>>ip",
    buttons: [
            {
                extend: 'print',
                exportOptions: {
                columns: ':visible'
                }},
        
      

      

             

            'colvis',
            'excel',
             'pdf',
       
        <?php if($entry==1)
          echo "
       {
       text: 'Add New Customer',
      action: function ( e, dt, button, config ) {
       $('#itemlist-entry-modal').modal('toggle');
       $('#f1').focus();
        } 
        
        },  ";
?>        
           
        ],
 
   });
  }
  




     
 
  
  
  
  


    
  
  
    
    
  
  
  
  $("#itemlist-entry-modal").on("show.bs.modal",function(event) {
  $('#item-entry').trigger("reset");
});



$("#item-entry").on('submit',(function(e) {
  e.preventDefault();

   if($('#f3').val().length === 0  ) {
         iziToast.warning({
    title: 'error!',
    message: 'Customer Information is not complete',
    position: 'middleCenter'
  }); 
         return;

    }
var formData = new FormData();
var others=$("#item-entry").serializeArray();
$.each(others,function(key,input) {
  formData.append(input.name,input.value)
});



  $.ajax({
         url: "ajaxcall/add-customer.php",
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
        if(data.a==1)
      {
   
  iziToast.success({
    title: 'success!',
    message: 'Record is Added in database',
    position: 'bottomRight'
  });

    $("#item-entry").trigger("reset");
    location.reload()
  }
      },          
    });
 }));

  
  

 });
 </script>

	 