<?php
require_once("common/config.php");
require_once("common/DB_Connection.php");
require_once("common/functions.php");
global $db;

$dir = "json/";

$sql    = "SELECT * FROM vehicles ORDER BY adid";
$result = $db->queryArray( $sql );

$filename = "vehicles".date('YmdHis').".json";

file_put_contents($dir.$filename, json_encode($result));

header( 'Content-Type: text/json' );
header( 'Content-Disposition: attachment;filename='.$filename);

echo json_encode($result);
?>