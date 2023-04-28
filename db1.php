<?php
try {
$dbpdo = new PDO('mysql:host=localhost;dbname=itbaba_urdu','itbaba_ajax','Alpha786110$');
$dbpdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// always disable emulated prepared statement when using the MySQL driver
$dbpdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
}
 catch(PDOException $e) {
    echo "$e";
exit;
}
?>