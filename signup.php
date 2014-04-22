<?php
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

	//Connecting to DB
	$db = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	//Check DB connection
	if ($db->connect_errno > 0) {
		http_response_code(500);
		die("Unable to connect to database. Error: " . $db->connect_error);
	}

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

	echo "Registered.";
	exit;

} else {
	http_response_code(500);
	die('Registration error');
}

?>
