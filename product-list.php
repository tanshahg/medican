<?php 
include "secure.php";
include "include/header.php";
date_default_timezone_set("Asia/Karachi");
$date=date("Y-m-d");
if(empty($_POST['tcode']))
$tcode=201002;
else
$tcode=$_POST['tcode'];
?>

<style>
.form-control1 {
    display: block;
  
    height: calc(1.5em + 0.75rem + 2px);
    padding: 0.375rem 0.75rem;
    font-size: 1rem;
    font-weight: 400;
    line-height: 1.5;
    color: #495057;
    background-color: #fff;
    background-clip: padding-box;
    border: 1px solid #ced4da;
    border-radius: 0.25rem;
    -webkit-transition: border-color .15s ease-in-out,-webkit-box-shadow .15s ease-in-out;
    transition: border-color .15s ease-in-out,-webkit-box-shadow .15s ease-in-out;
    transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;
    transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out,-webkit-box-shadow .15s ease-in-out;
}
</style>  
  
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
                    <h3>product List</h3>
  <form method=post id="cselect">    
            
<select name="tcode" id="tcode" class="mx-5 form-control1">
  <option value="">Select Company</option>    
  <?php
$s=$dbpdo->prepare("select * from customers where customertype=2 order by id");
$s->execute();
while($row = $s->fetch(PDO::FETCH_BOTH)){
  if($row[0]==$tcode)
echo "<option selected value='$row[0]'>$row[2]</option>";
else
echo "<option  value='$row[0]'>$row[2]</option>";
}
?>
</select>
</form>
					
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
<table class="table table-striped table-hover text-dark mb-2" id="user_data" style="width:100%;">
                        
<thead>
<tr>
<th >Edit</th>
<th >Id</th>
<th >Company Code</th>
<th >Product Name</th>
<th >Companey Name</th>
<th >Group</th>
<th >Formula</th>
<th >MRP</th>
<th >TP</th>
<th >TP Rate</th>
<th >Discount</th>
<th >Net Price</th>
<th >Sale Tax</th>
<th >Further Tax</th>
<th >Sale Price</th>


</tr>
</thead>
<tbody>

  
<?php
include "db.php";


$q="select a.*,b.name,c.gname,d.formula
from products as a ,customers as b,companygroups as c,formulainfo as d
where a.ccode=b.id and a.ccode=$tcode and a.gcode=c.id and a.fcode=d.id order by a.id DESC;
";




$s=$dbpdo->prepare($q);
$s->execute();
while($row = $s->fetch(PDO::FETCH_BOTH)){
  $sale=0;
  if($row[11]!=0) $sale=$row[11];
  $tp=round($row[7]-$row[7]*$row[8]/100,2);
  if($row[11]==0)
  {
    $sale=$tp;
    if($row[9])
      $sale=round($sale-$sale*$row[9]/100,2);
 
}


echo "<tr>
<td>";
if($_SESSION['edit']==1)
echo "<a href='editproducts.php?id=$row[0]'><i class='fas fa-edit'></i></a>";
else echo "";
echo "
</td>
<td>$row[0]</td>
<td>$row[1]</td>
<td>$row[2]</td>
<td>$row[13]</td>
<td>$row[14]</td>
<td>$row[15]</td>
<td>$row[7]</td>
<td>$row[8]</td>
<td>$tp</td>
<td>$row[9]</td>
<td>$row[11]</td>
<td>$row[10]</td>
<td>$row[12]</td>
<td>$sale</td>

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
                <h5 class="modal-title" id="myLargeModalLabel">product Entry Form</h5>
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

<label for="item">Company Code</label>
<input type="text" id="f1" name=f1 class="form-control"  placeholder="Company Code" required>
</div>

       <div class="form-group">
<label for="item">product Name</label>
<input type="text" id="f2" name=f2 class="form-control"  placeholder="product name" autocomplete="off" required>
</div>

<div class="form-group ">
<label for="item">Company</label>
<select name="f3" id="f3" class="form-control">
  <option value="">Select Company</option>
  <?php
$s=$dbpdo->prepare("select * from customers where customertype=2");
$s->execute();
while($row = $s->fetch(PDO::FETCH_BOTH)){
echo "<option value='$row[0]'>$row[2]</option>";
}
?>
</select>

                    </div>

                    <div class="form-group ">
<label for="item">Group</label>
<select name="f4" id="f4" class="form-control">
  
</select>

                    </div>


                    <div class="form-group ">
<label for="item">Formula</label>
<select name="f5" id="f5" class="form-control">
  
  <?php
$s=$dbpdo->prepare("select * from formulainfo");
$s->execute();
while($row = $s->fetch(PDO::FETCH_BOTH)){
echo "<option value='$row[0]'>$row[1]</option>";
}
?>
</select>
</div>

<div class="form-group">

<label for="item">Sale Tax</label>
<input type="text" id="f12" name=f12 class="form-control"  placeholder="Sale Tax" autocomplete="off">
</div>

</div>
  <div class="col-md-6">


  <div class="form-group">

<label for="item">M.R.P</label>
<input type="text" id="f7" name=f7 class="form-control"  placeholder="MRP" required>
</div>

 <div class="form-group">

<label for="item">TP</label>
<div class="input-group">
<input type="text" id="f8" name=f8 class="form-control"  placeholder="TP" required>
<input type="text" id="c" name=c class="form-control"   autocomplete="off">
</div>
</div>

<div class="form-group">

<label for="item">Discount 1</label>
<input type="text" id="f9" name=f9 class="form-control"  placeholder="discount 1" autocomplete="off">
</div>

<div class="form-group">

<label for="item">Discount 2</label>
<input type="text" id="f10" name=f10 class="form-control"  placeholder="discount 2" autocomplete="off">
</div>

<div class="form-group">

<label for="item">Net Price</label>
<input type="text" id="f11" name=f11 class="form-control"  placeholder="Net price" autocomplete="off">
</div>


<div class="form-group">

<label for="item">Further Tax</label>
<input type="text" id="f13" name=f13 class="form-control"  placeholder="Further Tax" autocomplete="off">
</div>

 


</div>

  </div>
  
<div class="card-footer">
                    <button type="submit" class="btn btn-primary btn-block mr-2">Add product</button>
                  </div>
          
            </div>



              </div>
            </div>
          </div>
        </div>
    
   

<script type="text/javascript" language="javascript" >
 
 $(document).ready(function(){

$("#f7").keyup(function(){

  var sale=Number($("#f7").val());
if($("#f8").val().length)
var p=Number($("#f8").val());
else var p=0;

var n=sale-sale*p/100;
$("#c").val(n);

});

$("#f8").keyup(function(){

var sale=Number($("#f7").val());
var p=Number($("#f8").val());
var n=sale-sale*p/100;
$("#c").val(n);
});

$("#f3").change(function(){

  $.post("ajaxcall/getgroups.php", {id: $("#f3").val()}, function(result){

 
    $("#f4").empty().append(result);


  });


});


$("#tcode").change(function(e){
  e.preventDefault();
  $("#cselect").submit();

  });



  
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
       text: 'Add New product',
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
   if($('#f2').val().length === 0  ) {
         iziToast.warning({
    title: 'error!',
    message: 'Product  Information is not complete',
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
         url: "ajaxcall/add-product.php",
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

	 