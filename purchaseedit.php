<?php 
include "secure.php";
include "include/header.php";
date_default_timezone_set("Asia/Karachi");
$date=date("Y-m-d");
unset($_SESSION["shopping_cart"]);
unset($_SESSION["shopping_heads"]);
$purchaseid=$_GET['code'];
$srow=$dbpdo->query("SELECT * from stock where id='$purchaseid'")->fetch(PDO::FETCH_NUM);

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
    
    height: 40px !important;
    font-size: 14px !important;
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
                    <h3>Stock Purchase</h3>
					
                  </div>
                  <div class="card-body">
                 <div class="row">
                   <div class="col-md-4">
<div class="form-group">
<label for="item">Vocher #</label>
<input type="text" id="f1" name=f1 class="form-control" value="<?php echo $srow[0] ?>">
</div>
</div>

<div class="col-md-4">
<div class="form-group">
<label for="item">Date</label>
<input type="text" id="f2" name=f2 class="form-control datepicker" autocomplete="off" value="<?php echo $srow[1] ?>">
</div>
</div>


<div class="col-md-4">
<div class="form-group">
<label for="item">Supplier</label>
<select name="f3" id="f3" class="form-control" required>
  
  <?php
$s=$dbpdo->prepare("select * from customers where customertype=2");
$s->execute();
while($row = $s->fetch(PDO::FETCH_BOTH)){
  if($srow[2]==$row[0])
echo "<option selected value='$row[0]'>$row[2]</option>";
else
echo "<option  value='$row[0]'>$row[2]</option>";
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
<input type="text" id="f4" name=f4 class="form-control" value="<?php echo $srow[3] ?>">
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
  if($srow[4]==$row[0])
echo "<option selected value='$row[1]'>$row[1]</option>";
else
echo "<option  value='$row[1]'>$row[1]</option>";
}
?>
</select>
</div>
</div>

<div class="col-md-2">
<div class="form-group">
<label for="item">Courier #</label>
<input type="text" id="f6" name=f6 class="form-control" value="<?php echo $srow[5] ?>">
</div>
</div>

<div class="col-md-2">
<div class="form-group">
<label for="item">Invoice #</label>
<input type="text" id="f7" name=f7 class="form-control" required value="<?php echo $srow[6] ?>">
</div>
</div>

<div class="col-md-2">
<div class="form-group">
<label for="item">Ref Date</label>
<input type="text" id="f8" name=f8 class="form-control datepicker" autocomplete="off" value="<?php echo $srow[7] ?>">
</div>
</div>

<div class="col-md-2">
<div class="form-group">
<label for="item">Page #</label>
<input type="text" id="f9" name=f9 class="form-control" value="<?php echo $srow[8] ?>">
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
$s=$dbpdo->prepare("select * from products");
$s->execute();
while($row = $s->fetch(PDO::FETCH_BOTH)){
echo "<option value='$row[0]'>$row[2]</option>";
}
?>
</select>
</div>
        <div class="row">
      <div class="col-md-4">

        




<div class="form-group">
<label for="item">Batch #</label>
<input type="text" id="f12" name=f12 class="form-control" required>
</div>

<div class="form-group">
<label for="item">Expiry Date</label>
<input type="text" id="f13" name=f13 class="form-control datepicker" autocomplete="off" required>
</div>

<div class="form-group">
<label for="item">Quantity</label>
<input type="text" id="f14" name=f14 class="form-control" required>
</div>

<div class="form-group">
<label for="item">Bonus Quantity</label>
<input type="text" id="f15" name=f15 class="form-control">
</div>

</div>

      
      <div class="col-md-5">
       
<div class="form-group">
<label for="item">M.R.P</label>
<input type="text" id="f18" name=f18 class="form-control" required>
</div>

<div class="form-group">
<label for="item">T.P Rate</label>
<div class="input-group">
<input type="text" id="f19" name=f19 class="form-control" required>
<input type="text" id="f119" name=f119 class="form-control" required>
</div>
</div>

 

