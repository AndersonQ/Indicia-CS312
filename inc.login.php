<?php
include_once('functions.php');
if (is_logged_in()) {
	die('<div class="error-message">Error: you are already logged in.</div>');
}
?>
	<div class="login-message">
		<h1>Login</h1>

<<<<<<< HEAD
		<form id="login-form" onsubmit="ajax_login(); return false;">
			<input type="email" name="user_email" placeholder="Your email"><br />
			<input type="password" name="user_pass"><br />
			<div id="form-error-msg">Invalid username or password.</div>
			<button type="submit" id="submit-button">Login</button>
		</form>

		<a href="#signup" class="footer-link">Create an account &raquo;</a>
	</div>
=======
			<form class="signup-form" id="login-form" onsubmit="ajax_login(); return false;">
				<input type="email" name="user_email" placeholder="Your email"><br />
				<input type="password" name="user_pass" placeholder="Your Password"><br />
				<div id="login-form-error-msg">Invalid username or password.</div>
				<button type="submit" id="submit-button">Login</button>
			</form>

			<a href="#signup" class="footer-link">Create an account &raquo;</a>
		</div>
>>>>>>> 6658da1be70f0c7910f296dcdddd4f14e5890dea
