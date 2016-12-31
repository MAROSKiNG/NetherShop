<?php

session_start();

include_once('header_page.php');



if(empty($_SESSION['adminUser'])) {

	header("Location: ../../index.php");

	session_destroy();

}



$id = $_GET['id'];



$database->query("DELETE FROM `products_shop` WHERE id=$id");

header("Location: ../edit_product.php?option=success");

?>