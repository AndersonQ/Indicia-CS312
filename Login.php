<?php
	include 'config.php';
	include 'secure.php';
	//Database table to storing user credentials
	$table = $table_prefix . "user_credentials";

	function authenticateUser($user, $pass)
	{
		global $table;
		
		//Connecting to DB
		$db = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
		//Check DB connection
		if($db->connect_errno > 0)
			die("Unable to connect to database. Error: " . $db->connect_error);

		//Get user's salt
		$query = "select email, pass, salt
				from $table
				where email like \"$user\"";
		//Execute query
		$res = $db->query($query);
		//Check it it was successful 
		if(!$res)
			die('There was an error running the query [' . $db->error . ']');
		//The user doen't exixt if no row is returned
		if($res->num_rows == 0)
		{
			echo "<h1>User does NOT exist!</h1>";
			die();
		}
		//Fetch the row
		$row = $res->fetch_assoc();
		
		$cred = securePassword($pass, $row['salt']);
		
		//Check user credentials and return true or false
		return ($cred[0] == $row['pass']) && ($user == $row['email']);
	}

	//Get user name and password from $_POST global array
	$user = $_POST["user_name"];
	$pass = $_POST["user_pass"];

	//Validate e-mail
	if(filter_var($user, FILTER_VALIDATE_EMAIL))
		if(authenticateUser($user, $pass))
			echo "<h1>User authenticated!</h1>";
		else
			echo "<h1>Email or passowrd invalid!</h1>";
	else
		echo "<h1>$user is NOT a valid email!!</h1>";
?>
