<?php
session_start();
session_destroy();
unset($_SESSION['adminUser']);

include_once('header_admin.php');
?>

<div class="container" style="padding-top: 20px;">
	<div class="alert alert-success" role="alert">Zostałeś pomyślnie wylogowany z panelu administratora!</div>
	<meta http-equiv="refresh" content="2; index.php">
</div>