<?php
include_once('functions.php');
include('inc.header.php');
?>

	<section id="main"></section>

<?php
if (!is_logged_in()) {
	echo '<script type="text/javascript">self.location.href="#signin";</script>';
}

include('inc.footer.php');
?>
