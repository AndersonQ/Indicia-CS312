<?php
include_once('functions.php');

if (!is_logged_in()) die('<div class="error-message">Error: you need to sign in to access this page.</div>');

include_once('config.php');

?>

<h2>Delete account</h2>

<div id="delacc">
	<b>Deleting your account is irreversible! All your photos and data will be erased.</b><br /><br />
	Continue?<br /><br />
	<button class="btdel" type="button"	onclick="deleteacc()">Delete my account</button><br />
</div>

