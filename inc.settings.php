<?php
include_once('functions.php');
if (!is_logged_in()) die('<div class="error-message">Error: you need to login to access this page.</div>');
?>

	Welcome, user <?php echo $_SESSION['userid']; ?>!

	<div style="text-align:center">
		<a href="logout.php" class="footer-link">Sign out</a><br />
	</div>