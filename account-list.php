<?php 
include "secure.php";
include "include/header.php";
?>

  
  
</head>

<body >
  
  <?php include "include/menu.php"; ?>
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-body">
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h3>Account List</h3>
					
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
<table class="table table-striped table-hover text-dark mb-2" id="user_data" style="width:100%;">
                        
<thead>
<tr>
<th >Account Id</th>
<th >Account Name</th>

</tr>
</thead>
<tbody>

  
<?php
include "db.php";
$db=$dbpdo->query('select database()')->fetchColumn();
$q="SELECT `COLUMN_NAME` 
FROM `INFORMATION_SCHEMA`.`COLUMNS` 
WHERE `TABLE_SCHEMA`='$db'
    AND `TABLE_NAME`='account'";
   $f=$dbpdo->query($q)->fetchAll();
    $i=0;
   foreach($f  as $rows)
   {
  $row[$i]=$rows[0];
  $i++;
      }


    $columns = array($row[0],$row[1]);
  $q2="select ";
  foreach($columns as $c)
  $q2.=$c.",";
  $q2=rtrim($q2,',');
  $q2.=" from `account` ";
  
  $stmt = $dbpdo->prepare($q2);
$stmt->execute();
$n = $stmt->rowCount();


    
 
  $query= $q2;
  $count=count($columns);
  
 




$fetch=$dbpdo->query($q2)->fetchAll();
$data = array();
echo "<tr>";
foreach($fetch as $row) 
{
 $sub_array = array();
 for($i=0;$i<$count;$i++)
  
 echo  '<td>'.$row[$i].'</td>';



echo "</tr>";





 

}
?>
  </tbody>

 </table> 	



                      
                   
                 
               </div>
            </div></div>
            </div>
              </div>
            </div>
          </div>
        </section>
        
     <?php include "include/footer.php";?>
	 <?php include "include/pages/accountlist.php";?>
	 