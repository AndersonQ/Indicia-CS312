<?php
include_once('functions.php');
if (!is_logged_in()) die('<div class="error-message">Error: you need to sign in to access this page.</div>');
include_once('config.php');

$query = "SELECT u.email, COUNT(p.id) AS pictures FROM {$table_prefix}user_credentials u, {$table_prefix}pictures p WHERE u.id = " . $_SESSION['userid'] . " AND p.user_id = u.id";
$res = $db->query($query);
if (!$res) {
	die('There was an error running the query [' . $db->error . ']');
}

$info = $res->fetch_assoc();

?>

	<h2 style="text-align:center">My account</h2>

	<div style="text-align:center">
		<b>Account:</b> <?php echo $info['email']; ?><br />
		<b>Pictures saved:</b> <?php echo $info['pictures']; ?><br />
		<br />
		<a href="#delacc">Delete account</a><br>
<!--
		<a href="signout.php">Sign out</a><br />
-->
	</div>
