<?php

	//Database table to store user credentials
	$table = "user_credentials";

	function securePassword($pass)
	{
			//A randon string to be concatenete with user's password
			$salt = hash('sha256', mt_rand());

			$hash = hash($pass . $salt);

			return array($hash, $salt);
	}

	function addUser($name, $pass)
	{
			$pass = securePassord($pass);
			addUserSQL = <<<SQL
				insert into $table
					values('$name', '$pass[0]', '$pass[1]')
SQL;
	}

?>
