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
                    <h3>Company List</h3>
					
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
<table class="table table-striped table-hover text-dark mb-2" id="user_data" style="width:100%;">
                        
<thead>
<tr>
<th >Companey Id</th>
<th >Companey IBL Code</th>
<th >Companey Name</th>
<th >Address</th>
<th >DSR Code</th>
<th >SAS Code</th>

</tr>
</thead>
<tbody>

  
<?php
include "db.php";
// $q="select a.*,b.arianame,c.mode
// from customers as a ,ariainfo as b,cus_mode as c
// where a.area=b.sno and a.mode=c.sno;
// ";

$q="select * from customers where customertype=2";


$s=$dbpdo->prepare($q);
$s->execute();
while($row = $s->fetch(PDO::FETCH_BOTH)){

echo "<tr>
<td>$row[0]</td>
<td>$row[1]</td>
<td>$row[2]</td>
<td>$row[address]</td>
<td>$row[dsr]</td>
<td>$row[sas]</td>

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
                <h5 class="modal-title" id="myLargeModalLabel">Company Entry Form</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
        
        
              <div class="modal-body">
        
        <div class="card">
                  
                  <div class="card-body">
          
<form class="forms-sample" id="item-entry">

  

      <div class="form-group">

<label for="item">Company ID</label>
<input type="text" id="f1" name=f1 class="form-control"  placeholder="Company ID" autocomplete="off" required>
</div>

       <div class="form-group">

<label for="item">Company  Code</label>
<input type="text" id="f2" name=f2 class="form-control"  placeholder="Company code" autocomplete="off" required>
</div>

  <div class="form-group">

<label for="item">Company Name</label>
<input type="text" id="f3" name=f3 class="form-control"  placeholder="Company Name" autocomplete="off" required>
</div>




 <div class="form-group">

<label for="item">Address</label>
<input type="text" id="f4" name=f4 class="form-control"  placeholder="Address" autocomplete="off">
</div>

<div class="form-group">
<label for="item">DSR Code</label>
<input type="text" id="f5" name=f5 class="form-control"  placeholder="DSR Code" autocomplete="off">
</div>

<div class="form-group">
<label for="item">SAS Code</label>
<input type="text" id="f6" name=f6 class="form-control"  placeholder="SAS Code" autocomplete="off">
</div>




  </div>
  
<div class="card-footer">
                    <button type="submit" class="btn btn-primary btn-block mr-2">Add Company</button>
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
       text: 'Add New Company',
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
var formData = new FormData();
var others=$("#item-entry").serializeArray();
$.each(others,function(key,input) {
  formData.append(input.name,input.value)
});



  $.ajax({
         url: "ajaxcall/add-Company.php",
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

	 