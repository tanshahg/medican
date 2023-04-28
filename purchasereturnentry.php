<?php 
include "secure.php";
include "include/header.php";
date_default_timezone_set("Asia/Karachi");
$date=date("Y-m-d");
unset($_SESSION["shopping_cart"]);
unset($_SESSION["shopping_heads"]);
$row=$dbpdo->query("SELECT max(id) from stock")->fetch(PDO::FETCH_NUM);
$previousid=$row[0];
?>

 <style>
@import url('https://fonts.googleapis.com/css2?family=Roboto&display=swap');

    table tr td  {
    font-family: 'Roboto', sans-serif;
    height: 15px !important;
    font-size: 12px !important;
    border: 1px solid white;
    line-height: 15px !important;
    padding: 1px 0 0 3px !important;
    text-align: center;
    font-weight: bold;
  }
    

    

.input-group-text, select.form-control:not([size]):not([multiple]), .form-control:not(.form-control-sm):not(.form-control-lg) {
     font-family: 'Roboto', sans-serif;
     
     font-size: 12px !important;
}
</style>
  
</head>

<body >
  <!-- <div class="loader"></div> -->
  <?php include "include/menu.php"; ?>
      <!-- Main Content -->
      <div class="main-content">
        <form id="item-entry" method="post">
         
                <section class="section">
          <div class="section-body">
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h3>Purchase Return</h3>
					
                  </div>
                  <div class="card-body">
                 <div class="row">
                   <div class="col-md-4">
<div class="form-group">
<label for="item">Previous Vocher #</label>
<input type="text" id="f1" name=f1 class="form-control" value="<?php echo $previousid ?>">
</div>
</div>

<div class="col-md-4">
<div class="form-group">
<label for="item">Date</label>
<input type="text" id="f2" name=f2 class="form-control datepicker" autocomplete="off" required>
</div>
</div>


<div class="col-md-4">
<div class="form-group">
<label for="item">Supplier</label>
<select name="f3" id="f3" class="form-control" required>
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
</div>
</div>
<div class="row">

<div class="col-md-2">
<div class="form-group">
<label for="item">Cotton #</label>
<input type="text" id="f4" name=f4 class="form-control">
</div>
</div>

<div class="col-md-2">
<div class="form-group">
<label for="item">Courier</label>
<select name="f5" id="f5" class="form-control" required>
  
  <?php
$s=$dbpdo->prepare("select * from courier");
$s->execute();
while($row = $s->fetch(PDO::FETCH_BOTH)){
echo "<option value='$row[1]'>$row[1]</option>";
}
?>
</select>
</div>
</div>

<div class="col-md-2">
<div class="form-group">
<label for="item">Courier #</label>
<input type="text" id="f6" name=f6 class="form-control">
</div>
</div>

<div class="col-md-2">
<div class="form-group">
<label for="item">Invoice #</label>
<input type="text" id="f7" name=f7 class="form-control" required>
</div>
</div>

<div class="col-md-2">
<div class="form-group">
<label for="item">Ref Date</label>
<input type="text" id="f8" name=f8 class="form-control datepicker" autocomplete="off" required>
</div>
</div>

<div class="col-md-2">
<div class="form-group">
<label for="item">Page #</label>
<input type="text" id="f9" name=f9 class="form-control">
</div>
</div>

</div>
</div>
</div>


<div class="card">
  <div class="card-statistic-4">

    <div class="row">
      <div class="col-md-4">
         <div class="card shadow">
          <div class="card-body">

            <div class="form-group">
              
<label for="item">Product</label>
<select name="f10" id="f10" class="form-control" required>
 <option value="">Select Product</option>
   
 
 <?php
 

$s=$dbpdo->prepare("SELECT DISTINCT a.productcode,b.name FROM `stockdetail` as a , products as b where a.productcode=b.id and a.inhand>'0' order by b.name");
$s->execute();
while($row = $s->fetch(PDO::FETCH_BOTH)){
echo "<option value='$row[0]'>$row[1]</option>";
}
?>
</select>
</div>
        <div class="row">
      <div class="col-md-4">
<div class="form-group">
<label for="item">M.R.P</label>
<select name="f18" id="f18" class="form-control" required>
  <option value="">MRP</option>
 


</select>
</div>

        




<div class="form-group">
<label for="item">Batch #</label>
<select name="f12" id="f12" class="form-control" required>
  <option value="">Select Batch</option>
 


</select>
</div>

<div class="form-group">
<label for="item">Expiry Date</label>
<select name="f13" id="f13" class="form-control" required>
  <option value="">Expiry Date</option>
 


</select>
</div>



<div class="form-group">
<label for="item">Net Rate</label>
<input type="text" id="f21" name=f21 class="form-control">
</div>

</div>
      
      <div class="col-md-4">
        

        <div class="form-group">
<label for="item">Quantity</label>
<input type="text" id="f14" name=f14 class="form-control" required>
</div>

<div class="form-group">
<label for="item">Bonus Quantity</label>
<input type="text" id="f15" name=f15 class="form-control">
</div>

<div class="form-group">
<label for="item">Discount 1</label>
<input type="text" id="f20" name=f20 class="form-control" placeholder="dis 1">
</div>

<div class="form-group">
<label for="item">T.P Rate</label>
<input type="text" id="f19" name=f19 class="form-control" required>
</div>








      </div>
      <div class="col-md-4">
        

