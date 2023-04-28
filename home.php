<?PHP
session_start();
$userl=$_SESSION['cad1'];

if($userl==1)
header("Location:admin.php"); 
else
header("Location:user.php"); 
exit;
?>