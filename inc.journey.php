<?php
include_once('functions.php');

if (!is_logged_in()) die('<div class="error-message">Error: you need to sign in to access this page.</div>');

include_once('config.php');
?>

	<div id="journey">

<?php
	//Get user's pictures
	$query = "select picture, date
			from {$table_prefix}pictures
			where user_id = " . $_SESSION['userid'];
	//Execute query
	$res = $db->query($query);
	//Check it it was successful 
	if (!$res) {
		die('There was an error running the query [' . $db->error . ']');
	}
	
	//Fetch the rows
	while ($row = $res->fetch_assoc()) {
			echo '<img src="' . $row['picture'];
			echo '" alt="' . $row['date'];
			echo '" onclick="openImg(\'';
			echo $row['picture'];
			echo '\')"';
			echo '/> ';
	}

?>

	</div>

	<img id="showImg"></img>
