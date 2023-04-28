<?php 
include "secure.php";
include "include/header.php";
date_default_timezone_set("Asia/Karachi");
$date=date("Y-m-d");
$id=$_GET['id'];
$fq="SELECT *  FROM `customers` WHERE `id` = '$id'";
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
                    <h3>Edit Customer</h3>
					
                  </div>
                  <div class="card-body">
                    <form class="forms-sample" id="item-entry" method=post action="ajaxcall/update-customer.php">

  <form class="forms-sample" id="item-entry">
<input type=hidden name=id value="<?php echo $frow[0]?>">
  <div class="row">
    <div class="col-md-6">

      <div class="form-group">

<label for="item">Customer ID</label>
<input type="text" id="f1" name=f1 class="form-control"  placeholder="Customer ID" autocomplete="off" value="<?php echo $frow[1]?>" readonly>
</div>

       <div class="form-group">

<label for="item">Customer Company Code</label>
<input type="text" id="f2" name=f2 class="form-control"  placeholder="Customer Company ID" autocomplete="off" value="<?php echo $frow[1]?>">
</div>

  <div class="form-group">

<label for="item">Customer Name</label>
<input type="text" id="f3" name=f3 class="form-control"  placeholder="Customer Name" autocomplete="off" value="<?php echo $frow[2]?>">
</div>


<div class="form-group ">
<label for="item">Area</label>
<select name="f4" id="f4" class="form-control">
  <?php
$s=$dbpdo->prepare("select * from ariainfo");
$s->execute();
while($row = $s->fetch(PDO::FETCH_BOTH)){
  if($frow[3]==$row[0])
echo "<option selected value='$row[0]'>$row[2]</option>";
else
echo "<option  value='$row[0]'>$row[2]</option>";
}
?>
</select>

                    </div>

 <div class="form-group">

<label for="item">Address</label>
<input type="text" id="f5" name=f5 class="form-control"  placeholder="Address" autocomplete="off" value="<?php echo $frow[4]?>">
</div>

<div class="form-group">
<label for="item">Contact Persoan</label>
<input type="text" id="f6" name=f6 class="form-control"  placeholder="Contact Person" autocomplete="off" value="<?php echo $frow[5]?>">
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
  if($frow[6]==$row[0])
echo "<option selected value='$row[0]'>$row[1]</option>";
else
echo "<option  value='$row[0]'>$row[1]</option>";
}
?>
</select>

                    </div>

    <div class="form-group">

<label for="item">Customer Licence</label>
<input type="text" id="f8" name=f8 class="form-control"  placeholder="Customer Licence" autocomplete="off" value="<?php echo $frow[7]?>">
</div>

    
      <div class="form-group">
    <label for="field-3" >Licence Validity Date<span class="required">*</span></label>
  
   <div class="input-group">
     <input type="text" class="form-control datepicker"  name=f9 id="f9" autocomplete="off" value=<?php echo $frow[8] ?> >
   </div>
   </div>

 <div class="form-group">
<label for="item">Phono #</label>
<input type="text" id="f10" name="f10" class="form-control"  placeholder="Phone #" autocomplete="off" value="<?php echo $frow[9]?>">
</div>


 <div class="form-group">
<label for="item">Mobile #</label>
<input type="text" id="f11" name="f11" class="form-control"  placeholder="Mobile #" autocomplete="off" value="<?php echo $frow[10]?>">
</div>
    

<div class="form-group">
<label for="item">Tax</label>
<input type="text" id="f12" name=f12 class="form-control"  placeholder="Tax" autocomplete="off" value="<?php echo $frow[11]?>">
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



	 