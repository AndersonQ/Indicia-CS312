	<div class="signup-message">
		<h1>Create your account</h1>
		Please sign up with an email and a password to start using the app.<br />

		<form id="signup-form" onsubmit="ajax_signup(); return false;" onchange="ajax_validate_signup();">
			<input type="email" name="user_email" placeholder="Your email"><br />
<<<<<<< HEAD
			<input type="password" name="user_pass"><br />
			<div id="form-error-msg">Invalid username or password.</div>
=======
			<input type="password" name="user_pass" placeholder="Your Password"><br />
>>>>>>> 6658da1be70f0c7910f296dcdddd4f14e5890dea
			<button type="submit" id="submit-button">Create account</button>
		</form>

		<a href="#login" class="footer-link">Login with existing account &raquo;</a>

	</div>
