<?php 
include "secure.php";
include "include/header.php";
date_default_timezone_set("Asia/Karachi");
$date=date("Y-m-d");
?>
<link rel="stylesheet" href="assets/css/compact.css">

  
  
</head>

<body >
  <!-- <div class="loader"></div> -->
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
    <label for="field-3" >Select Compnay<span class="required">*</span></label>

  <select name="companycode" id="companycode" class="form-control" required>
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
  
   <div class="col-sm-6">
<div class="form-group">
<label for="field-3" >Select Product<span class="required">*</span></label>
<div class="input-group">
<select name="productcode" id="productcode" class="form-control" required>
 
</select>
<div class="input-group-append">
<button type=submit class="btn btn-danger"><i class="fa fa-search"></i></button>

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
                    <h3>Stock Detail</h3>
					
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
<table class="table table-striped table-hover text-dark mb-2" id="user_data" style="width:100%;">
                        
<thead>
<tr>
<th >Proudct Id</th>
<th >Company</th>
<th >Product Name</th>
<th >Batch #</th>
<th >Exp-Date</th>
<th >TP</th>
<th >MRP</th>
<th >Unit Price</th>
<th >Qunantity</th>
<th >Bonus</th>
<th >Net Quantity</th>
<th >Net Vale</th>

</tr>
</thead>
<tbody>
<?php 
if(isset($_POST['productcode']))
        {
       
        $productcode=$_POST['productcode'];
        $companycode=$_POST['companycode']; 
      
if($productcode==0)
$q="SELECT a.productcode,a.batchno,a.expdate,a.mrp,a.tp,a.dis1,sum(a.quantity) as q1,sum(a.bonus) as q2 FROM `stockdetail` as a ,products as b where b.id=a.productcode and b.ccode='$companycode' group by a.productcode,a.batchno,a.expdate";
else
    $q="SELECT a.productcode,a.batchno,a.expdate,a.mrp,a.tp,a.dis1,sum(a.quantity) as q1,sum(a.bonus) as q2 FROM `stockdetail` as a ,products as b where b.id=a.productcode and b.ccode='$companycode' and a.productcode='$productcode' group by a.productcode,a.batchno,a.expdate";


$s=$dbpdo->prepare($q);
$s->execute();
while($row = $s->fetch(PDO::FETCH_BOTH)){
    $pid=$row[0];

  $trow=$dbpdo->query("SELECT name from customers where id='$companycode'")->fetch(PDO::FETCH_NUM); 
$company=$trow[0];
$trow=$dbpdo->query("SELECT name from products where id='$pid'")->fetch(PDO::FETCH_NUM); 
$productname=$trow[0];

$trow=$dbpdo->query("SELECT sum(quantity)+sum(bonus) as total from stockdetail where productcode='$pid'")->fetch(PDO::FETCH_NUM); 
$totalin=$trow[0];
$trow=$dbpdo->query("SELECT sum(quantity)+sum(bonus) as total from saledetail where productcode='$pid'")->fetch(PDO::FETCH_NUM); 
$totalout=$trow[0];

$trow=$dbpdo->query("SELECT sum(quantity)+sum(bonus) as total from stockreturndetail where productcode='$pid'")->fetch(PDO::FETCH_NUM); 
$preturn=$trow[0];

$trow=$dbpdo->query("SELECT sum(quantity)+sum(bonus) as total from salereturndetail where productcode='$pid'")->fetch(PDO::FETCH_NUM); 
$sreturn=$trow[0];

$inhand=abs($totalin-$totalout-$preturn+$sreturn);
$date1 = date("Ymd", strtotime($row[2]));
$date2 = date("d-m-Y", strtotime($row[2]));
$mrp=$row[3];
$tp=$row[4];
$dis=$row[5];
$tprate=$row[4];
$pqty=$row[6];
$unitprice=$tprate;
if($dis>0)
    {
        if(strlen($dis)==1) {  $dis=$tprate*$dis/100; }
        else
        {
            
            $dis=$dis/$pqty;
            

        }
        $unitprice=$tprate-$dis;
        
    }
$net=round($inhand*$unitprice);
$unitprice=round($unitprice,2);
if($inhand>0)
{

echo "
<tr>
<td>$pid</td>
<td>$company</td>
<td>$productname</td>
<td>$row[1]</td>
<td data-sort='$date1'>$date2</td>
<td>$tprate</td>
<td>$mrp</td>
<td>$unitprice</td>
<td>$row[6]</td>
<td>$row[7]</td>
<td>$inhand</td>
<td>$net</td>
</tr>
";
}
}
}
?>
  

 
        
        


         
        
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
	 
    
   

