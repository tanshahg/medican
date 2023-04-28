<?php 
include "secure.php";
include "include/header.php";
date_default_timezone_set("Asia/Karachi");
$date=date("Y-m-d");
$id=$_GET['id'];
$fq="SELECT *  FROM `products` WHERE `id` = '$id'";
$fs=$dbpdo->prepare($fq);
$fs->execute();
$frow = $fs->fetch(PDO::FETCH_BOTH);
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
                    <h3>Edit Product</h3>
					
                  </div>
                  <div class="card-body">
                    <form class="forms-sample" id="item-entry" method=post action="ajaxcall/updateproducts.php">

  <div class="row">
    <div class="col-md-6">

      <div class="form-group">
<input type=hidden name=id value="<?php echo $frow[0] ?>">
<label for="item">IBL Code</label>
<input type="text" id="f1" name=f1 class="form-control"  placeholder="IBL Code" autocomplete="off" value="<?php echo $frow[1]?>">
</div>

       <div class="form-group">
<label for="item">product Name</label>
<input type="text" id="f2" name=f2 class="form-control"  placeholder="product name" autocomplete="off" value="<?php echo $frow[2]?>">
</div>

<div class="form-group ">
<label for="item">Company</label>
<select name="f3" id="f3" class="form-control">
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
   <?php
$s=$dbpdo->prepare("select id,gname from companygroups ");
$s->execute();
while($row = $s->fetch(PDO::FETCH_BOTH)){
  if($frow[4]==$row[0])
echo "<option selected value='$row[0]'>$row[1]</option>";
else
echo "<option  value='$row[0]'>$row[1]</option>";
}
?>
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
<input type="text" id="f12" name=f12 class="form-control"  placeholder="Sale Tax" autocomplete="off" value="<?php echo $frow[10]?>">
</div>

</div>
  <div class="col-md-6">


  <div class="form-group">

<label for="item">M.R.P</label>
<input type="text" id="f7" name=f7 class="form-control"  placeholder="MRP" autocomplete="off" value="<?php echo $frow[7]?>">
</div>

 <div class="form-group">

<label for="item">TP</label>
<div class="input-group">
<input type="text" id="f8" name=f8 class="form-control"  placeholder="TP" autocomplete="off" value="<?php echo $frow[8]?>">
<input type="text" id="c" name=c class="form-control"   autocomplete="off" value="<?php echo $frow[7]-$frow[7]*$frow[8]/100?>" readonly>
</div>
</div>

<div class="form-group">

<label for="item">Discount 1</label>
<input type="text" id="f9" name=f9 class="form-control"  placeholder="discount 1" autocomplete="off" value="<?php echo $frow[9]?>">
</div>

<div class="form-group">

<label for="item">Discount 2</label>
<input type="text" id="f10" name=f10 class="form-control"  placeholder="discount 2" autocomplete="off">
</div>

<div class="form-group">

<label for="item">Net Price</label>
<input type="text" id="f11" name=f11 class="form-control"  placeholder="Net price" autocomplete="off" value="<?php echo $frow[11]?>">
</div>


<div class="form-group">

<label for="item">Further Tax</label>
<input type="text" id="f13" name=f13 class="form-control"  placeholder="Further Tax" autocomplete="off" value="<?php echo $frow[12]?>">
</div>

 


</div>

  </div>
  <div class="d-flex justify-content-end">
    <button class="btn btn-primary" type=sbumit>Update Product</button>
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
$("#f7").keyup(function(){
var n=Number($("#f7").val());
var p=n-n*15/100;
$("#c").val(p);


});

 });
</script>



	 