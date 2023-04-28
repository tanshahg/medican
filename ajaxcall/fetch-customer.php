<?php
session_start();
include "../db.php";
$db=$dbpdo->query('select database()')->fetchColumn();
$q="SELECT `COLUMN_NAME` 
FROM `INFORMATION_SCHEMA`.`COLUMNS` 
WHERE `TABLE_SCHEMA`='$db'
    AND `TABLE_NAME`='supplier'";
   $f=$dbpdo->query($q)->fetchAll();
   $i=0;
   foreach($f  as $rows)
   {
	$row[]=$rows[0];
	$i++;
      }
    $columns = array($row[0],$row[1],$row[2],$row[3],$row[4],$row[5]);
	$q2="select ";
  foreach($columns as $c)
  $q2.=$c.",";
  $q2=rtrim($q2,',');
  $q2.=" from supplier where scode<1000 and scode<>1";
  
  $stmt = $dbpdo->prepare($q2);
$stmt->execute();
$n = $stmt->rowCount();

    
 
  $query= $q2;
	$count=count($columns);
	
	if(!empty($_POST["search"]["value"]))
{
	$query.=' and  '.$columns[0].' LIKE  "%'.$_POST["search"]["value"].'%"';
	for($i=1;$i<$count;$i++)
	$query .= ' OR '.$columns[$i].' LIKE  "%'.$_POST["search"]["value"].'%"';
}

if(!empty($_POST["order"]))
{
 $query .= ' ORDER BY '.$columns[$_POST['order']['0']['column']].' '.$_POST['order']['0']['dir'].' 
 ';
}
else
{
 $query .= ' ORDER BY scode DESC  ';
}

$query1 = '';

if($_POST["length"] != -1)
{
 $query1 = 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
}



$stmt = $dbpdo->prepare($query.$query1);
$stmt->execute();
$number_filter_row = $stmt->rowCount();
$fetch=$dbpdo->query($query.$query1)->fetchAll();
$data = array();
foreach($fetch as $row) 
{
	
 $sub_array = array();
 for($i=0;$i<$count;$i++)
	 
	 if($i==0)
		  $sub_array[] = '<div  data-id="'.$row[0].'" data-column="'.$columns[$i].'">' . $row[$i] . '</div>';
	  else
		  
 if($_SESSION['edit']==1)
$sub_array[] = '<div contenteditable class="update" data-id="'.$row[0].'" data-column="'.$columns[$i].'">' . $row[$i] . '</div>';
else
$sub_array[] = '<div  data-id="'.$row[0].'" data-column="'.$columns[$i].'">' . $row[$i] . '</div>';	
if($_SESSION['edit']==1)
$sub_array[] = "<button id=$row[0]  class='btn btn-primary delete' title='Remove' ><i class='far fa-trash-alt'></i></button>";
else
$sub_array[] = "";

  $data[] = $sub_array;
}
$output = array(
 "draw"    => intval($_POST["draw"]),
 "recordsTotal"  =>  $n,
 "recordsFiltered" => $n,
 "data"    => $data
);

echo json_encode($output);

?>



