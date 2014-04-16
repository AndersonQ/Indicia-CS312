<?php
include_once('functions.php');
if (!is_logged_in()) die("Forbidden");
?>

	<ul id="options">
		<li><a href="#" onclick="loadContent('player.html');return false;">Start a new ride</a></li>
		<li><a href="#">Journey record</a></li>
		<li><a href="#">Photo map</a></li>
		<li><a href="#">Usage statistics</a></li>
		<li><a href="#">Settings</a></li>
	</ul>

	<div style="text-align:center">
		<a href="logout.php" class="footer-link">Sign out</a>
	</div>