<?php
	//Database configurations
	include 'config.php';
	//Database table to store user credentials
	$table = $table_prefix . "user_credentials";

	function securePassword($pass)
	{
			//A randon string to be concatenete with user's password
			$salt = hash('sha256', mt_rand());

			$hash = hash('sha256', $pass . $salt);

			return array($hash, $salt);
	}

	function addUser($user, $pass)
	{
			global $table;

			//Connecting to DB
			$db = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
			//Check DB connection
			if($db->connect_errno > 0)
				die("Unable to connect to database. Error: " . $db->connect_error);
			
			//Verify if there isn't a user with this e-mail
			$querry = <<<SQL
				select email from $table
					where email = "$user"
SQL;
			$res = $db->query($querry);
			if($res->num_rows != 0)
			{	
				$msg = "E-mail $user already registered! Sing in or choose a new one";
				echo "<script type=\"text/javascript\">";
					echo "window.alert(\"$msg\");";
				echo "</script>";
				die("E-mail $user already registered! Sing in or choose a new one");
			}


			$pass = securePassword($pass);
			$addUserSQL = <<<SQL
				insert into $table
					(email, pass, salt)
					values('$user', '$pass[0]', '$pass[1]')
SQL;
			$res = $db->query($addUserSQL);
			//Check if user was successfully added
			if(!$res)
				die("Error whilie addind user $user: " . $db->error);
	}
	
	//Get user name and password from $_POST global array
	$user = $_POST["user_email"];
	$pass = $_POST["user_pass"];

	//Validate e-mail
	if(!filter_var($user, FILTER_VALIDATE_EMAIL))
		die("<h1>$user is NOT a valid email!!</h1>");

	//Add user on database
	addUser($user, $pass);

	echo("<h1>User $user added!</h1>");

?>
