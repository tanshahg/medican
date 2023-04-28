<?php 
include "secure.php";
include "include/header.php";
date_default_timezone_set("Asia/Karachi");
$date=date("Y-m-d");
unset($_SESSION["shopping_cart"]);
unset($_SESSION["shopping_heads"]);
$saleid=$_GET['code'];
$srow=$dbpdo->query("SELECT * from sale where id='$saleid'")->fetch(PDO::FETCH_NUM);
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
                    <h3>Sale (Vocher id <?php echo $srow[0] ?>)</h3>
					
                  </div>
                  <div class="card-body">
                 <div class="row">
                 
<div class="col-md-3">
<div class="form-group">
<label for="item">Date</label>
<input type="text" id="f2" name=f2 class="form-control datepicker" autocomplete="off" value="<?php echo $srow[1] ?>">
</div>
</div>

<div class="col-md-3">
<div class="form-group">
<label for="item">Area</label>
<select name="f1" id="f1" class="form-control" required>
  
  <?php
$s=$dbpdo->prepare("select * from ariainfo order by arianame");
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

<div class="col-md-3">
<div class="form-group">
<label for="item">Customer</label>
<select name="f3" id="f3" class="form-control" required>
  
  <?php
$s=$dbpdo->prepare("select * from customers where id<>1 and customertype=1");
$s->execute();
while($row = $s->fetch(PDO::FETCH_BOTH)){
  if($srow[3]==$row[0])
echo "<option selected value='$row[0]'>$row[2]</option>";
else 
echo "<option  value='$row[0]'>$row[2]</option>";
}
?>
</select>
</div>
</div>

<div class="col-md-3">
<div class="form-group">
<label for="item">Saleman</label>
<select name="f4" id="f4" class="form-control" required>
  
  <?php
$s=$dbpdo->prepare("select * from customers where customertype='3' order by name");
$s->execute();
while($row = $s->fetch(PDO::FETCH_BOTH)){
  if($srow[4]==$row[0])
echo "<option selected value='$row[0]'>$row[2]</option>";
else
echo "<option  value='$row[0]'>$row[2]</option>";
}
?>
</select>
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
<select name="f5" id="f5" class="form-control" required>
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
<label for="item">Batch</label>
<select name="f7" id="f7" class="form-control fetch_results" required>
  <option value="">Select Batch</option>
 


</select>
</div>

<div class="form-group">
<label for="item">Expiry Date</label>
<select name="f8" id="f8" class="form-control fetch_results" required>
  <option value="">Expiry Date</option>
 


</select>
</div>


 <div class="form-group">
<label for="item">M.R.P</label>
<select name="f9" id="f9" class="form-control fetch_results" required>
  <option value="">MRP</option>
 


</select>
</div>

<div class="form-group">
<label for="item">T.P Rate</label>
<input type="text" id="f12" name=f12 class="form-control fetch_results" required>
</div>


</div>


      
      <div class="col-md-4">

       

        <div class="form-group">
<label for="item">Quantity</label>
<div class="d-flex">
<input type="text" id="f10" name=f10 class="form-control fetch_results" >
<input type="text" id="f110" name=f110 class="form-control fetch_results" readonly tabindex="-1">

</div>
</div>
<div class="form-group">
<label for="item">Bonus Quantity</label>
<div class="d-flex">
<input type="text" id="f11" name=f11 class="form-control fetch_results">
<input type="text" id="f1110" name=f1110 class="form-control fetch_results" readonly tabindex="-1">
</div>
</div>
<div class="form-group">
<label for="item">Bonus-Claim</label>
<input type="text" id="f6" name="f6" class="form-control fetch_results">
</div>


<div class="form-group">
<label for="item">Discount</label>
<div class="d-flex">
<input type="text" id="f130" name=f130 class="form-control fetch_results" placeholder="Discount" >
<input type="text" id="f13" name=f13 class="form-control fetch_results" placeholder="%" style="width:50px !important;">
</div>
</div>

      </div>
      <div class="col-md-4">
        
