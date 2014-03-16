<?php
	/*
 	* Secure passorwd, if receives a salt it calculates the hash with the 'salt'.
	* Otherwise it generates a 'salt' and return the hash and the new 'salt' 
	 */
	function securePassword($pass, $salt = null)
	{
			//There isn't a salt, so generate one
			if($salt == null)
				$salt = hash('sha256', mt_rand());

			$hash = hash('sha256', $pass . $salt);

			return array($hash, $salt);
	}
?>
