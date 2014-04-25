<?php

include_once('config.php');

if (!isset($to) || !isset($token)) die('No email or token specified.');

$subject = 'Indicia password reset';

$headers = "From: Indicia <no-reply@indicia.com>\r\n";
$headers .= "To: " . $to;
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=\"utf-8\"\r\n";

$message = '<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body style=\'font-family: "HelveticaNeue-Light", "Helvetica Neue Light", "Helvetica Neue", Helvetica, Arial, "Lucida Grande", sans-serif; color: #222; font-weight: 300; margin: 0 auto; background: #ffffff;\'>

<h1 style="font-weight: 300; margin: 30px auto; padding: 0 20px; color: #111; font-size: 30px; max-width: 600px;">Indicia</h1>
	
<div style="padding: 0 20px; color: #606060; font-weight: light; font-size: 15px; line-height: 1.6; max-width: 600px; margin: 0 auto 30px;">
	<strong>Password reset</strong><br><br>
	You recently requested for your Indicia account password to be reset. To continue and create a new password, click the link below:<br><br>
	<a href="' . HOST_ADDRESS . '/reset_password.php?token=' . $token . '">'. HOST_ADDRESS . '/reset_password.php?token=' . $token . '</a><br><br>
	Please note that this link will only work for 2 hours after your request.<br><br>If you did not request a password reset, please ignore this email.<br><br>
	Indicia
</div>

</body>
</html>';

if (!mail($to, $subject, $message, $headers)) {
	die('Error sending email');
}

?>
