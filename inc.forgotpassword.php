<?php
include_once('functions.php');
if (is_logged_in()) {
	die('<div class="error-message">Error: you are already logged in.</div>');
}
?>
	<div class="signin-message">
		<h1>Recover password</h1>
		<span id="help-message">Please enter your account email.</span><br />

		<form id="signin-form" onsubmit="ajax_password_reset(); return false;">
			<input type="email" name="user_email" placeholder="Your email"><br />
			<div id="form-error-msg">Invalid username or password.</div>
			<button type="submit" id="submit-button">Continue</button>
		</form>

	</div>
