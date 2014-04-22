<?php
if (!isset($_POST['user_email']) || $_POST['user_email'] == "") {
	http_response_code(400);
	die('Please provide an email.');
}

$user = $_POST['user_email'];

if (!filter_var($user, FILTER_VALIDATE_EMAIL)) {
	http_response_code(409); // 409: Conflict
	die("The email provided is not valid.");
}

include_once('config.php');

//Connecting to DB
$db = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
//Check DB connection
if ($db->connect_errno > 0) {
	http_response_code(500);
	die("Unable to connect to database. Error: " . $db->connect_error);
}

//Query user
$query = "select email
		from {$table_prefix}user_credentials
		where email = \"$user\"";
//Execute query
$res = $db->query($query);
//Check it it was successful 
if (!$res) {
	http_response_code(500);
	die('There was an error running the query [' . $db->error . ']');
}

//See if user already exists
if ($res->num_rows > 0) {
	http_response_code(409); // 409: Conflict
	die('This email is already being used.');
}

echo 'Valid.';

?>