<?php
if (!isset($to)) die('No email destinatary specified.');

$subject = 'Indicia Registration';

$headers = "From: Indicia <no-reply@indicia.com>\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=UTF-8\r\n";

$message = '<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Indicia</title>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
</head>

<body style="font: 16px \'Helvetica Neue\', Helvetica, Arial; color: #222; font-weight: 300; margin: 0; background: #fff;">

<header style="background: #333; padding: 10px;">
	<h1 style="font-weight: 400; margin: 0 auto; text-align: center; color: #fff; font-size: 25px; line-height: 30px;">Indicia</h1>
</header>
	
<section style="padding: 30px 70px; color: #444; font-weight: light; line-height: 22px;">
	<p><b>Welcome!</b></p>
	<p>You are receiving this message to confirm your registration with Indicia. To sign in, please use your email address <u>' . $to . '</u> along with the password provided during registration.</p>
	<p>Thanks for using Indicia!</p>
	<p>Indicia Team</p>
</section>

</body>
</html>';

if (!mail($to, $subject, $message, $headers)) {
	die('Error sending email');
}

?>