<?php
try {
$dbpdo = new PDO('mysql:host=localhost;dbname=testmad', 'root', '');
$dbpdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// always disable emulated prepared statement when using the MySQL driver
$dbpdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
}
 catch(PDOException $e) {
    echo "<h1>Sever is to busy keep refreshing the page we are sorry for that</h1>";
exit;
}
?>