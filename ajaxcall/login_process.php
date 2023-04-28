<?php
session_start();
//  session_set_cookie_params(86400);
//  ini_set('session.gc_maxlifetime', 86400);

$ok=0;
$cc=gethostname(); 
if(isset($_POST['username']))
{
include "../db.php";
$membername2 = strtolower($_POST['username']);
$passw = $_POST['password'];
$passw=md5($passw);
date_default_timezone_set('Asia/Karachi');
$datetime = date( "Y-m-d H:i:s");
$stmt = $dbpdo->prepare('SELECT * FROM users where username=? and  password=?');
$stmt ->execute(array($membername2, $passw));
if ($stmt->rowCount() > 0) {
$row = $stmt->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_NEXT);
$cad1=$row[2];
$status=$row[5];
if($status==0)
{
$_SESSION['karlu-user'] = $membername2;
$_SESSION['cad1'] = $cad1;

$tip=get_ip();
$datetime1 = date( "Y-m-d G:i:s");  
$sql = "update `users` set ip='$tip',lastlogindate='$datetime1' where username='$membername2'"; 
$s=$dbpdo->prepare($sql);
$s->execute();
$ok=1;
}
}
else
{
$error="login is incorrect ";
}
}
if($ok==1)
echo 1;
else 
echo "invalid Login";
exit;
?>

<?php
function get_ip() { if (isSet($_SERVER)) { if (isSet($_SERVER["HTTP_X_FORWARDED_FOR"])) { $realip = $_SERVER["HTTP_X_FORWARDED_FOR"]; } elseif (isSet($_SERVER["HTTP_CLIENT_IP"])) { $realip = $_SERVER["HTTP_CLIENT_IP"]; } else { $realip = $_SERVER["REMOTE_ADDR"]; } } else { if ( getenv( 'HTTP_X_FORWARDED_FOR' ) ) { $realip = getenv( 'HTTP_X_FORWARDED_FOR' ); } elseif ( getenv( 'HTTP_CLIENT_IP' ) ) { $realip = getenv( 'HTTP_CLIENT_IP' ); } else { $realip = getenv( 'REMOTE_ADDR' ); } } return $realip; }

?>

