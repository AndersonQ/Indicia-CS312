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
</head>

<body>

<div id="loading">
	<img src="images/ajax-loader.gif" alt="Loading" class="loader" />
</div>

<header>
	<div id="back-button"><a href="#">&lt; Back</a></div>
	<h1><a href="./"><?php if (isset($title) && $title != "") { echo $title; } else { echo "Indicia"; } ?></a></h1>
</header>

<section id="main">
	<!-- The content loaded using ajax will be placed here -->
</section>

<?php
if (!is_logged_in()) {
	echo '<script type="text/javascript">window.location.href="#signin";</script>';
}
?>

<footer>
	<!-- Session: <?php print_r($_SESSION); ?> -->
</footer>

</body>
</html>