<?php



	$host = "host bazy danych";

	$user = "uzytkownik";

	$pass = "haslo";

	$base = "baza danych";



	$database = mysqli_connect($host, $user, $pass, $base);

		

	if(!$database) {

		echo ('Brak połączenia z bazą danch MySQL!');

	}

?>
