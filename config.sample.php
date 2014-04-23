<?php
/*
 * All configuration will be defined here
 */

/* MySQL conf */
// The name of the database
define('DB_NAME', 'indicia');
// MySQL database username
define('DB_USER', 'root');
// MySQL database password
define('DB_PASSWORD', 'your_password');
// MySQL hostname
define('DB_HOST', '127.0.0.1');
//Prefix to all tables
$table_prefix = 'ind_';

//Connecting to DB
$db = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
//Check DB connection
if ($db->connect_errno > 0) {
	header('X-PHP-Response-Code: 500', true, 500);
	die("Unable to connect to database. Error: " . $db->connect_error);
}
?>
