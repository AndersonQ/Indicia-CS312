<?php
include_once('functions.php');

if (is_logged_in()) {
	http_response_code(400);
	die('Bad request: user already signed in.');
}

//Get user name and password from $_POST global array
$user = @$_POST["user_email"];
$pass = @$_POST["user_pass"];

//Validate e-mail
if (!filter_var($user, FILTER_VALIDATE_EMAIL)) {
	http_response_code(400);
	die("The email provided is not valid.");
}

include_once('config.php');

function securePassword($pass) {
	//A random string to be concatenate to user's password
	$salt = hash('sha256', mt_rand());

	$hash = hash('sha256', $pass . $salt);

	return array($hash, $salt);
}

function addUser($user, $pass) {
	global $table_prefix;
	global $db;

	$pass = securePassword($pass);
	$addUserSQL = <<<SQL
		insert into {$table_prefix}user_credentials
			(email, pass, salt)
			values('$user', '$pass[0]', '$pass[1]')
SQL;

	$res = $db->query($addUserSQL);

	//Check if user was successfully added
	if (!$res) {
		http_response_code(400); // 400: Bad request
		die("Error registering user $user: " . $db->error);
	}

	return $db->insert_id;
}

//Add user on database and log in
if ($userid = addUser($user, $pass)) {
	// clear out any existing session that may exist
	session_start();
	session_destroy();
	session_start();

	$_SESSION['signed_in'] = true;
	$_SESSION['userid'] = $userid;

	// send registration e-mail to user
	$to = $user;
	include('signup_mail.php');

	echo "Registered.";
	exit;

} else {
	http_response_code(500);
	die('Registration error');
}

?>
