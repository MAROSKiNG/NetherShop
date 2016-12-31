<?php
include '../../inc/connection.php';

$shop_settings = $database->query("SELECT shop_name, shop_description FROM shop_settings");
$shop = $shop_settings->fetch_assoc();

?>

<html lang="pl">
<head>
	
	<title><?php echo $shop['shop_name'] .' - '. $shop['shop_description']; ?></title>
	
	<meta charset="utf-8" />
	
	<link href="../../css/bootstrap.min.css" rel="stylesheet"/>
	<link href="../../css/main.nethershop.css" rel="stylesheet"/>
	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script src="../../js/bootstrap.min.js"></script>

</head>
<body>