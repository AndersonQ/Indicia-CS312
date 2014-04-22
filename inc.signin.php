<?php
include_once('functions.php');
if (is_logged_in()) {
	die('<div class="error-message">Error: you are already logged in.</div>');
}
?>
	<div class="signin-message">
		<h1>Sign in</h1>
		Please sign in with an email and a password to start using the app.<br />

		<form id="signin-form" onsubmit="ajax_signin(); return false;">
			<input type="email" name="user_email" placeholder="Your email"><br />
			<input type="password" name="user_pass" placeholder="Your password"><br />
			<div id="form-error-msg">Invalid username or password.</div>
			<button type="submit" id="submit-button">Sign in</button>
		</form>

		<a href="#signup" class="footer-link">Create an account &raquo;</a>
	</div>
