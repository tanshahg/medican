<?php 
include "../db.php";
// $sdate=date('Y-m-01');
// $edate=date('Y-m-d');

$sdate=date('2023-01-01');
$edate=date('2023-01-31');

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
$myfile = fopen("203SAS/203CUST.TXT", "w") or die("Unable to open file!");
fwrite($myfile,$output);
fclose($myfile);

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
$myfile = fopen("203SAS/203INV.TXT", "w") or die("Unable to open file!");
fwrite($myfile,$output);
fclose($myfile);


$companycode="2010103";
$output="";
$q="SELECT a.productcode,b.name,a.batchno,a.inhand FROM `stockdetail` as a ,products as b,stock as c where b.id=a.productcode and b.ccode='$companycode' and a.tableid=c.id and c.date>='$sdate' and c.date<='$edate'  group by a.productcode,a.batchno,a.expdate";
$s=$dbpdo->prepare($q);
$s->execute();
while($row = $s->fetch(PDO::FETCH_BOTH)){
    $pid=$row[0];
    $btno=$row[2];
  
$hrow=$dbpdo->query("SELECT sum(a.quantity) from stockdetail as a,stock as b where a.productcode='$pid'  and a.batchno='$btno'  and  b.date<='$edate'  and a.tableid=b.id group by productcode,batchno")->fetch(PDO::FETCH_NUM);  
  if($hrow)
  $purchase=$hrow[0]; else $purchase=0;



$hrow=$dbpdo->query("SELECT sum(a.bonus) from stockdetail as a ,stock as b where a.productcode='$pid'  and a.batchno='$btno' and  b.date<='$edate' and a.tableid=b.id  group by productcode,batchno")->fetch(PDO::FETCH_NUM);  
  
  if($hrow)
  $bonus=$hrow[0]; else $bonus=0;
$totalpurchase=$purchase+$bonus;

$hrow=$dbpdo->query("SELECT sum(a.quantity) from stockreturndetail as a,stockreturn as b where a.productcode='$pid'  and a.batchno='$btno'  and  b.date<='$edate' and a.tableid=b.id  group by productcode,batchno")->fetch(PDO::FETCH_NUM);  

  
  if($hrow)
  $purchaser=$hrow[0]; else $purchaser=0;



$hrow=$dbpdo->query("SELECT sum(a.bonus) from stockreturndetail as a,stockreturn as b where a.productcode='$pid'  and a.batchno='$btno'  and  b.date<='$edate' and a.tableid=b.id  group by productcode,batchno")->fetch(PDO::FETCH_NUM);  

  
  if($hrow)
  $bonusr=$hrow[0]; else $bonusr=0;
$totalpurchaser=$purchaser+$bonusr;


$hrow=$dbpdo->query("SELECT sum(a.quantity) from saledetail as a ,sale as b where a.productcode='$pid'  and a.batchno='$btno' and   b.date<='$edate' and a.tableid=b.id group by productcode,batchno")->fetch(PDO::FETCH_NUM);  

 
  if($hrow)
  $sale=$hrow[0]; else $sale=0;

$hrow=$dbpdo->query("SELECT sum(a.bonus) from saledetail as a ,sale as b where a.productcode='$pid'  and a.batchno='$btno' and  b.date<='$edate' and a.tableid=b.id group by productcode,batchno")->fetch(PDO::FETCH_NUM);  

  
  if($hrow)
  $sbonus=$hrow[0]; else $sbonus=0;
  $totalsale=$sale+$sbonus;


  $bonus=$bonus-$sbonus-$bonusr;

  $inhand=$totalpurchase-$totalsale-$totalpurchaser;



$date11=date("d/m/Y",strtotime($sdate));
$output.=str_replace('~', ' ',str_pad("2003", 7,'~',STR_PAD_RIGHT));
$output.=str_replace('~', ' ',str_pad($date11, 11,'~',STR_PAD_RIGHT));
$output.=str_replace('~', ' ',str_pad($row[0], 10,'~',STR_PAD_RIGHT));
$output.=str_replace('~', ' ',str_pad($row[1], 51,'~',STR_PAD_RIGHT));
$output.=str_replace('~', ' ',str_pad($row[2], 11,'~',STR_PAD_RIGHT));
$output.=str_replace('~', ' ',str_pad($inhand, 15,'~',STR_PAD_RIGHT));
$output.=str_replace('~', ' ',str_pad("0", 15,'~',STR_PAD_RIGHT));
$output.=str_replace('~', ' ',str_pad("0", 15,'~',STR_PAD_RIGHT));
$output.=str_replace('~', ' ',str_pad("0", 15,'~',STR_PAD_RIGHT));
$output.="\n";
}
$myfile = fopen("203SAS/203STOCK.TXT", "w") or die("Unable to open file!");
fwrite($myfile,$output);
fclose($myfile);

$rootPath = realpath('203SAS');
$zip = new ZipArchive();
$zip->open('203SAS.zip', ZipArchive::CREATE | ZipArchive::OVERWRITE);

// Create recursive directory iterator
/** @var SplFileInfo[] $files */
$files = new RecursiveIteratorIterator(
    new RecursiveDirectoryIterator($rootPath),
    RecursiveIteratorIterator::LEAVES_ONLY
);

foreach ($files as $name => $file)
{
    // Skip directories (they would be added automatically)
    if (!$file->isDir())
    {
        // Get real and relative path for current file
        $filePath = $file->getRealPath();
        $relativePath = substr($filePath, strlen($rootPath) + 1);

        // Add current file to archive
        $zip->addFile($filePath, $relativePath);
    }
}
$zip->close();
$filename="203SAS.zip";
header('Content-type: application/pdf');
header('Content-Disposition: attachment; filename="' . basename($filename) . '"');
header('Content-Transfer-Encoding: binary');
readfile($filename);
?>





        