<?php
include_once('functions.php');
if (!is_logged_in()) die('<div class="error-message">Error: you need to sign in to access this page.</div>');
?>

	<ul id="options">
		<li><a href="#player">Start a new ride</a></li>
		<li><a href="#journey">Journey record</a></li>
		<li><a href="#photomap">Photo map</a></li>
		<li><a href="#settings">Settings</a></li>
	</ul>

	<div style="text-align:center">
		<a href="signout.php" class="footer-link">Sign out</a><br />
	</div>
