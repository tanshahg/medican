$(function() {
	
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
		 "pageLength": 100,
		 "length":100,
		 
		
		 
         "lengthMenu": [[100,500,1000, -1], [100, 500,1000, "All"]],
        
               "dom": "<'row '<'col-md-12'B>><'row'<'col-md-12'>><'row'<'col-md-12'flrt>>ip",
			buttons: [

            { extend: 'print', footer: true },
            { extend: 'excel', footer: true },
            { extend: 'pdf', footer: true },
            { extend: 'colvis', footer: true },
            
        
        ],



    


    "processing" : true,
    "bDestroy":true,

	language: {
          processing: "<img src='assets/img/typing.svg'>"
      },
    "order" : [],

    "ajax" : {
     url:"ajaxcall/fetch-sale.php",
     type:"POST",
     "dataType": "json",
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

     url:"ajaxcall/delete-purchase.php",
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
