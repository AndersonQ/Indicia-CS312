<?php
/*
 * This script creates the tables in the database and populate it if necessary
 */
 	include 'config.php';
	
	$db = new msqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

	//Check DB connection
	if(db->connect_errno > 0)
		die("Unable to connect to database. Error: " . $db->connect_error);

	/* Create tables statements */
	//User credentials
	$user_credentials = <<<SQL
		create table $table_prefix . user_credentials
		(id int not null auto_incremet primary key,
		 email varchar(100) not null UNIQUE,
		 pass varchar(64) not null,
		 salt varchar(64) not null)
SQL;

	/* Creating tables */
	$res = db->query($user_credentials);
	//check if table was created
	if(!res)
		die("Error whilie creating 'user_credentials' table: " . db->error);
?>
