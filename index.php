<?php

include_once('functions.php');

include('header.php');

if (is_logged_in()) {
	$inc_page = "inc.home.php";
} else {
	$inc_page = "inc.signup.php";
}

?>
	<section id="main"></section>

	<script type="text/javascript">
	loadContent('<?php echo $inc_page; ?>');
	</script>

<?php
include('footer.php');

?>