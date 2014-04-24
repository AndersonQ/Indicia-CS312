<?php
include_once('functions.php');

if (is_logged_in()) {
	http_response_code(400);
	die('You are already logged in');
}

include_once('config.php');

// Verify if email provided is valid
if (!isset($_POST['user_email']) || $_POST['user_email'] == '' || !filter_var($_POST['user_email'], FILTER_VALIDATE_EMAIL)) {
	http_response_code(400);
	die("The email provided is not valid.");
}

$user = $_POST['user_email'];

// Verify if user exists in db
$query = "SELECT id, email FROM {$table_prefix}user_credentials WHERE email = '$user'";
$res = $db->query($query);

if (!$res) {
	http_response_code(500);
	die('There was an error running the query [' . $db->error . ']');
}

// The user doesn't exist if no row is returned
if ($res->num_rows == 0) {
	http_response_code(400);
	die('The account for the email ' . $user . ' was not found.');
}

// If the code got so far, the user was found. Continue generating token...
$row = $res->fetch_assoc();
$userid = $row['id'];

// Token generated for password recovery will depend on username and a random value
$token = hash('sha256', $user . mt_rand());

// Delete previous tokens (user can only have one token working)
$query = "DELETE FROM {$table_prefix}restore_pwd_tokens WHERE user_id = " . $userid;
$res = $db->query($query);

if (!$res) {
	http_response_code(500);
	die('There was an error running the query [' . $db->error . ']');
}

// Insert new token
$query = "INSERT INTO {$table_prefix}restore_pwd_tokens (user_id, token, date) VALUES ($userid, '$token', NOW())";
$res = $db->query($query);

if (!$res) {
	http_response_code(500);
	die('There was an error running the query [' . $db->error . ']');
}

// Email restore password link to user
$to = $user;
include('forgot_mail.php');

echo "Reset password email sent";

?>