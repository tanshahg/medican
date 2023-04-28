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
		
		 
         "lengthMenu": [[100,500,1000, -1], [100,500,1000, "All"]],
        
               "dom": "<'row '<'col-md-12'B>><'row'<'col-md-12'>><'row'<'col-md-12'flrt>>ip",
			buttons: [

            { extend: 'print', footer: true },
            { extend: 'excel', footer: true },
            { extend: 'pdf', footer: true },
            { extend: 'colvis', footer: true },
            
        
        ],



    


    "processing" : true,
    "serverSide" : false,
	 "bDestroy":true,

	language: {
          processing: "<img src='assets/img/typing.svg'>"
      },
    "order" : [],

    "ajax" : {
     url:"ajaxcall/fetch-salesummary.php",
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
			
			
            var total1 = api
                .column(5, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                        }, 0);

                 var total2 = api
                .column(6, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                        }, 0);
                 var total3 = api
                .column(7, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                        }, 0);

                
					
		$( api.column(5).footer() ).html(numberWithCommas(Math.round(total1)));
		$( api.column(6).footer() ).html(numberWithCommas(Math.round(total2)));
		$( api.column(7).footer() ).html(numberWithCommas(Math.round(total3)));
        
		
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

     url:"ajaxcall/delete-sale.php",
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
