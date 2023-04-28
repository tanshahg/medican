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

$q="SELECT a.id,a.tableid,b.date,b.id,f.mode,g.sno,d.id,d.name,a.batchno,a.tp,a.quantity,a.bonus,a.dis1,a.totalamount
FROM `saledetail` as a, sale as b ,customers as c ,products as d, customers as e,cus_mode as f,ariainfo as g
where  d.ccode=$companycode and b.date>='$sdate' and b.date<='$edate' and  a.tableid=b.id and b.customercode=c.id and a.productcode=d.id and b.customercode=e.id and c.mode=f.id and c.area=g.sno";
$s=$dbpdo->prepare($q);
$s->execute();
while($row = $s->fetch(PDO::FETCH_BOTH)){
$date11=date("d/m/Y",strtotime($row[2]));
$output.=str_replace('~', ' ',str_pad("2003", 7,'~',STR_PAD_RIGHT));
$output.=str_replace('~', ' ',str_pad($row[1], 13,'~',STR_PAD_RIGHT));
$output.=str_replace('~', ' ',str_pad($date11, 11,'~',STR_PAD_RIGHT));
$output.=str_replace('~', ' ',str_pad($row[3], 11,'~',STR_PAD_RIGHT));
$output.=str_replace('~', ' ',str_pad("02", 3,'~',STR_PAD_RIGHT));
$output.=str_replace('~', ' ',str_pad($row[5], 17,'~',STR_PAD_RIGHT));
$output.=str_replace('~', ' ',str_pad($row[6], 10,'~',STR_PAD_RIGHT));
$output.=str_replace('~', ' ',str_pad($row[7], 51,'~',STR_PAD_RIGHT));
$output.=str_replace('~', ' ',str_pad($row[8], 11,'~',STR_PAD_RIGHT));
$output.=str_replace('~', ' ',str_pad($row[9], 13,'~',STR_PAD_RIGHT));
$output.=str_replace('~', ' ',str_pad($row[10], 13,'~',STR_PAD_RIGHT));
$output.=str_replace('~', ' ',str_pad($row[11], 13,'~',STR_PAD_RIGHT));
$output.=str_replace('~', ' ',str_pad($row[12], 13,'~',STR_PAD_RIGHT));
$output.=str_replace('~', ' ',str_pad($row[13], 13,'~',STR_PAD_RIGHT));
$output.=str_replace('~', ' ',str_pad('S', 1,'~',STR_PAD_RIGHT));
$output.="\n";
}
$myfile = fopen("sas/203INV.TXT", "w") or die("Unable to open file!");
fwrite($myfile,$output);
fclose($myfile);
?>
</div>




        