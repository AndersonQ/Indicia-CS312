<?php
include_once('functions.php');

if (!is_logged_in()) die('<div class="error-message">Error: you need to sign in to access this page.</div>');

include_once('config.php');

//Load GoogleMaps api
//TODO make it work
echo '<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=false"></script>';
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
			echo 'alt="' . $row['date'] . '" ';
			echo 'data-lat="' . $row['lat'] . '" ';
			echo 'data-lon="' . $row['lon'] . '" ';
			//echo 'onclick="openImg(\'' . $row['picture'] . '\', \'' . $row['date'] . '\')" ';
			echo 'onclick="openImg(this)" ';
			echo '/> ';
	}

?>

	</div>

	<div id="imgdiv">
		<img id="showImg"></img>
		<p id="imgcaption"></p>
	</div>

	<div id="map-canvas">
		<!-- Load googlemaps here-->
	</div>
<script type="text/javascript">
initialize();alert('after!!!');</script>
