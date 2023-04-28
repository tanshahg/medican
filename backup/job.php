<?php
if(!empty($_POST['datafile']))
{	
include "../db.php";
$datafile=$_POST['datafile'];
$q="show tables";
$s=$dbpdo->prepare($q);
$s->execute();
while($row=$s->fetch(PDO::FETCH_BOTH))
{
$tablename=$row[0];
$q1="DROP TABLE $tablename";
$s1=$dbpdo->prepare($q1);
$s1->execute();
}
$lines = file("data/$datafile");
$sql='';
foreach ($lines as $line) {	
if (substr($line, 0, 2) == '--' || $line == '' ) {continue;}
if (substr($line, 0, 2) == '/*' || $line == '' ) {continue;}
 $sql.=$line;
            
            if (substr(trim($line), - 1, 1) == ';') {
				$s2=$dbpdo->prepare($sql);
				$s2->execute();
				$sql = '';
                }
                
            }
        echo  "<img src='images/done.jpg' width=100>";
}
?>