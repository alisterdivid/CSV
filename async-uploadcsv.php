<?php
require_once("common/config.php");
require_once("common/DB_Connection.php");
require_once("common/functions.php");
global $db;

$sql = "TRUNCATE TABLE `csvupload`.`vehicles`;";
$db->query($sql);

$valid_formats = array("jpg", "png", "gif", "bmp","jpeg");
if(isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST"){
	$name = $_FILES['imageUpload']['name'];
	$size = $_FILES['imageUpload']['size'];
}
$tmp = $_FILES['imageUpload']['tmp_name'];
$file = $tmp;
//$table = strtok($name,".");
//$table = 'vehicles';
$table = 'oldvehicles';
// get structure from csv and insert db
ini_set('auto_detect_line_endings',TRUE);
$handle = fopen($file,'r');
// first row, structure
if ( ($data = fgetcsv($handle, 0, ',') ) === FALSE ) {
    echo "Cannot read from csv $file";die();
}
$fields = array();
$field_count = 0;

for($i=0;$i<count($data); $i++) {
    $f = strtolower(trim($data[$i]));
    if ($f) {
// normalize the field name, strip to 20 chars if too long
        $f = substr(preg_replace ('/[^0-9a-z]/', '_', $f), 0, 20);
        $field_count++;
        $fields[] = str_replace('___','', trim($f)).' VARCHAR(256)';
    }
}

$sql = "CREATE TABLE $table (" . implode(',', $fields) . ')';
$db->query($sql);
echo $sql;
exit();
//
//echo "success";
//exit();

while ( ($data = fgetcsv($handle, 0, ',') ) !== FALSE ) {
    $fields = array();

//    echo json_encode($data);

    if (is_array($data)){
	    for($i=0;$i<$field_count; $i++) {
		    $data[$i] = isset($data[$i])? $data[$i] : '';
		    $fields[] = '\''.$db->RES(addslashes($data[$i])).'\'';
	    }
	    $sql = "Insert into $table values(" . implode(',', $fields) . ')';
//    echo $sql;
	    $db->query($sql);
    }
}
$sql    = "DELETE FROM `csvupload`.`vehicles` WHERE  TRIM(adid) = '' AND TRIM(companyid) = '' AND TRIM(companyname) = '';";
$db->query( $sql );

fclose($handle);
ini_set('auto_detect_line_endings',FALSE);

$result="SUCCESS";
echo ($result);
?>