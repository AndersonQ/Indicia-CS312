<?php
include_once('functions.php');

if (!is_logged_in()) die('<div class="error-message">Error: you need to sign in to access this page.</div>');

include_once('config.php');

?>

<div id="delacc">
	Delete this account is irreversible, all your photos and data will be erased!<br>
	<button class="btdel" type="button"	onclick="deleteacc()">Delete my account</button><br>
</div>

