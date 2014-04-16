		<div class="login-message">
			<h1>Login</h1>

			<form class="signup-form" id="login-form" onsubmit="ajax_login(); return false;">
				<input type="email" name="user_email" placeholder="Your email"><br />
				<input type="password" name="user_pass"><br />
				<div id="login-form-error-msg">Invalid username or password.</div>
				<button type="submit" id="submit-button">Login</button>
			</form>

			<a href="#" onclick="loadContent('inc.signup.php'); return false;" class="footer-link">Create an account &raquo;</a>
		</div>