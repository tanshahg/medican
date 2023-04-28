<!DOCTYPE html>
<head>
<meta charset="utf-8"> 
<meta http-equiv="X-UA-Compatible" content="IE=edge"> 
<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no"> 
<link href="css/bootstrap.min.css" rel="stylesheet">
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<style>

.navbar-inverse {
    background-color: #4b6312;
    color: #fff;
    margin-bottom: 20px;
}
.box {
	margin-top:30px;
}

.panel-default>.panel-heading {
    color: #fff;
    background-color: #4b6312;
    border-color: #4b6312;
}	

.panel {
    margin-bottom: 20px;
    background-color: #fff;
    border: 1px solid transparent;
    border-radius:4px;
	box-shadow: 0px 10px 28px rgba(0,0,0,0.36);
	
  
}
.panel-body {padding:20px;}
</style>
<title>BackUP</title>
</head>
<body >
<nav class="navbar navbar-inverse">
<div class="navbar-header">
<a class="navbar-brand" href="index.html"><img src="../assets/images/logo_light.png" width=100 alt=""></a>
</div>
<ul class="nav navbar-nav">
<li><a href="../index.php">Home</a></li>
<li><a href="restore.php">Restore</a></li>
</ul>
</div>
</div>
</form>
</nav>
<div class="container">
<div id="row">
<div class="col-sm-8 col-sm-offset-2 box">
<div class="panel panel-default">
<div class="panel-heading">Backup</div>
<div class="panel-body">
           
<?php
include "../db.php";
$tables = array();
backup_tables($dbpdo, $tables);


function backup_tables($dbpdo, $tables) {
$compression = false;
$BACKUP_PATH = "backup";
date_default_timezone_set("Asia/Karachi");
$fname="data/backup-".date("Y-m-d-h-s-i");
$fname.=".sql";
$nowtimename = time();
if ($compression) {
$zp = gzopen($BACKUP_PATH.$nowtimename.'.sql.gz', "a9");
} else {
$handle = fopen($fname,"w");
}
$numtypes=array('tinyint','smallint','mediumint','int','bigint','float','double','decimal','real');

if(empty($tables)) {
$pstm1 = $dbpdo->query('SHOW TABLES');
while ($row = $pstm1->fetch(PDO::FETCH_NUM)) {
$tables[] = $row[0];
}
} else {
$tables = is_array($tables) ? $tables : explode(',',$tables);
}

//cycle through the table(s)

foreach($tables as $table) {
$result = $dbpdo->query("SELECT * FROM $table");
$num_fields = $result->columnCount();
$num_rows = $result->rowCount();
$return="";
//uncomment below if you want 'DROP TABLE IF EXISTS' displayed
//$return.= 'DROP TABLE IF EXISTS `'.$table.'`;'; 


//table structure
$pstm2 = $dbpdo->query("SHOW CREATE TABLE $table");
$row2 = $pstm2->fetch(PDO::FETCH_NUM);
$ifnotexists = str_replace('CREATE TABLE', 'CREATE TABLE IF NOT EXISTS', $row2[1]);
$return.= "\n\n".$ifnotexists.";\n\n";


if ($compression) {
gzwrite($zp, $return);
} else {
fwrite($handle,$return);
}
$return = "";

//insert values
if ($num_rows){
$return= 'INSERT INTO `'."$table"."` (";
$pstm3 = $dbpdo->query("SHOW COLUMNS FROM $table");
$count = 0;
$type = array();

while ($rows = $pstm3->fetch(PDO::FETCH_NUM)) {

if (stripos($rows[1], '(')) {$type[$table][] = stristr($rows[1], '(', true);
} else $type[$table][] = $rows[1];

$return.= "`".$rows[0]."`";
$count++;
if ($count < ($pstm3->rowCount())) {
$return.= ", ";
}
}

$return.= ")".' VALUES';

if ($compression) {
gzwrite($zp, $return);
} else {
fwrite($handle,$return);
}
$return = "";
}
$count =0;
while($row = $result->fetch(PDO::FETCH_NUM)) {
$return= "\n\t(";

for($j=0; $j<$num_fields; $j++) {

//$row[$j] = preg_replace("\n","\\n",$row[$j]);


if (isset($row[$j])) {

//if number, take away "". else leave as string
if ((in_array($type[$table][$j], $numtypes)) && (!empty($row[$j]))) $return.= $row[$j] ; else $return.= $dbpdo->quote($row[$j]); 

} else {
$return.= 'NULL';
}
if ($j<($num_fields-1)) {
$return.= ',';
}
}
$count++;
if ($count < ($result->rowCount())) {
$return.= "),";
} else {
$return.= ");";

}
if ($compression) {
gzwrite($zp, $return);
} else {
fwrite($handle,$return);
}
$return = "";
}
$return="\n\n-- ------------------------------------------------ \n\n";
if ($compression) {
gzwrite($zp, $return);
} else {
fwrite($handle,$return);
}
$return = "";
}



$error1= $pstm2->errorInfo();
$error2= $pstm3->errorInfo();
$error3= $result->errorInfo();
echo $error1[2];
echo $error2[2];
echo $error3[2];

if ($compression) {
gzclose($zp);
} else {
fclose($handle);
}
$f=$fname;
print "<p>&nbsp;</p><h1>Your backup is completed</h1>";
print "Right click link button below and select &nbsp; \" save link as ..\" &nbsp;to download the backup<br><br><br>";
print "<p><a href='$f' class='btn btn-lg btn-primary' ><i class='glyphicon glyphicon-download-alt'></i> &nbsp;Download</a>";
print "<p>&nbsp;</p><p>&nbsp;</p>
<a href=\"../home.php\"><button type=\"button\" id=\"sbtn\" class=\"btn btn-success\">Go Back</button></a>";
}

exit;
?>
				
				

</div>
		</div></div>					



						
							
							
						
              
            
	
</body>
</html>
