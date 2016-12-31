<?php

session_start();

include_once('header_admin.php');



if(empty($_SESSION['adminUser'])) {

	header("Location: index.php");

	session_destroy();

}

?>

<style>

body { 

	padding-top: 70px; 

}

</style>



<div id="spinner" class="spinner" style="display:none;">

	<img id="img-spinner" src="spinner.gif" alt="Loading"/>

</div>



<nav class="navbar navbar-default navbar-fixed-top">

	<div class="container">

		<div class="navbar-header">

			<a class="navbar-brand" href="dashboard.php">NetherShop</a>

		</div>

		

		<div class="collapse navbar-collapse" id="navbar">

			<ul class="nav navbar-nav">

				<li class="active"><a href="dashboard.php"><i class="glyphicon glyphicon-dashboard"></i> Dashboard</a></li>

			</ul>

			

			<ul class="nav navbar-nav navbar-right">

				<li class="dropdown">

					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Zalogowany jako: <?php echo $_SESSION['adminUser']; ?> <span class="caret"></span></a>

					<ul class="dropdown-menu">

						<li><a href="logout.php"><i class="glyphicon glyphicon-off"></i> Wyloguj się</a></li>

					</ul>

				</li>

			</ul>

		</div>

	</div>

</nav>



<div class="container">

	<div class="col-md-4">

		<div class="panel panel-default">

			<div class="panel-body">

				<ul class="nav nav-pills nav-stacked">

					<li class="active"><a href="dashboard.php"><i class="glyphicon glyphicon-dashboard"></i> Dashboard</a></li>

					<li><a href="pages/add_product.php"><i class="glyphicon glyphicon-plus"></i> Dodaj usługę</a></li>

					<li><a href="pages/edit_product.php"><i class="glyphicon glyphicon-pencil"></i> Edytuj usługę</a></li>

					<li><a href="pages/add_server.php"><i class="glyphicon glyphicon-hdd"></i> Dodaj serwer</a></li>

					<li><a href="pages/edit_server.php"><i class="glyphicon glyphicon-pushpin"></i> Edytuj serwer</a></li>
					
					<li><a href="pages/shop_settings.php"><i class="glyphicon glyphicon-cog"></i> Ustawienia sklepu</a></li>

				</ul>

			</div>

		</div>

	</div>

	

	<div class="col-md-8">

		<div class="row">

		

			<div class="col-md-4">

				<div class="panel panel-default">

					<div class="panel-body text-center">

						<h2>

							<i class="glyphicon glyphicon-shopping-cart"></i>

						</h2>

						<p data-toggle="tooltip" title="Tutaj wyświetlana jest łączna liczba wszystkich dokonanych zakupów w towim sklepie!">

							Sprzedanych usług: 

							<b>

							<?php

							$last_buyer = $database->query("SELECT * FROM `last_buyer`");

							

							echo $last_buyer->num_rows;

							?>

							</b>

						</p>

					</div>

				</div>

			</div>

			

			<div class="col-md-4">

				<div class="panel panel-default">

					<div class="panel-body text-center">

						<h2>

							<i class="glyphicon glyphicon-barcode"></i>

						</h2>

						<p data-toggle="tooltip" title="Tutaj wyświetlana jest łączna liczba wszystkich aktywnych usług w towim sklepie!">

							Aktywnych usług: 

							<b>

							<?php

							$products = $database->query("SELECT * FROM `products_shop`");

							

							echo $products->num_rows;

							?>

							</b>

						</p>

					</div>

				</div>

			</div>

			

			<div class="col-md-4">

				<div class="panel panel-default">

					<div class="panel-body text-center">

						<h2>

							<i class="glyphicon glyphicon-cog"></i>

						</h2>

						<p data-toggle="tooltip" title="Informacje dotyczące sklepu! (akutualizacje, najnowsze wersje)">

							Wersja sklepu <span class="label label-success">v1.0.0.0</span>

						</p>

					</div>

				</div>

			</div>

			

		</div>

	</div>

</div>



<script>

$(document).ready(function(){

    $('[data-toggle="tooltip"]').tooltip({html: true}); 

});

</script>

</body>

</html>