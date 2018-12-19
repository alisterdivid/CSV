<?php
require_once("common/config.php");
require_once("common/DB_Connection.php");
require_once("common/functions.php");
global $db;

function array_to_csv($data, $filename, $attachment = false, $headers = true) {

	if($attachment) {
		// send response headers to the browser
		header( 'Content-Type: text/csv' );
		header( 'Content-Disposition: attachment;filename='.$filename);
		$fp = fopen('php://output', 'w');
	} else {
		$fp = fopen($filename, 'w');
	}

	if($headers) {
		if($data[0]) {
			fputcsv($fp, array_keys($data[0]));
		}
	}

	foreach($data AS $row) {
		fputcsv($fp, $row);
	}

	fclose($fp);
}

$sql    = "SELECT * FROM vehicles";
$result = $db->queryArray( $sql );


// output as an attachment
array_to_csv($result, "test.csv", true);

// output to file system
array_to_csv($result, "test.csv", false);

?>