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
$q="SELECT a.productcode,b.name,a.batchno,a.inhand FROM `stockdetail` as a ,products as b where b.id=a.productcode and b.ccode='$companycode'  group by a.productcode,a.batchno,a.expdate";
$s=$dbpdo->prepare($q);
$s->execute();
while($row = $s->fetch(PDO::FETCH_BOTH)){
$date11=date("d/m/Y",strtotime($sdate));
$output.=str_replace('~', ' ',str_pad("2003", 7,'~',STR_PAD_RIGHT));
$output.=str_replace('~', ' ',str_pad($date11, 11,'~',STR_PAD_RIGHT));
$output.=str_replace('~', ' ',str_pad($row[0], 10,'~',STR_PAD_RIGHT));
$output.=str_replace('~', ' ',str_pad($row[1], 51,'~',STR_PAD_RIGHT));
$output.=str_replace('~', ' ',str_pad($row[2], 11,'~',STR_PAD_RIGHT));
$output.=str_replace('~', ' ',str_pad($row[3], 15,'~',STR_PAD_RIGHT));
$output.=str_replace('~', ' ',str_pad("0", 15,'~',STR_PAD_RIGHT));
$output.=str_replace('~', ' ',str_pad("0", 15,'~',STR_PAD_RIGHT));
$output.=str_replace('~', ' ',str_pad("0", 15,'~',STR_PAD_RIGHT));
$output.="\n";
}
$myfile = fopen("sas/203STOCK.TXT", "w") or die("Unable to open file!");
fwrite($myfile,$output);
fclose($myfile);
?>
</div>




        