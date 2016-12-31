<?php

session_start();
include_once('header_page.php');

if(empty($_SESSION['adminUser'])) {
	header("Location: ../../index.php");
	session_destroy();
}

$id = $_GET['id'];

$serverName = mysqli_real_escape_string($database, $_POST['serverName']);
$serverIP = mysqli_real_escape_string($database, $_POST['serverIP']);
$serverPort = mysqli_real_escape_string($database, $_POST['serverPort']);
$server_rcon_password = mysqli_real_escape_string($database, $_POST['rcon_password']);
$server_rcon_port = mysqli_real_escape_string($database, $_POST['rcon_port']);

$database->query("UPDATE `servers_list` SET name='$serverName', server_ip='$serverIP', server_port='$serverPort', rcon_password='$server_rcon_password', rcon_port='$server_rcon_port' WHERE id='$id'");

header("Location: ../edit_server.php?option=update_success");

?>