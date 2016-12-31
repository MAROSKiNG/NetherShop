<?php

session_start();
include_once('header_page.php');

if(empty($_SESSION['adminUser'])) {
	header("Location: ../../index.php");
	session_destroy();
}

$id = $_GET['id'];

$database->query("DELETE FROM `servers_list` WHERE id=$id");

header("Location: ../edit_server.php?option=success");

?>