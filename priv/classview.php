<?php
session_start();

#Connect to & Check the database connection
require '../includes/dbstuff.inc.php';
$db = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}

$id = $_GET["id"];
$viewable = $_GET["viewable"];

if($viewable == "No") {
	$sql = "UPDATE classifieds SET viewable='Yes' WHERE id=$id";
}else{
	$sql = "UPDATE classifieds SET viewable='No' WHERE id=$id";
}

if ($db->query($sql) === TRUE) {
    echo "Record updated successfully";
}else{
	echo "Error updating record: " . $db->error;
}

echo "<center><b>" . $id . "</b></center>";

$db->close();
header( 'Location: classqueue.php' );
?>