<div class="form-group">
<label for="item">Sale Tax</label>
<input type="text" id="f77" name=f77 class="form-control" placeholder="Sale Tax">
</div>
<div class="form-group">
<label for="item">Extra Tax</label>
<input type="text" id="f88" name=f88 class="form-control" placeholder="Extra">
</div>

<div class="form-group">
<label for="item">Sub Amount</label>
<input type="text" id="f16" name=f16 class="form-control">
</div>

<div class="form-group">
<label for="item">Total Amount</label>
<input type="text" id="f17" name=f17 class="form-control">
</div>






</div></div>

      </div>
      
    </div>
    <button type=submit class="btn btn-primary " style="width:100%">Add Item</button>
      </div>
      <div class="col-md-8">
        <div class="card">
          <div class="card-statistic-4">
<div id="output"></div>
        </div>
       
         
       </div>
      </div>
    </div>
    
    
  </div>
</div>

<div class="card">
  <div class="card-statistic-4">
    <div class="row">
      <div class="col-md-4"><div class="form-group">
<label for="item">Total</label>
<input type="text" id="f23" name="f23" class="form-control">
</div></div>
      <div class="col-md-4"><div class="form-group">
<label for="item">Tax</label>
<input type="text" id="f24" name="f24" class="form-control">
</div></div>
      <div class="col-md-4"><div class="form-group">
<label for="item">Grand Total</label>
<input type="text" id="f25" name="f25" class="form-control">
</div></div>
    </div>
  </div>
</div>




                 
            </div>
              </div>
            </div>
            <form>
            <div class="d-flex justify-content-end">
             
              <button id="sdata"  class="btn btn-dark" >Save Data</button>
         
            </div>
          </div>
          
        </section>
        
     <?php include "include/footer.php";?>
	 

<script type="text/javascript" language="javascript" >
 
 $(document).ready(function(){


$("#f12").change(function(e) {
  e.preventDefault();
  var pid=$("#f10").val();
  var btno=$("#f12").val();
$.ajax({
    url: "ajaxcall/getexpdate.php",
   method: "post",
   data:  {pid:pid,btno:btno},
   cache: false,
   dataType: "json",
   
     success: function(data)
      {
        $("#f13").empty().append(data.a);
        $("#f18").empty().append(data.c);
       $("#f14").val(data.b);
       $("#f19").val(data.d);
       $("#f15").val(data.e);
       calculate();
        
       
            
      
      },          
    });
});


$("#f13").change(function(e) {
  e.preventDefault();
  
       calculate();
        
         });

  function calculate()
  {

  var pid=$("#f10").val();
  var batch=$("#f12").val();
  var mrp=$("#f18").val();
  var expdate=$("#f13").val();
  var pqty=$("#f14").val();
 

  $.ajax({
    url: "ajaxcall/calculatereturn.php",
   method: "post",
   data:  {pid:pid,batch:batch,mrp:mrp,expdate:expdate,pqty:pqty,table:'stockdetail'},
   cache: false,
   dataType: "json",

   
     success: function(data)
      {
         $("#f19").val(data.a);
       $("#f20").val(data.b);
       $("#f21").val(data.c);
       $("#f14").val(data.d);
       $("#f15").val(data.e);
       $("#f77").val(data.f);
       $("#f88").val(data.g);
       $("#f16").val(data.h);
       $("#f17").val(data.i);
      
           
      }
    });
  }

   $("#f14,#f18").change(function(e) {
    e.preventDefault();
    calculate();


});



  $("#f3").change(function(e) {
  e.preventDefault();
  var cid=$("#f3").val();
  $.post("ajaxcall/getcompnayproduct.php",{cid:cid},function(result){
  $("#f10").empty().append(result);
  });
  });



 
  $("#sdata").click(function(e) {
  e.preventDefault();
  if( $('#output').is(':empty') ) {
     iziToast.success({
    title: 'warning!',
    message: 'Record is empty can not add ',
    position: 'topCenter'
  });
     return;

  }

  $.post("ajaxcall/addpurchasereturn.php",{tax:$("#f24").val()},function(result){

    iziToast.success({
    title: 'success!',
    message: 'Record is Added in database',
    position: 'bottomRight'
  });

  window.location.href = "print-purchasereturn.php?code="+result;
  });
  });




  
  $("#f10").change(function(){

    var pid=$("#f10").val();



  $.ajax({
    url: "ajaxcall/getretunproduct.php",
   method: "post",
   data:  {pid:pid},
   cache: false,
   dataType: "json",

   
     success: function(data)
      {
      
       $("#f18").empty().append(data.a);
       $("#f12").empty().append(data.b);
       $("#f13").empty().append(data.c);
       $("#f14").val(data.d);
       calculate();
       
       
       
      
      },          
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
         url: "ajaxcall/add-purchasereturn.php",
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
       $("#f10").val("");
       $("#f12").val("");
       $("#f13").val("");
       $("#f14").val("");
       $("#f15").val("");
       $("#f16").val("");
       $("#f17").val("");
       $("#f18").val("");
       $("#f19").val("");
       $("#f20").val("");
       $("#f21").val("");
       $("#f22").val("");
       $("#f23").val(data.b);
       $("#f24").val(data.c);
       $("#f25").val(data.d);
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
data: {code: id,opt: "del-stockreturn"},
success:function(data) {
    
       $("#output").html(data.a);
    

}
});
  });



  



 


 </script>

	 