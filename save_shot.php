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

	//Generating mock geolocation
	$lat = rand(0, 90000);
	$lon = rand(0, 180000);
	//Chooseing signal randomly
	if(rand(0,1))
		$lat = -$lat;
	if(rand(0,1))
		$lon = -$lon;
	//Making it decimal: dd.fff
	$lat = $lat/1000;
	$lon = $lon/1000;

	//Insert stmt
	$query = "INSERT INTO $table (user_id, picture, date, lat, lon) VALUES ($userid, '$picture', NOW(), $lat, $lon)";
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
