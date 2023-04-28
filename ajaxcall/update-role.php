<?php 
include "../db.php";
if(!empty($_POST['pageid']))
{
	$pageid=$_POST['pageid'];
	$ccader=$_POST['ccader'];
	
	for($i=0; $i < count($pageid); $i++)
	{
		$page=$pageid[$i];
		
if(!empty($_POST['checkbox1'])) {if(in_array($page,$_POST['checkbox1'])) $op1=1; else $op1=0;} else $op1=0;
if(!empty($_POST['checkbox2'])) {if(in_array($page,$_POST['checkbox2'])) $op2=1; else $op2=0;} else $op2=0;
if(!empty($_POST['checkbox3'])) {if(in_array($page,$_POST['checkbox3'])) $op3=1; else $op3=0;} else $op3=0;
$row=$dbpdo->query("SELECT count(*) FROM `role` where cader='$ccader' and pageid='$page'")->fetch(PDO::FETCH_BOTH);
if($row[0])
{
	
	$q="update `role` set `op1`='$op1', `op2`='$op2', `op3`='$op3' where cader='$ccader' and pageid='$page'";
		$s=$dbpdo->prepare($q);
	$s->execute();
	
}
	else
	{
	$q="INSERT INTO `role` (`cader`, `pageid`, `op1`, `op2`, `op3`) 
	VALUES (\"$ccader\", \"$page\", \"$op1\", \"$op2\", \"$op3\")";
	$s=$dbpdo->prepare($q);
$s->execute();
	}
	}
	echo json_encode(array("aa"=>"done"));
}	

?>