<div class="form-group">
<label for="item">Discount</label>
<input type="text" id="f20" name=f20 class="form-control" placeholder="dis 1">
</div>

<div class="form-group">
<label for="item">Net Rate</label>
<input type="text" id="f21" name=f21 class="form-control">
</div>

      </div>
      <div class="col-md-3">
<div class="form-group">
<label for="item">Sale Tax</label>
<input type="text" id="f22" name=f22 class="form-control" placeholder="Sale Tax">
</div>
<div class="form-group">
<label for="item">Extra Tax</label>
<input type="text" id="f221" name=f221 class="form-control" placeholder="Extra">
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

  oldpurchase();

function oldpurchase()
{
 var code=<?php echo $srow[0]?>;
 $.ajax({
         url: "ajaxcall/getoldpurchase.php",
   method: "post",
   data:  {code:code},
   cache: false,
   dataType: "json",
   success: function(data)
      {
   
      $("#output").html(data.a);
      $("#f23").val(data.b);
      $("#f24").val(data.c);
      $("#f25").val(data.d);
   
      },          
    });

}


  $("#f24").change(function(e) {
  e.preventDefault();
  var a=Number($("#f23").val());
  var b=Number($("#f24").val());

  $.post("ajaxcall/changetax.php",{tax:$("#f24").val(),a:a,b:b},function(result){
  $("#f25").val(result);
  });
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


  $.post("ajaxcall/addpurchase.php",{tax:$("#f24").val()},function(result){

    iziToast.success({
    title: 'success!',
    message: 'Record is Added in database',
    position: 'bottomRight'
  });

  window.location.href = "print-purchase.php?code="+result;
  });
  });


$("#f119").blur(function(e) {
var mrp=Number($("#f18").val());
var t=mrp-Number($("#f119").val());
var tp=t*100/mrp;
$("#f19").val(tp);
});

$("#f18,#f19,#f20,#f21,#f22,#f221,#f14,#f15").change(function(){

    var pid=Number($("#f10").val());
    var mrp=Number($("#f18").val());
    var tp=Number($("#f19").val());
    var dis=Number($("#f20").val());
    var nrate=Number($("#f21").val());
    var qty=Number($("#f14").val());
    var bonus=Number($("#f15").val());
    var gst=Number($("#f22").val());
    var extra=Number($("#f221").val());
    var tpamount=Number($("#f119").val());
    
    var x=(mrp-mrp*tp/100);
   


 $.ajax({
         url: "ajaxcall/getcalculation.php",
   method: "post",
   data:  {pid:pid,mrp:mrp,tp:tp,dis:dis,nrate:nrate,qty:qty,gst:gst,extra:extra,bonus:bonus,tpamount:tpamount},
   cache: false,
   dataType: "json",
   
     success: function(data)
      {
       $("#f16").val(data.a);
       $("#f17").val(data.b);
       $("#f119").val(x);
      {
   
  
  }
      },          
    });

  });

  
  $("#f10").change(function(){

    var pid=$("#f10").val();


 $.ajax({
         url: "ajaxcall/getproductinfo.php",
   method: "post",
   data:  {pid:pid},
   cache: false,
   dataType: "json",
   
     success: function(data)
      {
        $("#f14").val("");
        $("#f15").val("");
        $("#f18").val("");
       $("#f19").val("");
       $("#f20").val("");
       $("#f21").val("");
       $("#f22").val("");
       $("#f119").val("");
       $("#f221").val("");

       $("#f18").val(data.a);
       $("#f19").val(data.b);
       $("#f20").val(data.c);
       $("#f21").val(data.e);
       $("#f22").val(data.d);
       $("#f119").val(data.f);
       $("#f221").val(data.g);
      {
   
  
  }
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
         url: "ajaxcall/add-stock.php",
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
data: {code: id,opt: "del-order"},
success:function(data) {
    
       $("#output").html(data.a);
      $("#f23").val(data.b);
      $("#f24").val(data.c);
      $("#f25").val(data.d);
    

}
});
  });



  



 


 </script>

	 