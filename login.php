<?php
include_once('config.php');
$table = $table_prefix . "user_credentials";

// TODO verify if is not logged in

/*
 * Secure passorwd, if receives a salt it calculates the hash with the 'salt'.
 * Otherwise it generates a 'salt' and return the hash and the new 'salt' 
 */
function securePassword($pass, $salt = null) {
	//There isn't a salt, so generate one
	if ($salt == null)
		$salt = hash('sha256', mt_rand());

	$hash = hash('sha256', $pass . $salt);

	return array($hash, $salt);
}

function authenticateUser($user, $pass) {
	global $table;
	
	//Connecting to DB
	$db = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	//Check DB connection
	if ($db->connect_errno > 0) {
		http_response_code(500);
		die("Unable to connect to database. Error: " . $db->connect_error);
	}

	//Get user's salt
	$query = "select id, email, pass, salt
			from $table
			where email = \"$user\"";
	//Execute query
	$res = $db->query($query);
	//Check it it was successful 
	if (!$res) {
		http_response_code(500);
		die('There was an error running the query [' . $db->error . ']');
	}
	//The user doesn't exist if no row is returned
	if ($res->num_rows == 0) return false;
	//Fetch the row
	$row = $res->fetch_assoc();
	
	$cred = securePassword($pass, $row['salt']);
	
	//Check user credentials and return user id or false
	if (($cred[0] == $row['pass']) && ($user == $row['email'])) {
		return $row['id'];
	}

	return false;
}

//Get user name and password from $_POST global array
$user = @$_POST["user_email"];
$pass = @$_POST["user_pass"];

//Validate e-mail
if (filter_var($user, FILTER_VALIDATE_EMAIL)) {
	if ($userid = authenticateUser($user, $pass)) {
		// clear out any existing session that may exist
		session_start();
		session_destroy();
		session_start();

		$_SESSION['signed_in'] = true;
		$_SESSION['userid'] = $userid;

		echo "Logged in";
		exit;
	} else {
		http_response_code(403);
		die("Email or passowrd invalid");
	}
} else {
	http_response_code(403);
	die("$user is not a valid email");
}
?>
