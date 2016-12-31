<?php



	$host = "localhost";

	$user = "nethershop_shop";

	$pass = "Zygz@k95";

	$base = "nethershop_shop";



	$database = mysqli_connect($host, $user, $pass, $base);

		

	if(!$database) {

		echo ('Brak połączenia z bazą danch MySQL!');

	}

?>