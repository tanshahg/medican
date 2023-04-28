<script type="text/javascript" language="javascript" >
 
 $(document).ready(function(){
 
	
  fetch_data();

  function fetch_data()
  {
	  
   var dataTable = $('#user_data').DataTable({
	   
        
    	  "scrollY": 300,
        "scrollX": true,
		 "pageLength": 10,
		 
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
			 <?php if($entry==1)
				 echo "
			 {
			 text: 'Add Customer',
			action: function ( e, dt, button, config ) {
			add();
				}
				},";
?>				
           
        ],
    "processing" : true,
    "serverSide" : true,
	language: {
          processing: "<img src='assets/img/typing.svg'>"
      },
    "order" : [],

    "ajax" : {
    url:"ajaxcall/fetch-customer.php",
     type:"POST",
	 
    }
   });
  }
  
  function update_data(id, column_name, value)
  {
   $.ajax({
    url:"ajaxcall/update-supplier.php",
    method:"POST",
    data:{id:id, column_name:column_name, value:value},
    success:function(data)
    {
		if(data!=1)
		{
     iziToast.success({
    title: 'success!',
    message: 'Record is Updated',
    position: 'bottomRight'
  });
	 
	 $('#user_data').DataTable().ajax.reload(null, false);
		}
     
    }
   });
   
  }

     
  $(document).on('blur', '.update', function(){
   var id = $(this).data("id");
   var column_name = $(this).data("column");
   var value = $(this).text();
   update_data(id, column_name, value);
  });
  
  
  
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
     url:"ajaxcall/delete-supplier.php",
     method:"POST",
     data:{code:id},
     success:function(data){
		 iziToast.success({
    title: 'success!',
    message: 'Record is removed from database',
    position: 'bottomRight'
  });
  
     
      
      $('#user_data').DataTable().destroy();
      fetch_data();

	  
     }
	   });
	  
	} 
	 });
	  });
  
  
  function add()
  {
	  
	  var d = new Date(); 
    var date =  d.getFullYear() + "-" + (d.getMonth()+1) + "-" + d.getDate();
	$.post("ajaxcall/getvendorid1.php", function(data, status){
       var newid=data;
    
             
   var html = '<tr>';
   html += '<td contenteditable id="data1">'+newid+'</td>';
   html += '<td contenteditable id="data2"></td>';
   html += '<td contenteditable id="data3"></td>';
   html += '<td contenteditable id="data4">'+date+'</td>';
   html += '<td contenteditable id="data5"></td>';
   html += '<td contenteditable id="data6"></td>';
   html += '<td><button type="button" name="insert" id="insert" class="btn btn-success btn-xs">+</button>&nbsp;<button type="button" name="cancel" id="cancel" class="btn btn-warning btn-xs">X</button></td>';
   html += '</tr>';
   $('#user_data tbody').prepend(html);
   });
  }
  
  $(document).on('click', '#cancel', function(){
	  $('#user_data').DataTable().destroy();
	fetch_data();
  });    
  
  $(document).on('click', '#insert', function(){
	
   var f1 = $('#data1').text();
   var f2 = $('#data2').text();
   var f3 = $('#data3').text();
   var f4 = $('#data4').text();
   var f5 = $('#data5').text();
   var f6 = $('#data6').text();
       
   if(f1 != '' && f2 != '' && f4 != '')
   {
	  $.ajax({
     url:"ajaxcall/insert-vendor.php",
     method:"POST",
     data:{f1: f1,f2: f2,f3: f3,f4: f4,f5: f5,f6: f6},
     success:function(data)
     {
      iziToast.success({
    title: 'success!',
    message: 'Record is Added in Database',
    position: 'bottomRight'
  });
  
      $('#user_data').DataTable().destroy();
      fetch_data();
     }
    });
    
   }
   else
   {
	   swal('Blank', 'Customer Id ,Name and Opening date required!', 'error');
    
   }
  });


 });
 </script>