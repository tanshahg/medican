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
      
      <div class="col-12 col-md-12 col-lg-12">
            <div class="card card-primary">
                        <div class="card-body ">
      <form class="forms-sample" method=post id="search-form">  
              
      <div class="row">
      
      <div class="col-sm-3">
      <div class="form-group">
    <label for="field-3" >Select Start Date<span class="required">*</span></label>
  
   <div class="input-group">
     <input type="text" class="form-control datepicker" place="Start Date" name=sdate id="sdate" autocomplete="off" value=<?php echo $date ?> >
   </div>
   </div>
   </div>
   
<div class="col-sm-3">
<div class="form-group">
<label for="field-3" >Select End Date<span class="required">*</span></label>

<input type="text" class="form-control datepicker" place="Start Date" name=edate id="edate" autocomplete="off" value=<?php echo $date ?> >
</div>
</div>


<div class="col-sm-3">
<div class="form-group">
<label for="item">Select Client Category</label>
<select name="f6" id="f6" class="form-control">
  <option value="">Select Client Type</option>
  <?php
$s=$dbpdo->prepare("select * from customertypes");
$s->execute();
while($row = $s->fetch(PDO::FETCH_BOTH)){
echo "<option value='$row[0]'>$row[1]</option>";
}
?>
</select>
</div>
</div>

     

   
<div class="col-sm-3">
<div class="form-group">
<label for="field-3" >Select Client<span class="required">*</span></label>
<div class="input-group">
<select name="cid" id="cid" class="form-control">
  
  
</select>
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
       </div></div>
      

            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h3>Account ledger</h3>
					
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
<table class="table table-striped table-hover text-dark mb-2" id="user_data" style="width:100%;">
                        
<thead>
<tr>
<th >Sno</th>
<th >date</th>
<th >Customer Id</th>
<th >Customer Name</th>
<th >Debit</th>
<th >Credit</th>
<th >Balance</th>

</tr>
</thead>
<tbody>
<?php 
if(!empty($_POST['cid']))
        {
       
        $cid=$_POST['cid'];
        $sdate=$_POST['sdate'];
        $edate=$_POST['edate'];
        $sno=1;
        $odebit=0;
        $ocredit=0;
        $ob=0;
$q="SELECT sum(b.debit),sum(b.credit)  FROM `customers` as a, payments as b  where a.id='$cid'  and a.id=b.cid and b.date<'$sdate' ";
$s=$dbpdo->prepare($q);
$s->execute();
$row = $s->fetch(PDO::FETCH_BOTH);
if($row[0]) $odebit=$row[0];
if($row[1]) $ocredit=$row[1];
$ob=$odebit-$ocredit;
if($ob!=0)
{
  echo "
<tr>
<td>$sno</td>
<td></td>
<td></td>
<td></td>
<td>$odebit</td>
<td>$ocredit</td>
<td>$ob</td>
</tr>
    ";
    $sno++;
}


$q="SELECT a.id,a.name,b.date,b.debit,b.credit  FROM `customers` as a, payments as b  where a.id='$cid'  and a.id=b.cid and b.date>='$sdate' and b.date<='$edate' order by b.date";
$s=$dbpdo->prepare($q);
$s->execute();
while($row = $s->fetch(PDO::FETCH_BOTH)){
    

    $date1=date("d-m-Y",strtotime($row[2]));
    $debit=abs($row[3]);
    $credit=abs($row[4]);
    $b=$debit-$credit;
    $ob=$ob+$b;
    
      
echo "
<tr>
<td>$sno</td>
<td>$date1</td>
<td>$row[0]</td>
<td>$row[1]</td>
<td>$debit</td>
<td>$credit</td>
<td>$ob</td>
</tr>


    ";
    $sno++;
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
    <th ><?php echo $ob ?></th>
   
    
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



$("#f6").change(function(){

var id=$("#f6").val();
  $.post("ajaxcall/getcustomerlist.php",{id:id},function(result){
    $("#cid").empty().append(result);

  })

});



  
  fetch_data();


   function fetch_data()
  {
    
   var dataTable = $('#user_data').DataTable({
     
        
        "scrollY": 300,
        "scrollX": true,
     "pageLength": 100,
    
     
         "lengthMenu": [[100,500,1000, -1], [100,500,1000, "All"]],
        
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
            { extend: 'pdf', footer: true },
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
                .column(4, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                        }, 0);
                var total1 = api
                .column(5, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                        }, 0);

              
          
    $( api.column(4).footer() ).html(numberWithCommas(total));
    $( api.column(5).footer() ).html(numberWithCommas(total1));
        
    
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

	 