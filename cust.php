<?php include "secure.php";
date_default_timezone_set("Asia/Karachi");
$date=date("Y-m-d");
?>
</head>

<body>
  <div id="box1">

  <?php 
$sdate=date('Y-m-01');;
$edate=date('Y-m-d');;
$companycode="2010103";
$output="";
$q="select a.id,a.name,a.address,b.sno,b.arianame
from customers as a ,ariainfo as b,cus_mode as c
where a.area=b.sno and a.mode=c.id and a.customertype=1 order by a.id DESC;
";
$s=$dbpdo->prepare($q);
$s->execute();
while($row = $s->fetch(PDO::FETCH_BOTH)){
$date11=date("d/m/Y",strtotime($row[2]));
$output.=str_replace('~', ' ',str_pad("2003", 7,'~',STR_PAD_RIGHT));
$output.=str_replace('~', ' ',str_pad($row[0], 11,'~',STR_PAD_RIGHT));
$output.=str_replace('~', ' ',str_pad($row[1], 51,'~',STR_PAD_RIGHT));
$output.=str_replace('~', ' ',str_pad($row[2], 51,'~',STR_PAD_RIGHT));
$output.=str_replace('~', ' ',str_pad("02", 3,'~',STR_PAD_RIGHT));
$output.=str_replace('~', ' ',str_pad($row[3], 17,'~',STR_PAD_RIGHT));
$output.=str_replace('~', ' ',str_pad($row[4], 51,'~',STR_PAD_RIGHT));
$output.="\n";
}
$myfile = fopen("sas/203CUST.TXT", "w") or die("Unable to open file!");
fwrite($myfile,$output);
fclose($myfile);
?>
</div>




        