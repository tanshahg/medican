<?php 
include "secure.php";
include "include/header.php";
?>

  
  
</head>

<body >
  <div class="loader"></div>
  <?php include "include/menu.php"; ?>
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-body">
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h3>Accounts Head List</h3>
					
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
<table class="table table-striped table-hover text-dark mb-2" id="user_data" style="width:100%;">
                        
<thead>
<tr>
<th >Head Id</th>
<th >Head Name</th>
<th >Account ID</th>
<th >Related Account Name</th>

</tr>
</thead>
<tbody>

  
<?php
include "db.php";
$q="select a.*,b.account_name
from mainhead as a ,account as b
where a.acid=b.acid

";

$s=$dbpdo->prepare($q);
$s->execute();
while($row = $s->fetch(PDO::FETCH_BOTH)){

echo "<tr>
<td>$row[0]</td>
<td>$row[2]</td>
<td>$row[1]</td>
<td>$row[4]</td>



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
                <h5 class="modal-title" id="myLargeModalLabel">Account Head Entry Form</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
        
        
              <div class="modal-body">
        
        <div class="card">
                  
                  <div class="card-body">
          
<form class="forms-sample" id="item-entry">
                      <div class="form-group">

<label for="item">Account ID</label>
<input type="text" id="f1" class="form-control"  placeholder="Account ID" autocomplete="off">
</div>
                      <div class="form-group ">
<label for="item">Account Category</label>
<select name="f2" id="f2" class="form-control">
  <?php
$s=$dbpdo->prepare("select * from account");
$s->execute();
while($row = $s->fetch(PDO::FETCH_BOTH)){
echo "<option value='$row[0]'>$row[1]</option>";
}
?>
</select>

                    </div>
          
                      <div class="form-group ">
                      <label for="item">Account Head Name</label>
                      <input type="text" name="f3" id="f3" class="form-control" placeholder="Account Head Name">

                    </div>
                              
          
          
          

</div>
<div class="card-footer">
                    <button type="submit" class="btn btn-primary btn-block mr-2">Add Head </button>
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
       text: 'Add New Head',
      action: function ( e, dt, button, config ) {
       $('#itemlist-entry-modal').modal('toggle');
        } 
        
        },  ";
?>        
           
        ],
 
   });
  }
  




     
 
  
  
  
  


    
  
  
    
    
  
  
  
  $("#itemlist-entry-modal").on("show.bs.modal",function(event) {
  $('#item-entry').trigger("reset");
});

  
  $("#item-entry").submit(function(e) {
    e.preventDefault();
    
  $.post("ajaxcall/addhead.php", {f1: $("#f1").val(),f2: $("#f2").val(),f3: $("#f3").val()}, function(result){
  
  
  if(result == 1)
    { 
  swal('Head Name', ' already in list!', 'error');
  
return; 
  }
  else
  {
    iziToast.success({
    title: 'success!',
    message: 'Record is Added in database',
    position: 'bottomRight'
  });
    $('#item-entry').trigger("reset");
    $('#itemlist-entry-modal').modal('toggle');
    location.reload()
       
    
    
  }
    });
  
}); 


 });
 </script>

	 