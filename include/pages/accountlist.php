		
	 

<script type="text/javascript" language="javascript" >
 
 $(document).ready(function(){
 
	
  fetch_data();

  function fetch_data()
  {
	  
   var dataTable = $('#user_data').DataTable({
	   
        
    	  "scrollY": 300,
        "scrollX": true,
		 
		 "scrollX": true,
		 "pageLength": 50,
     "deferLoading": 50,
     
		 
         "lengthMenu": [[10, 25, 50,100, -1], [10, 25, 50,100, "All"]],
        
               "dom": "<'row '<'col-md-12'B>><'row'<'col-md-12'>><'row'<'col-md-12'flrt>>ip",
		buttons: [
            {
                extend: 'print',
                exportOptions: {
                columns: ':visible'
                }},
				
      

			

             

            'colvis',
            'excel',
             'pdf',
			 
			 
           
        ],
 
   });
  }
  
  

 });
 </script>

