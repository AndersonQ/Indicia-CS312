<?php
session_start();
date_default_timezone_set('Europe/London');

function is_logged_in() {
	if (isset($_SESSION['signed_in']) && $_SESSION['signed_in'] === true) {
		return true;
	}

	return false;
}

// For 4.3.0 <= PHP < 5.4.0
if (!function_exists('http_response_code')) {
    function http_response_code($newcode = NULL) {
        static $code = 200;
        if ($newcode !== NULL) {
            header('X-PHP-Response-Code: '. $newcode, true, $newcode);
            if (!headers_sent())
                $code = $newcode;
        }       
        return $code;
    }
}

?>