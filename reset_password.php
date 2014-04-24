<?php
include_once('functions.php');
if (is_logged_in()) {
	header("Location: ./");
	exit;
}

include_once('config.php');	

function securePassword($pass) {
	//A random string to be concatenate to user's password
	$salt = hash('sha256', mt_rand());

	$hash = hash('sha256', $pass . $salt);

	return array($hash, $salt);
}

?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Password reset</title>
<meta charset="UTF-8" />
<link rel="stylesheet" href="style.css" type="text/css" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<script type="text/javascript" src="scripts.js"></script>
</head>

<body>

<header>
	<h1><a href="./"><?php if (isset($title) && $title != "") { echo $title; } else { echo "Indicia"; } ?></a></h1>
</header>

<section id="main">

	<div class="signin-message">
		<h1>Restore password</h1>

<?php
if (!isset($_GET['token']) || $_GET['token'] == '') {
	// If the token was not provided through GET, see if it was sent with post to reset password
	if (!isset($_POST['token']) || $_POST['token'] == '') {
		echo 'Invalid token (token not provided)';
	} else {

		$token = $_POST['token'];
		$new_password = securePassword($_POST['user_pass']);

		// Update user's password and salt
		$query_update = "UPDATE {$table_prefix}user_credentials u, {$table_prefix}restore_pwd_tokens t
					SET u.pass = '$new_password[0]', u.salt = '$new_password[1]'
					WHERE t.token = '$token'
					AND u.id = t.user_id";
		$query_delete = "DELETE FROM {$table_prefix}restore_pwd_tokens WHERE token = '$token'";
		if (!$db->query($query_update) || !$db->query($query_delete)) {
			die('There was an error running the query [' . $db->error . ']');
		}

		echo "Your password was successfully changed!<br />";
	}
} else {
	$token = $_GET['token'];

	// Delete from database old tokens (older than 2 hours)
	$query = "DELETE FROM {$table_prefix}restore_pwd_tokens WHERE (NOW() - date) > 2*60*60";
	$res = $db->query($query);
	if (!$res) {
		die('There was an error running the query [' . $db->error . ']');
	}

	$query = "SELECT t.*, u.email FROM {$table_prefix}restore_pwd_tokens t, {$table_prefix}user_credentials u WHERE t.token = '$token' AND u.id = t.user_id";

	$res = $db->query($query);
	if (!$res) {
		die('There was an error running the query [' . $db->error . ']');
	}

	// The token doesn't exist if no row is returned
	if ($res->num_rows == 0) {
		echo 'Sorry, the token you have provided is not valid.<br />Please remember that the token is only valid for two hours after the request.';
	} else {

		// If the code got so far, the token was found.
		$row = $res->fetch_assoc();
		$user = $row['email'];
		$userid = $row['user_id'];

?>
		Enter a new password for your account.<br />

		<form id="signin-form" method="POST" action="reset_password.php">
			<input type="email" name="user_name" value="<?php echo $user; ?>" disabled />
			<input type="password" name="user_pass" placeholder="New password" /><br />
			<input type="hidden" name="token" value="<?php echo $token; ?>" />
			<button type="submit" id="submit-button">Reset password</button>

		</form>
<?php } ?>
	</div>

<?php } ?>
</section>

</body>
</html>