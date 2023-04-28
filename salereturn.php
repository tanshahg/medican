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
                    <h3>Sale Return</h3>
          
          
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
<table class="table table-striped table-hover" id="user_data" style="width:100%;">
                        
<thead>
                    <tr>
<th>Voucher #</th>
<th>date</th>
<th>Area</th>
<th>Saleman</th>
<th>Customer Name</th>
<th>Product Id</th>
<th>product Name</th>
<th>T.P</th>
<th>Qty</th>
<th>Bonus</th>
<th>Batch</th>
<th>Exp-Date</th>
<th>Gross</th>
<th>Discount</th>
<th>Taxable Amount</th>
<th>Sale Tax</th>
<th>Futher Tax</th>
<th>Total</th>

</tr>
                </thead>
        
        


         
        
        </tbody>
<tfoot >
    <tr>
    <th></th><th></th><th></th><th></th><th></th><th></th>
    <th></th><th></th><th></th><th></th><th></th><th></th>
    <th></th><th></th><th></th><th></th><th></th><th></th>
   
    
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
      
   <script>
   $(document).ready(function(){

fetch_data();
  
  $('#search-form').submit(function(e) { 
     e.preventDefault();
     
     $('#user_data').DataTable().destroy();
      fetch_data();
              
});

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
     "pageLength": 10,
    
     
         "lengthMenu": [[10, 25, 50,100, -1], [10, 25, 50,100, "All"]],
        
               "dom": "<'row '<'col-md-12'B>><'row'<'col-md-12'>><'row'<'col-md-12'flrt>>ip",
      buttons: [

            { extend: 'print', footer: true },
            { extend: 'excel', footer: true },
            { extend: 'pdf', footer: true },
            { extend: 'colvis', footer: true },

            <?php if($entry==1)
          echo "
       {
       text: 'Add sale return',
      action: function ( e, dt, button, config ) {
      window.location.href = 'salereturnentry.php';
        } 
        
        },  ";
?>        
            
        
        ],



    


    "processing" : true,
    "serverSide" : false,
   "bDestroy":true,

  language: {
          processing: "<img src='assets/img/typing.svg'>"
      },
    "order" : [],

    "ajax" : {
     url:"ajaxcall/fetch-salereturn.php",
     type:"POST",
   data: {sdate: $("#sdate").val(),edate: $("#edate").val()},
   
   
  },

   

   
  
  
  
  
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
            
            var total01 = api
                .column(12, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                        }, 0);

            var total02 = api
                .column(13, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                        }, 0);

            var total = api
                .column(14, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                        }, 0);

                var total1 = api
                .column(15, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                        }, 0);

                var total2 = api
                .column(16, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                        }, 0);

                var total3 = api
                .column(17, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                        }, 0);
                    
        $( api.column(12).footer() ).html(numberWithCommas(total01.toFixed(0)));
        $( api.column(13).footer() ).html(numberWithCommas(total02.toFixed(0)));
        $( api.column(14).footer() ).html(numberWithCommas(total.toFixed(0)));
        $( api.column(15).footer() ).html(numberWithCommas(total1.toFixed(0)));
        $( api.column(16).footer() ).html(numberWithCommas(total2.toFixed(0)));
        $( api.column(17).footer() ).html(numberWithCommas(total3.toFixed(0)));
        
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

     url:"ajaxcall/delete-salereturn.php",
     method:"POST",
     data:{id:id},
     success:function(data){
     $('#user_data').DataTable().destroy();
     fetch_data();
     }
     });
    
  } 
   });
    });

  
   });
 </script>
   
   
