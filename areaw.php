<?php include "secure.php";
include "include/header.php";
date_default_timezone_set("Asia/Karachi");
$products=[];
$areas=[];
$overall=[];
$q1="SELECT DISTINCT a.productcode,b.name FROM `saledetail`as a ,`products` as b where a.productcode=b.id order by a.productcode ";
$s1=$dbpdo->prepare($q1);
$s1->execute();
while($row1=$s1->fetch(PDO::FETCH_NUM))
{
    $products[$row1[0]]=$row1[1];
}
$q1="SELECT DISTINCT a.areacode,b.arianame  FROM `sale` as a ,ariainfo as b where a.areacode=b.sno order by a.areacode";
$s1=$dbpdo->prepare($q1);
$s1->execute();
while($row1=$s1->fetch(PDO::FETCH_NUM))
{
    $areas[$row1[0]]=$row1[1];
}
foreach($products as $index=>$product)
{
 $pid=$index;
 $pname=$product;
 foreach($areas as $acode=>$area)
 {
    $row=$dbpdo->query("SELECT sum(b.quantity),sum(b.totalamount) FROM `sale` as a ,saledetail as b where a.id=b.tableid and a.areacode=$acode and b.productcode=$pid group by a.areacode,b.productcode")->fetch(PDO::FETCH_NUM);
   $qty="";
   $amount="";
    if($row)
    {
        $qty=$row[0];
        $amount=$row[1];
    }
    $overall[$pid][$area]=["quantity"=>$qty,"amount"=>$amount];
 }
}
?>
<table class="table">
    <thead>
    <th>Product code</th>
    <th>Product Name</th>
    <?php
    foreach($areas as $acode=>$area)
    echo "<th>$area</th>";
?>
</thead>
<tbody>
    
        <?php 
        foreach($products as $index=>$product)
        {
            $cpcode=$index;
            $cpname=$product;
            echo "<tr>
            <td>$cpcode</td>
            <td>$cpname</td>";
        foreach($areas as $acode=>$area)   
        {
            $item=$overall[$index][$area]['quantity'];
            $amount=$overall[$index][$area]['amount'];
            echo "<td>$item<br>$amount</td>";
            
        }
        echo "<tr>";
}
?>
    
    </tbody>
</table>