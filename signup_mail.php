<?php
if (!isset($to)) die('No email target specified.');

$subject = 'Indicia Registration';

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

<h1 style="font-weight: 300; margin: 30px auto; padding: 0 30px; color: #111; font-size: 30px; max-width: 600px;">Indicia</h1>
	
<div style="padding: 0 30px; color: #606060; font-weight: light; font-size: 15px; line-height: 1.6; max-width: 600px; margin: 0 auto;">
	<strong>Welcome!</strong><br><br>
	You are receiving this message to confirm your registration with Indicia. To sign in, please use your email address <u>' . $to . '</u> along with the password provided during registration.<br><br>
	Thanks for using Indicia!<br>
</div>

</body>
</html>';

if (!mail($to, $subject, $message, $headers)) {
	die('Error sending email');
}

?>