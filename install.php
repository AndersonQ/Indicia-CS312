<?php
/*
 * This script creates the tables in the database and populate it if necessary
 */

if (!isset($_GET['start']) || $_GET['start'] != 1) {
	echo "This script deletes existing tables and recreates the whole database. To confirm and continue, click <a href='?start=1'>here</a>.";
	exit;
}

echo "Connecting to database...<br>";

include_once('config.php');

echo "Connected to database.<br>Creating tables...<br>";

/* Deleting existing tables */

//Pictures
$create = <<<SQL
DROP TABLE IF EXISTS {$table_prefix}pictures;
SQL;
//Deleting table if it exists
$res = $db->query($create);
//check if table was deleted
if (!$res)
	die("Error whilie deleting table {$table_prefix}pictures" . $db->error);
//User credentials
$create = <<<SQL
DROP TABLE IF EXISTS {$table_prefix}user_credentials;
SQL;
//Deleting table if it exists
$res = $db->query($create);
//check if table was deleted
if (!$res)
	die("Error whilie deleting table {$table_prefix}user_credentials" . $db->error);


/* Create tables statements */

//User credentials
//Create tables statement
$create = <<<SQL
CREATE TABLE {$table_prefix}user_credentials (
    id int(11) unsigned NOT NULL AUTO_INCREMENT,
    email varchar(100) NOT NULL,
    pass varchar(64) NOT NULL,
    salt varchar(64) NOT NULL,
    PRIMARY KEY (id),
    UNIQUE KEY email (email)
 ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
SQL;
//Creating table
$res = $db->query($create);
//check if table was created
if (!$res)
	die("Error whilie creating table {$table_prefix}user_credentials" . $db->error);

//Pictures
//Create tables statement
$create = <<<SQL
CREATE TABLE {$table_prefix}pictures (
  id int(11) unsigned NOT NULL AUTO_INCREMENT,
  user_id int(10) unsigned NOT NULL,
  picture varchar(255) NOT NULL DEFAULT "",
  lat float,
  lon float,
  date datetime NOT NULL,
  PRIMARY KEY (id),
  KEY user_id (user_id),
  CONSTRAINT ind_pictures_ibfk_1 FOREIGN KEY (user_id) REFERENCES ind_user_credentials (id) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
SQL;
//Creating table
$res = $db->query($create);
//check if table was created
if (!$res)
	die("Error whilie creating table {$table_prefix}pictures: " . $db->error);

echo "Tables created.<br><br>Installation complete.";

?>
