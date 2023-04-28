<?php 
include "../db.php";
$output='
		
                <div class="card mycard">
                  <div class="card-header">
                    <h4>Update User Setting for cader '.$_REQUEST['code'].'</h4>
					<div class="card-header-action">
                      <a href="#" class="btn btn-primary" id="call">
                        Check All
                      </a>
                    </div>
                  </div>
                  <div class="card-body ">
                    <div class="table-responsive ">
                      <table class="table table-bordered table-md">
                        <tbody><tr>
                          <th>#</th>
                          <th>Page</th>
                          <th>Read</th>
                          <th>Entry</th>
						  <th>Edit</th>
						
                          </tr>';
						  $ccader=$_REQUEST['code'];
						  $output.="<input type=hidden name='ccader' value='$ccader'>";						  $q="SELECT * FROM `pages` order by pageid ";
$s=$dbpdo->prepare($q);
$s->execute();
$id=0;
while($row = $s->fetch(PDO::FETCH_BOTH)){
	$pageid=$row[0];
	$id++;
$qq="SELECT * FROM `role` where cader='$ccader' and pageid='$pageid'";
$qs=$dbpdo->prepare($qq);
$qs->execute();
$n=$qs->rowcount();
$output.= "<input type=hidden name='pageid[]' value='$pageid'>";
if($n==1) {
$qrow = $qs->fetch(PDO::FETCH_BOTH);
$oop1=$qrow[2];
$oop2=$qrow[3];
$oop3=$qrow[4];

}
else
{
$oop1=0;
$oop2=0;
$oop3=0;

}	
$output.="
	

                        <tr>
                          <td>$id</td>
                          <td>$row[2]</td>
                          <td><div class='form-group'>
                      
                      <label class='custom-switch mt-2'>
                        <input type='checkbox' ";
if($oop1==1) $output.= "checked ";
$output.="						id=checkbox1[] name=checkbox1[]  value='$pageid'  class='custom-switch-input'>
                        <span class='custom-switch-indicator'></span>
                        <span class='custom-switch-description'>Read</span>
                      </label>
                    </div></td>
						  <td>
						  <div class='form-group'>
                      
                      <label class='custom-switch mt-2'>
                        <input type='checkbox' ";
if($oop2==1) $output.= "checked ";
$output.= "
						id=checkbox2[] name=checkbox2[] value='$pageid'  class='custom-switch-input'>
                        <span class='custom-switch-indicator'></span>
                        <span class='custom-switch-description'>Entry</span>
                      </label>
                    </div>
						  
						  </td>
						  <td>
						  <div class='form-group'>
                      
                      <label class='custom-switch mt-2'>
                        <input type='checkbox' ";
if($oop3==1) $output.= "checked ";
$output.="
						id=checkbox3[] name=checkbox3[] value='$pageid' class='custom-switch-input'>
                        <span class='custom-switch-indicator'></span>
                        <span class='custom-switch-description'>Edit</span>
                      </label>
                    </div>
						  
						  </td>
						  
						  
						  
                          
                        </tr>";
}

$output.='
                        </tbody>
						</table>
                  </div>
				  <div class="card-footer">
                    <button type="submit" class="btn btn-primary btn-block mr-2">Add Permissions</button>
					
                  </div>
                </div>
              </div>';
			  
			  echo $output;
			  ?>
			  
			  
          
          
		  
  
  


  