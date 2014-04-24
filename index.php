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
<script type="text/javascript" src="scripts.js"></script>

<!-- GoogleMaps API -->
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=false"></script>

</head>

<body>

<header>
	<div id="back-button"><a href="#">&lt; Back</a></div>
	<h1><a href="./">Indicia</a></h1>
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
