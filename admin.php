<?php 
include "secure.php";
include "include/header.php";
date_default_timezone_set('Asia/Karachi');
?>
<style>
.ss {
	overflow-y: auto;
	max-height:320px;
}
.opo {
  font-size: 1rem;
}
</style>
</head>

<body >

  <div class="loader"></div>
 <?php include "include/menu.php"; ?>
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="row ">
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
              <div class="card">
                <div class="card-statistic-4">
                  <div class="align-items-center justify-content-between">
                    <div class="row ">
                      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                        <div class="card-content">
                          <h5 class="font-15">Products IN Stock</h5>
                          <?php                         
                           $row=$dbpdo->query("SELECT count(*) from products where id In (select productcode from stockdetail where inhand>0)")->fetch(PDO::FETCH_NUM);
                          echo "<div class='opo'>$row[0]</div>";
                          ?>
              
                        </div>
                      </div>
                      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                        <div class="banner-img">
                          <img src="assets/img/banner/1.png" alt="">
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
              <div class="card">
                <div class="card-statistic-4">
                  <div class="align-items-center justify-content-between">
                    <div class="row ">
                      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                        <div class="card-content">
                          <h5 class="font-15">Last week Sale</h5>
                          <?php                         
                           $row=$dbpdo->query("SELECT sum(gamount) from sale where date between date_sub(now(),INTERVAL 1 WEEK) and now()")->fetch(PDO::FETCH_NUM);
                           $sale=$row[0];
                          $row=$dbpdo->query("SELECT sum(gamount) from salereturn where date between date_sub(now(),INTERVAL 1 WEEK) and now()")->fetch(PDO::FETCH_NUM);
                           $sale=$sale-$row[0];
                           $sale=round($sale);
                           $sale=number_format($sale);
                          echo "<div class='opo'>".$sale."</div>";
                          ?>
                        </div>
                      </div>
                      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                        <div class="banner-img">
                          <img src="assets/img/banner/2.png" alt="">
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
              <div class="card">
                <div class="card-statistic-4">
                  <div class="align-items-center justify-content-between">
                    <div class="row ">
                      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                        <div class="card-content">
                          <h5 class="font-15">last Week Expense</h5>
                          <?php                         
                           $row=$dbpdo->query("SELECT sum(credit) from payments where cid=1 and date between date_sub(now(),INTERVAL 1 WEEK) and now()")->fetch(PDO::FETCH_NUM);
                          echo "<div class='opo'>$row[0]</div>";
                          ?>
                      
                        </div>
                      </div>
                      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                        <div class="banner-img">
                          <img src="assets/img/banner/3.png" alt="">
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
              <div class="card">
                <div class="card-statistic-4">
                  <div class="align-items-center justify-content-between">
                    <div class="row ">
                      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                        <div class="card-content">
                          <h5 class="font-15">Last Week Profit</h5>
                         <?php  
                         include "profit.php";
                         $profit=round($profit);
                           $profit=number_format($profit);
                         echo "<div class='opo'>".$profit."</div>";
                         ?>
                        </div>
                      </div>
                      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                        <div class="banner-img">
                          <img src="assets/img/banner/4.png" alt="">
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

             <div class="row">
            <div class="col-md-8">
              <div class="card ">
                <div class="card-header">
                  <h4>Revenue chart</h4>
                  
                </div>
                <div class="card-body">
                  
                  
                      <div id="chart1" class="text-center"></div>
                      </div>
                    </div>
                  </div>
                        
                        
                        
                    <div class="col-md-4">

                       <div class="card ">
                <div class="card-header">
                  <h4>TOP Five Best Sell Products</h4>
                  
                </div>
                <div class="card-body text-center">
                  
                  <div class="d-flex justify-content-center">
                      <div id="chart2" class="text-center"></div>
                      </div>
                      </div>
                    </div>


                    
                    </div>
                  </div>



                  <div class="row">
            <div class="col-md-12">
              <div class="card ">
  <div class="card-header"><h4>Expiry Alert</h4></div>
  <div class="card-body ">
<table class="table table-striped table-hover text-dark mb-2" style="width:100%;">
 <thead>
<tr>
<th >SNo</th>
<th >Proudct Id</th>
<th >Product Name</th>
<th >Batch #</th>
<th >Exp-Date</th>
<th >Inhand Qty</th>

</tr>
</thead>
<tbody>
<?php 
$q="SELECT a.*,b.name FROM `stockdetail` as a,`products` as b where a.inhand>0 and a.expdate< NOW() + INTERVAL 30 DAY and a.productcode=b.id";

$s=$dbpdo->prepare($q);
$s->execute();
$cnt=0;
while($row = $s->fetch(PDO::FETCH_BOTH)){
    $cnt++;
    $date=date("d-m-Y",strtotime($row[5]));
echo "
<tr>
<td>$cnt</td>
<td>$row[2]</td>
<td>$row[18]</td>
<td>$row[4]</td>
<td>$date</td>
<td>$row[16]</td>
</tr>
";
}
?>

</tbody>
</table>
            

              </div>
              </div>
            </div>
          </div>






                </div>
              </div>
            </div>
         
		  
		  </div>
          </div></div>
          
		  
  <?php include "include/footer.php";?>


  <script src="assets/bundles/apexcharts/apexcharts.min.js"></script>
  <?php include "include/pages/admin.php";?>
  
  