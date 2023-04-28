<?php include "secure.php";
include "include/header.php";
date_default_timezone_set("Asia/Karachi");
$date=date("Y-m-d");
$title="Area Wise Business";
if(isset($_POST['sdate']))
        {
        $sdate=$_POST['sdate'];
        
        

        $sdate=date("d M Y",strtotime($_POST['sdate']));
       
        $title="Area Wise Business $sdate";
    }
    ?>

<script>
 document.title = "<?php echo $title ?>";
 </script>

 



  
</head>

<body>

  <!-- <div class="loader"></div> -->
  <?php include "include/menu.php"; ?>
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-body">
      <div class="row">
      
      <div class="col-md-8 mx-auto">
            <div class="card card-primary">
                        <div class="card-body ">
      <form class="forms-sample" method=post id="search-form">  
              
      
      <div class="row">
      <div class="col-md-4">
        <div class="form-group">
            <label for="field-3" >Select Product<span class="required">*</span></label>
   <select name="f1[]"  class="selectpicker" multiple size="3">
     
 <option value="0" selected>Select all</option>
 
 <?php
 

$s=$dbpdo->prepare("SELECT DISTINCT a.productcode,b.name FROM `stockdetail` as a , products as b where a.productcode=b.id and a.inhand>'0' order by b.name");
$s->execute();
while($row = $s->fetch(PDO::FETCH_BOTH)){
echo "<option value='$row[0]'>$row[1]</option>";
}
?>
</select>
     
   </div>
   </div>

    <div class="col-md-4">
        <div class="form-group">
            
    <label for="field-3" >Select Start Date<span class="required">*</span></label>
     <input type="text" class="form-control datepicker" placeholder="Start Date" name=sdate id="sdate" autocomplete="off" value=<?php echo $date ?> >
     
   </div>
   </div>

<div class="col-md-4">
    <div class="form-group">
        <label for="field-3" >Select end Date<span class="required">*</span></label>
    <div class="input-group">
            
    
     <input type="text" class="form-control datepicker" placeholder="Start end" name="edate" id="edate" autocomplete="off" value=<?php echo $date ?> >
     <div class="input-group-append">
<button type=submit class="btn btn-danger mx-2"><i class="fa fa-search"></i></button>