<div class="form-group">
<label for="item">Net Rate</label>
<input type="text" id="f14" name=f14 class="form-control fetch_results">
</div>

<div class="form-group">
<label for="item">Sale Tax</label>
<div class="d-flex">
<input type="text" id="f220" name=f220 class="form-control fetch_results" placeholder="Sale Tax" readonly>
<input type="text" id="f22" name=f22  class="form-control fetch_results input-sm" placeholder="%" style="width:50px !important">
</div>
</div>
<div class="form-group">
<label for="item">Extra Tax</label>
<div class="d-flex">
<input type="text" id="f2210" name=f2210 class="form-control fetch_results" placeholder="Extra" readonly>
<input type="text" id="f221" name=f221 class="form-control fetch_results" placeholder="%" style="width:50px !important">
</div>

</div>

<div class="form-group">
<label for="item">Discount Claim</label>

<input type="text" id="f100" name=f100 class="form-control fetch_results" placeholder="Dis Claim" >


</div>

</div>
</div>

<div class="d-flex justify-content-between">
  <div class="form-group">
<label for="item">Sub Amount</label>
<input type="text" id="f15" name=f15 class="form-control fetch_results">
</div>

<div class="form-group">
<label for="item">Total Amount</label>
<input type="text" id="f16" name=f16 class="form-control fetch_results">
</div>
</div>

     
      
 
    <button type=submit class="btn btn-primary " style="width:100%">Add Item</button>
      </div>
    </div>
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
<input type="text" id="f17" name="f17" class="form-control">
</div></div>
      <div class="col-md-4"><div class="form-group">
<label for="item">Tax</label>
<input type="text" id="f18" name="f18" class="form-control">
</div></div>
      <div class="col-md-4"><div class="form-group">
<label for="item">Grand Total</label>
<input type="text" id="f19" name="f19" class="form-control">
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

  $('body').addClass("sidebar-mini");
 $("#f5").focus();

oldsale();

function oldsale()
{
 var code=<?php echo $srow[0]?>;
 $.ajax({
         url: "ajaxcall/getoldsale.php",
   method: "post",
   data:  {code:code},
   cache: false,
   dataType: "json",
   success: function(data)
      {
   
      $("#output").html(data.a);
      $("#f5").val("");
      $("#f17").val(data.b);
      $("#f18").val(data.c);
      $("#f19").val(data.d);
   
      },          
    });

}

$("#item-entry input").not("#additem").keydown(function(event) {
    if (event.keyCode == 13) {
      event.preventDefault();
      return false;
    }
});

$("#f130").blur(function(){
var a=Number($("#f15").val());
var d=Number($("#f130").val());
var da=a*d/100;
$("#f16").val(a-da);
$("#f13").val(da);
  });


$("#f1").change(function(){
var aid=$("#f1").val();
  $.post("ajaxcall/getallareacustomers.php",{aid:aid},function(result){
    $("#f3").empty().append(result);
  })

});
  

$("#f3").change(function(e) {
  e.preventDefault();
    var cid=$("#f3").val();
$.post("ajaxcall/gettax.php",{cid:cid},function(result){
  $("#f18").val(result);
  });
});


  $("#f5").change(function(e) {
  e.preventDefault();
  var pid=$("#f5").val();
  $(".fetch_results").each(function() {
    
      this.value = "";
  });

  $.ajax({
    url: "ajaxcall/getallpacking.php",
   method: "post",
   data:  {pid:pid},
   cache: false,
   dataType: "json",
   
     success: function(data)
      {
      
      $("#f7").empty().append(data.a);
       $("#f8").empty().append(data.b);

       $("#f9").empty().append(data.c);
       $("#f12").val(data.d);
       $("#f13").val(data.e);
       $("#f14").val(data.f);
       $("#f22").val(data.g);
       $("#f221").val(data.h);
       $("#f110").val(data.i);
       $("#f1110").val(data.j);
       
       
       
      
      },          
    });


  });


 $("#f130").blur(function(){
var a=Number($("#f15").val());
var d=Number($("#f130").val());
var da=a*d/100;
$("#f16").val(a-da);
$("#f13").val(da);
  });

 $("#item-entry input").not("#additem").keydown(function(event) {
    if (event.keyCode == 13) {
      event.preventDefault();
      return false;
    }
});
  

