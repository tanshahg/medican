<?php include "secure.php";
include "include/header.php";
date_default_timezone_set("Asia/Karachi");
$date=date("Y-m-d");
?>
</head>

<body>

  <div class="loader"></div>
  <?php include "include/menu.php"; ?>
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-body">
      
          <div class="row">
      
      <div class="col-12 col-sm-6 offset-sm-3 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-6 offset-xl-3">
            <div class="card card-primary">
                        <div class="card-body ">
                            <form class="forms-sample" method=post id="search-form">  
              
      <div class="row">
      
      <div class="col-sm-6">
      <div class="form-group">
    <label for="field-3" >Select Start Date<span class="required">*</span></label>
  
   <div class="input-group">
     <input type="text" class="form-control datepicker" place="Start Date" name=sdate id="sdate" autocomplete="off" value=<?php echo $date ?> >
   </div>
   </div>
   </div>
   
<div class="col-sm-6">
<div class="form-group">
<label for="field-3" >Select End Date<span class="required">*</span></label>
<div class="input-group">
<input type="text" class="form-control datepicker" place="Start Date" name=edate id="edate" autocomplete="off" value=<?php echo $date ?> >
<div class="input-group-append">
<button type=submit class="btn btn-danger"><i class="fa fa-search"></i></button>
</div>
   
      
      </div>
      </div>
       </div>
       </div>
       
       </div>
       </div>
       </div></div>
      


            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h3>Purchase Summary</h3>
          
          
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
<table class="table table-striped table-hover" id="user_data" style="width:100%;">
                        
<thead>
                    <tr>
<th>Voucher #</th>
<th>date</th>
<th>Compnay Name</th>
<th>Courier</th>
<th>Courier #</th>
<th>Cotton</th>
<th>Page #</th>
<th>Invoice #</th>
<th>Ref Date</th>
<th>Bill amount </th>
<th>Tax</th>
<th>Net Amount</th>
<th>Reverse Purchase</th>
</tr>
                </thead>
        
        


         
        
        </tbody>
<tfoot >
    <tr>
    <th ></th>
    <th ></th>
    <th ></th>
    <th ></th>
    <th ></th>
    <th ></th>
    <th ></th>
    <th ></th>
    <th ></th>
    <th ></th>
    <th ></th>
    <th ></th>
    <th ></th>
    
</tr></tfoot>

</table>




                      
                   
                 
               </div>
            </div></div>
            </div>
              </div>
            </div>
          </div>
        </section>
        
     <?php include "include/footer.php";?>
   <script src="ajaxcall/js/purchasesummary.js"></script>
   
   
