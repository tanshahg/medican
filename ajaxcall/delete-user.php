<?php
include "../db.php";
if(isset($_POST["code"]))
{
$u=$_POST['code'];
$q="delete from  users where username='$u'";
$s=$dbpdo->prepare($q);
$s->execute();
echo $msg;
}
?>