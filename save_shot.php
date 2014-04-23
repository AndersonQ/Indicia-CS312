<?php
include_once('functions.php');

if (!is_logged_in()) {
	http_response_code(403);
	die('Forbidden');
}

include_once('config.php');

function save_picture($userid, $picture) {
	global $table_prefix;
	global $db;
	$table = $table_prefix . "pictures";

	//Insert stmt
	$query = "INSERT INTO $table (user_id, picture, date) VALUES ($userid, '$picture', NOW())";
	//Execute query
	$res = $db->query($query);
	//Check it it was successful 
	if (!$res) {
		http_response_code(500);
		die('There was an error running the query [' . $db->error . ']');
	}
}


if (!isset($_POST["picture"]) || $_POST["picture"] == '') {
	http_response_code(400);
	die('Bad request');
}

save_picture($_SESSION['userid'], $_POST["picture"]);

?>