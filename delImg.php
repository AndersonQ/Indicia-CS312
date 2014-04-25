<?php
include_once('functions.php');

if (!is_logged_in()) 
		die('<div class="error-message">Error: you need to sign in to access this page.</div>');

include_once('config.php');

if(!isset($_GET[id]) || $_GET[id] == "")
		die('<div class="error-message">Error: No picture to be deleted!)</div>');

$userid = $_SESSION['userid'];
$id = $_GET[id];

//Delete entries in pictures
$query = <<<SQL
delete from {$table_prefix}pictures
	where user_id = '$userid' and id = '$id'
SQL;
$res = $db->query($query);

if (!$res) 
{
	http_response_code(500);
	die('There was an error running the query [' . $db->error . ']');
}

header('Location: index.php#journey');
die()
?>
