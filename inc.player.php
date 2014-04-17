<?php
include_once('functions.php');
if (!is_logged_in()) die('<div class="error-message">Error: you need to login to access this page.</div>');
?>
		<div id="player">
			<img src="stills/ishot-37.jpg" id="video-still" alt="Video" />
			Tap on the video to take a picture.
		</div>