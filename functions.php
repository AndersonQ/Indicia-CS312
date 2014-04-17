<?php
session_start();

function is_logged_in() {
	if (isset($_SESSION['signed_in']) && $_SESSION['signed_in'] === true) {
		return true;
	}

	return false;
}

?>