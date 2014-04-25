<?php
include_once('functions.php');

if (!is_logged_in()) die('<div class="error-message">Error: you need to sign in to access this page.</div>');

include_once('config.php');

?>

	<div id="journey">

<?php
	//Get user's pictures
	$query = "select picture, date, lat, lon, id
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
			$date = date('d/m/Y \a\t H:i', strtotime($row['date']));
			echo '<img src="' . $row['picture'] . '" ';
			echo 'title="' . $row['date'] . '" ';
			echo 'onclick="openImg(\'' . $row['picture'] . '\',\'' . $date . '\',\'' . $row['lat'] . '\',\'' . $row['lon'] . '\', \'' . $row['id'] . '\')" ';
			echo '/> ';
	}

?>

	</div>

	<div id="shadow-div">
		<div id="img-details">
			<a href="#" onclick="closeImg(); return false;">Close</a><br />
			<img id="showImg" />
			<p id="imgcaption"></p>
			<a id="delImg" href="#">Delete</a><br />

			<div id="map-canvas">
				<!-- Load googlemaps here-->
			</div>
			
		</div>
	</div>

