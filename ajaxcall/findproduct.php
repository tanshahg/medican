<?php
include "../db.php";
$output="";
$f1=$_POST['product'];
$q="SELECT DISTINCT a.productcode FROM `stockdetail` as a , products as b where b.name like '%$f1%' and a.productcode=b.id and a.inhand>'0' order by b.name";
$s = $dbpdo->prepare($q);
$s->execute();
$row = $s->fetch(PDO::FETCH_BOTH);
echo $row[0],$f1;
						?>