</div>
</div>
</div>
   
   </div>
   </div>
    

     </form>

       </div>
     
       
       </div>
       </div>
       </div>
      


            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h3>Area Wise Business</h3>
          
          
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
<table class="table table-striped table-hover" id="user_data" style="width:100%;">
                 
  <?php

  if(isset($_POST['sdate']))
        {
          

        
        
        $sdate=$_POST['sdate'];
        $f1=$_POST['f1'];
        $edate=$_POST['edate'];
        
$products=[];
$areas=[];
$overall=[];



if($f1[0]==0)
{
$q1="SELECT DISTINCT a.productcode  FROM `saledetail` as a, sale as b where a.tableid=b.id and b.date>='$sdate' and b.date<='$edate'";
$s1=$dbpdo->prepare($q1);
$s1->execute();
$pids=[];
while($row1=$s1->fetch(PDO::FETCH_NUM))
{
    $pids[]=$row1[0];
}
$pides=implode(',', array_map('intval', $pids));
}
else 
{
    $f1=$_POST['f1'];
    $pides=implode(',', array_map('intval', $f1));
}



$q1="SELECT DISTINCT a.productcode,b.name FROM `saledetail`as a ,`products` as b where a.productcode=b.id and a.productcode IN($pides) order by a.productcode ";
$s1=$dbpdo->prepare($q1);
$s1->execute();
while($row1=$s1->fetch(PDO::FETCH_NUM))
{
    $products[$row1[0]]=$row1[1];
}


$q1="SELECT DISTINCT areacode  FROM sale  where date>='$sdate' and date<='$edate'";
$s1=$dbpdo->prepare($q1);
$s1->execute();
$tarea=$s1->rowcount();
$aids=[];
while($row1=$s1->fetch(PDO::FETCH_NUM))
{
    $aids[]=$row1[0];
}
$aides=implode(',', array_map('intval', $aids));


$q1="SELECT DISTINCT a.areacode,b.arianame  FROM `sale` as a ,ariainfo as b where a.areacode=b.sno and a.areacode IN($aides) order by a.areacode";
$s1=$dbpdo->prepare($q1);
$s1->execute();
while($row1=$s1->fetch(PDO::FETCH_NUM))
{
    $areas[$row1[0]]=$row1[1];
}
foreach($products as $index=>$product)
{
 $pid=$index;
 $pname=$product;
 foreach($areas as $acode=>$area)
 {
    $row=$dbpdo->query("SELECT sum(b.quantity),sum(b.totalamount) FROM `sale` as a ,saledetail as b where a.id=b.tableid and a.areacode=$acode and b.productcode=$pid and  a.date>='$sdate' and a.date<='$edate' group by a.areacode,b.productcode")->fetch(PDO::FETCH_NUM);
   $qty="";
   $amount="";
    if($row)
    {
        $qty=$row[0];
        $amount=$row[1];
    }
    $overall[$pid][$area]=["quantity"=>$qty,"amount"=>$amount];
 }
}
?>
 
    <thead>
    <th>Product code</th>
    <th>Product Name</th>
    <?php
    foreach($areas as $acode=>$area)
    echo "<th>".$area."</th>";
?>
<th>Total</th>
</thead>
<tbody>
    
        <?php 
       
        foreach($products as $index=>$product)
        {
            $rsum=0;
            $cpcode=$index;
            $cpname=$product;
            echo "<tr>
            <td>$cpcode</td>
            <td>$cpname</td>";
        foreach($areas as $acode=>$area)   
        {
            $item=$overall[$index][$area]['quantity'];
            $amount=$overall[$index][$area]['amount'];
            $rsum+=intval($item);
            echo "<td>$item</td>";
            
        }
        echo "<td>$rsum</td></tr>";
}

echo "</tbody>

 
</table>";

}
?>
     
        
        





                      
                   
                 
               </div>
            </div></div>
            </div>
              </div>
            </div>
          </div>
        </section>
        
     <?php include "include/footer.php";?>
   <script>
$(document).ready(function(){

fetch_data();
  
  

function commaSeparateNumber(val) {
    while (/(\d+)(\d{3})/.test(val.toString())) {
        val = val.toString().replace(/(\d+)(\d{3})/, '$1' + ',' + '$2');
    }
    return val;
}



  function fetch_data()
  {
    
   var dataTable = $('#user_data').DataTable({
     
        "scrollY": 300,
        "scrollX": true,
        
     "pageLength": -1,
    
     
         
        
               "dom": "<'row '<'col-md-12'B>><'row'<'col-md-12'>><'row'<'col-md-12'rt>>",
      buttons: [

            { extend: 'print', footer: true },
            { extend: 'excel', footer: true },
            { extend: 'pdf', footer: true,  orientation: 'landscape', 
                     customize: function (doc) {
        
        
        
        doc.pageMargins = [20, 60, 20, 30];
        // Set the font size fot the entire document
        doc.defaultStyle.fontSize = 7;
        // Set the fontsize for the table header
        doc.styles.tableHeader.fontSize = 7;
        
       
       
        // Change dataTable layout (Table styling)
        // To use predefined layouts uncomment the line below and comment the custom lines below
        // doc.content[0].layout = 'lightHorizontalLines'; // noBorders , headerLineOnly
        var objLayout = {};
        objLayout['hLineWidth'] = function (i) {return .5;};
        objLayout['vLineWidth'] = function (i) {return .5;};
        objLayout['hLineColor'] = function (i) {return '#aaa';};
        objLayout['vLineColor'] = function (i) {return '#aaa';};
        objLayout['paddingLeft'] = function (i) {return 4;};
        objLayout['paddingRight'] = function (i) {return 4;};
        doc.content[0].layout = objLayout;
      }    

},
            
        
        ],



    


    "processing" : true,
    "serverSide" : false,
   "bDestroy":true,

  language: {
          processing: "<img src='assets/img/typing.svg'>"
      },
    "order" : [],

    

   

   
  
  
  
  
  
  
   });
   
  }
});
    </script>
   
   
