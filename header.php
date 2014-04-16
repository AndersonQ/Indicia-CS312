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
<h1><?php if (isset($title) && $title != "") { echo $title; } else { echo "Indicia"; } ?></h1>
</header>