<script type="text/javascript" language="javascript" >
 
 $(document).ready(function(){

     $("#companycode").change(function(e) {
  e.preventDefault();
  var cid=$("#companycode").val();
  $.post("ajaxcall/getcompnayproduct1.php",{cid:cid},function(result){
  $("#productcode").empty().append(result);
  
  });
  });


$("#f3").change(function(){

var cid=$("#f3").val();
  $.post("ajaxcall/getbalance.php",{cid:cid},function(result){
    $("#ff3").val(result);

  })

});



  
  fetch_data();


   function fetch_data()
  {
    
   var dataTable = $('#user_data').DataTable({
     
        
        "scrollY": 300,
        "scrollX": true,
     "pageLength": 100,
    
     
         "lengthMenu": [[100, 250, 500,1000, -1], [100, 250, 500,1000, "All"]],
        
               "dom": "<'row '<'col-md-12'B>><'row'<'col-md-12'>><'row'<'col-md-12'flrt>>ip",
      buttons: [

            { extend: 'print', footer: true,

customize: function ( win ) {
                    
 
                    $(win.document.body).find( 'th' )
                        .addClass( 'trow' )
                        .css( 'font-size', 'inherit' );
                },
                
             },
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
            { extend: 'colvis', footer: true },
            
            
        
        ],



    


  
    "order" : [],

 

   

   
  
  
  
  
  
  footerCallback: function ( row, data, start, end, display ) {
     
    
            var api = this.api(),data;
      
            // Remove the formatting to get integer data for summation
            var intVal = function ( i ) {
                return typeof i === 'string' ?
                    i.replace(/[\$,]/g, '')*1 :
                    typeof i === 'number' ?
                        i : 0;
            };
      
      function numberWithCommas(x) {
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}
      
      
            var total = api
                .column(11, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                        }, 0);

              
          
    $( api.column(11).footer() ).html(numberWithCommas(total));
        
    
},
  
  
  
  
   });
   
  }
  
  $(document).on('click', '.delete', function(){
   var id = $(this).attr("id");
   swal({
    title: 'Are you sure?',
    text: 'Once deleted, you will not be able to recover this!',
    icon: 'warning',
    buttons: true,
    dangerMode: true,
  })
    .then((willDelete) => {
      if (willDelete) {
    $.ajax({

     url:"ajaxcall/delete-voucher.php",
     method:"POST",
     data:{id:id},
     success:function(data){
     location.reload();
     }
     });
    
  } 
   });
    });


  
  
  $("#itemlist-entry-modal").on("show.bs.modal",function(event) {
  $('#item-entry').trigger("reset");
});



$("#item-entry").on('submit',(function(e) {
  e.preventDefault();
var formData = new FormData();
var others=$("#item-entry").serializeArray();
$.each(others,function(key,input) {
  formData.append(input.name,input.value)
});



  $.ajax({
         url: "ajaxcall/add-simplervoucher.php",
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
        if(data.a>0)
      {
   
  iziToast.success({
    title: 'success!',
    message: 'Record is Added in database',
    position: 'bottomRight'
  });

    $("#item-entry").trigger("reset");
    window.location.href = "print-simplervoucher.php?code="+data.a;
  }
      },          
    });
 }));

  
  

 });
 </script>

	 