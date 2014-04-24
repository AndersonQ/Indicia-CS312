<?php
include_once('functions.php');

if (!is_logged_in()) die('<div class="error-message">Error: you need to sign in to access this page.</div>');

include_once('config.php');

?>

	<div id="journey">

<?php
	//Get user's pictures
	$query = "select picture, date, lat, lon
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
			echo '<img src="' . $row['picture'] . '" ';
			echo 'title="' . $row['date'] . '" ';
			// echo 'data-lat="' . $row['lat'] . '" ';
			// echo 'data-lon="' . $row['lon'] . '" ';
			//echo 'onclick="openImg(\'' . $row['picture'] . '\', \'' . $row['date'] . '\')" ';
			echo 'onclick="openImg(\'' . $row['picture'] . '\',\'' . $row['date'] . '\',\'' . $row['lat'] . '\',\'' . $row['lon'] . '\')" ';
			echo '/> ';
	}

?>

	</div>

	<div id="shadow-div">
		<div id="img-details">
			<a href="#" onclick="closeImg(); return false;">Close</a><br />
			<img id="showImg" />
			<p id="imgcaption"></p>

			<div id="map-canvas">
				<!-- Load googlemaps here-->
			</div>
		</div>
	</div>

