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
		 "pageLength": 50,
		  "processing": true,
        "serverSide": true,
		 
         "lengthMenu": [[50, 100, 500,1000, -1], [50, 100, 500,1000, "All"]],
        
               "dom": "<'row '<'col-md-12'B>><'row'<'col-md-12'>><'row'<'col-md-12'flrt>>ip",
			buttons: [

            { extend: 'print', footer: true },
            { extend: 'excel', footer: true },
            { extend: 'pdf', footer: true,   
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



    


    "processing" : true,
    "serverSide" : false,
	 "bDestroy":true,

	language: {
          processing: "<img src='assets/img/typing.svg'>"
      },
    "order" : [],

    "ajax" : {
     url:"ajaxcall/fetch-purchasesummary.php",
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
			
			
            var total = api
                .column(9, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                        }, 0);

                var total1 = api
                .column(11, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                        }, 0);
					
		$( api.column(9).footer() ).html(numberWithCommas(Math.round(total)));
        $( api.column(11).footer() ).html(numberWithCommas(Math.round(total1)));
		
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
