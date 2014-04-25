<?php
include_once('functions.php');

if (!is_logged_in()) 
{
		die('<div class="error-message">Error: you need to sign in to access this page.</div>');
}

include_once('config.php');

$userid = $_SESSION['userid'];

//Delete entries in restore_pwd_tokens
$query = <<<SQL
delete from {$table_prefix}restore_pwd_tokens
	where user_id = '$userid'
SQL;
$res = $db->query($query);
if (!$res) {
	http_response_code(500);
	die('There was an error running the query [' . $db->error . ']');
}

//Delete entries in pictures
$query = <<<SQL
delete from {$table_prefix}pictures
	where user_id = '$userid'
SQL;
$res = $db->query($query);
if (!$res) {
	http_response_code(500);
	die('There was an error running the query [' . $db->error . ']');
}

//Delete the user itself, entry in user_credentials
$query = <<<SQL
delete from {$table_prefix}user_credentials
	where id = '$userid'
SQL;
$res = $db->query($query);
if (!$res) {
	http_response_code(500);
	die('There was an error running the query [' . $db->error . ']');
}

include('signout.php');

?>
