<?php 
include "secure.php";
if($currentuser!="admin") header("location: home.php");
include "include/header.php";

?>

  <style>
  

/* Important part */
.modal-dialog{
    overflow-y: initial !important
}
.modal-body{
    height: 400px;
    overflow-y: auto;
}

  </style>
  
</head>

<body >
  <div class="loader"></div>
  <?php include "include/menu.php"; ?>
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-body">
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h3>User Management</h3>
					
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
<table id="user_data" class="table table-bordered table-striped" style="width:100%">
                   <thead>
                    <tr>
             <th>User Name</th>
			<th>Password</th>
			<td>Cader</th>
			<td>Status</th>
			<th>Action</th>
			

                    </tr>
                </thead>
                
 </table> 	



                      
                   
                 
               </div>
            </div></div>
            </div>
              </div>
            </div>
          </div>
        </section>
        
     <?php include "include/footer.php";?>
	 
	 <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
          aria-hidden="true" id="role-modal">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="myLargeModalLabel">User Role Management</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
			  
			  
              <div class="modal-body">
			  <form method=post id="role-form">
			  <?php 
			   echo "<input type=hidden id=\"nameaa[0]\" name=\"nameaa[0]\" value='tanvir'>";
			    echo "<input type=hidden id=\"nameaa[1]\" name=\"nameaa[1]\" value='tanvir'>";
				 echo "<input type=hidden id=\"nameaa[2]\" name=\"nameaa[2]\" value='tanvir'>";
			 
			  ?>
			  <div id="data">
			  
			  
			  </div>
			  </form>
			  
			  
            </div>
          </div>
        </div>

	 
	 
		
	 


<script src="ajaxcall/js/user.js"></script>