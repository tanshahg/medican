<?php 
include "secure.php";
include "include/header.php";
date_default_timezone_set("Asia/Karachi");
$date=date("Y-m-d");
unset($_SESSION["shopping_cart"]);
unset($_SESSION["shopping_heads"]);
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
           <div class="col-4">
                 <div class="card">
                  
                  <div class="card-body">
          
<form class="forms-sample" id="item-entry">

  <div class="row">
    <div class="col-md-12">

      <div class="form-group ">
<label for="item">Saleman</label>
<select name="f0" id="f0" class="form-control">
  <option value="">Select Sale Man</option>
  <?php
$s=$dbpdo->prepare("select * from  customers where customertype=3");
$s->execute();
while($row = $s->fetch(PDO::FETCH_BOTH)){
echo "<option value='$row[0]'>$row[2]</option>";
}
?>
</select>

                    </div>

    <div class="form-group">
<label for="item">Date</label>
<input type="text" id="f1" name=f1 class="form-control datepicker" autocomplete="off" value="<?php echo $date ?>" required>
</div>




       <div class="form-group">
<label for="item">Type</label>
<select name="f2" id="f2" class="form-control">
  
  <?php
$s=$dbpdo->prepare("select * from paymentmode where id>1");
$s->execute();
while($row = $s->fetch(PDO::FETCH_BOTH)){
echo "<option value='$row[0]'>$row[1]</option>";
}
?>
</select>
</div>

<div class="form-group ">
<label for="item">Customer</label>
<select name="f3" id="f3" class="form-control">
  <option value="">Select Customer</option>
  <?php
$s=$dbpdo->prepare("select * from customers where customertype=1");
$s->execute();
while($row = $s->fetch(PDO::FETCH_BOTH)){
echo "<option value='$row[0]'>$row[2]</option>";
}
?>
</select>

                    </div>


<div class="form-group ">
<label for="item">Amount</label>
<input type="text" id="f4" name=f4 class="form-control" placehodler="Amount">
</div>

 <div class="form-group ">
<label for="item">Details</label>
<textarea  id="f5" name=f5 class="form-control" placehodler="Details"></textarea>
  
  
</div>

</div>
  

  </div>
  
<div class="card-footer">
                    <button type="submit" class="btn btn-primary btn-block mr-2">Add Voucher</button>
                  </div>
          
            </div>



              </div>
           </div>
           <div class="col-8">
             <div class="card">
               <div class="card-body">
                 <div id="output"></div>
               </div>
             </div>
           </div>
         </div>

         <div class="d-flex justify-content-end">
             
              <button id="sdata"  class="btn btn-dark" >Save Data</button>
         
            </div>
         
              </div>
            </div>
          
        </section>
        
     <?php include "include/footer.php";?>
	
    
   


<script type="text/javascript" language="javascript" >
 
 $(document).ready(function(){

  

 
  

  




  $("#sdata").click(function(e) {
  e.preventDefault();

  $.post("ajaxcall/addcollection.php",function(result){

    iziToast.success({
    title: 'success!',
    message: 'Record is Added in database',
    position: 'bottomRight'
  });

  
  window.location.href = "rvoucheradvance-list.php";
  });
  });


$("#item-entry").on('submit',(function(e) {
  e.preventDefault();
var formData = new FormData();
var others=$("#item-entry").serializeArray();
$.each(others,function(key,input) {
  formData.append(input.name,input.value)
});



  $.ajax({
         url: "ajaxcall/add-collection.php",
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
       $("#output").html(data.a);
       $("#f3").val("");
       $("#f4").val("");
       $("#f5").val("");
      
      {
   
  
  }
      },          
    });
 }));



});

 $(document).on("click", ".delno", function(){
  var id=this.id;
  $.ajax({
type: "POST",
url: "ajaxcall/action.php",
dataType:"json",
cache: false,
data: {code: id,opt: "del-payment"},
success:function(data) {
    
       $("#output").html(data.a);
    

}
});
  });



  



 


 </script>

   


  
  
