<?php
include_once('config.php');
include_once('functions.php');
if (!is_logged_in()) die('<div class="error-message">Error: you need to sign in to access this page.</div>');

function get_pictures() {
	global $table_prefix;
	
	//Connecting to DB
	$db = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	//Check DB connection
	if ($db->connect_errno > 0) {
		http_response_code(500);
		die("Unable to connect to database. Error: " . $db->connect_error);
	}

	//Get user's salt
	$query = "select picture, date
			from {$table_prefix}pictures
			where user_id = " . $_SESSION['userid'];
	//Execute query
	$res = $db->query($query);
	//Check it it was successful 
	if (!$res) {
		http_response_code(500);
		die('There was an error running the query [' . $db->error . ']');
	}
	
	//Fetch the rows
	while ($row = $res->fetch_assoc()) {
		echo '<img src="' . $row['picture'] . '" alt="' . $row['date'] . '" /> ';
	}
}

?>

	<div id="journey">
	<?php get_pictures(); ?>
	</div>
