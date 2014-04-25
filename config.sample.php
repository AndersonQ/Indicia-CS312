<?php
/*
 * All configuration will be defined here
 */

/* Host conf*/
//The full adrees to the root directory where 
//this site was installed
define('HOST_ADDRESS', 'example.com');

/* MySQL conf */
// The name of the database
define('DB_NAME', 'indicia');
// MySQL database username
define('DB_USER', 'your_db_user');
// MySQL database password
define('DB_PASSWORD', 'your_password');
// MySQL hostname
define('DB_HOST', 'mysql.example.com');
//Prefix to all tables
$table_prefix = 'ind_';

//Connecting to DB
$db = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
//Check DB connection
if ($db->connect_errno > 0) {
	header('X-PHP-Response-Code: 500', true, 500);
	die("Unable to connect to database. Error: " . $db->connect_error);
}

$query = "use " . DB_NAME . ";";
//Running query
$res = $db->query($query);
//Check it it was successful
if (!$res)
	die('There was an error connecting with database in the query [' . $db->error . ']');
?>