$("#f7").change(function(e) {
  e.preventDefault();
  var pid=$("#f5").val();
  var btno=$("#f7").val();




$.ajax({
    url: "ajaxcall/getexpdate.php",
   method: "post",
   data:  {pid:pid,btno:btno},
   cache: false,
   dataType: "json",
   
     success: function(data)
      {
        $("#f8").empty().append(data.a);
        $("#f9").empty().append(data.c);
       $("#f12").val(data.d);
        $("#f110").val(data.b);
        $("#f1110").val(data.e);
        $("#f10").val(0);
       
            
      
      },          
    });








  });

$("#f8").change(function(e) {
  e.preventDefault();
  var pid=$("#f5").val();
  var pcode=$("#f6").val();
  var btno=$("#f7").val();
  var expdate=$("#f8").val();

  $.ajax({
    url: "ajaxcall/getsaleinfo.php",
   method: "post",
   data:  {pid:pid,pcode:pcode,btno:btno,expdate:expdate},
   cache: false,
   dataType: "json",
   
     success: function(data)
      {
       $("#f9").empty().append(data.a);
       $("#f12").val(data.b);
       $("#f13").val(data.c);
       $("#f14").val(data.d);
       
            
      
      },          
    });


  });

$("#f9,#f10,#f12,#f13,#f14").change(function(){
  var pid=$("#f5").val();
  var pcode=$("#f6").val();
  var btno=$("#f7").val();
  var expdate=$("#f8").val();
  var qty=$("#f10").val();
  var mrp=$("#f9").val();
  var tp=$("#f12").val();
  var dis=$("#f13").val();
  var nrate=$("#f14").val();
  var gst=$("#f22").val();
  var extra=$("#f221").val();
  var bonus=$("#f11").val();
  $.ajax({
         url: "ajaxcall/calculatesale.php",
   method: "post",
   data:  {pid:pid,pcode:pcode,btno:btno,expdate:expdate,mrp:mrp,tp:tp,dis:dis,nrate:nrate,qty:qty,gst:gst,extra:extra,bonus:bonus,rr:1},
   cache: false,
   dataType: "json",
   
     success: function(data)
      {
        if(data.a==0)
        {
iziToast.error({
    title: 'Error!',
    message: 'out of Stock',
    position: 'topLeft'
  });
        }
        else {
       $("#f15").val(data.a);
       $("#f16").val(data.b);
       $("#f220").val(data.c);
       $("#f2210").val(data.d);
       $("#f130").val(data.e);
      }
      },          
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

  $.post("ajaxcall/addsale.php",{tax:$("#f18").val()},function(result){

    iziToast.success({
    title: 'success!',
    message: 'Record is Added in database',
    position: 'bottomRight'
  });

  window.location.href = "print-sale.php?code="+result;
  });
  });




  
  
 $("#f18").change(function(e) {
  e.preventDefault();
  var a=Number($("#f17").val());
  var b=Number($("#f18").val());

  $.post("ajaxcall/changetax.php",{tax:$("#f18").val(),a:a,b:b},function(result){
    
  $("#f19").val(result);
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
         url: "ajaxcall/add-sale.php",
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
       $(".fetch_results").each(function() {
    
      this.value = "";
  });
       $("#f5").val("");
       $("#f17").val(data.b);
       $("#f18").val(data.c);
       $("#f19").val(data.d);
     
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
data: {code: id,opt: "del-sale"},
success:function(data) {
    
       $("#output").html(data.a);
        $("#f5").val("");
       $("#f17").val(data.b);
       $("#f18").val(data.c);
       $("#f19").val(data.d);
    

}
});
  });



  



 


 </script>

	 