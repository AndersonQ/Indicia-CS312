<?php
include_once('functions.php');
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Indicia</title>
<meta charset="UTF-8" />
<link rel="stylesheet" href="style.css" type="text/css" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=false"></script>
<script type="text/javascript" src="scripts.js"></script>
</head>

<body>

<header>
	<table>
		<tr>
			<td id="td-side-header"><div id="back-button"><a href="#">&lt; Back</a></div></td>
			<td id="td-middle-header"><h1><a href="./">Indicia</a></h1></td>
			<td id="td-side-header"><div id="signout-button"><a href="signout.php">Sign out</a></div></td>
		</tr>
	</table>
</header>

<section id="main">
	<!-- The content loaded using ajax will be placed here -->
</section>

<?php
if (!is_logged_in()) {
	echo '
	<script type="text/javascript">
	var page = document.location.href.split("#");
	if (page[1] != "signin" && page[1] != "signup" && page[1] != "forgotpassword")
		window.location.href="#signin";
	</script>';
}
?>

<div id="loading">
	<img src="images/ajax-loader.gif" alt="Loading" class="loader" />
</div>

</body>
</html>
