<?php

session_start();
include_once('header_page.php');

if(empty($_SESSION['adminUser'])) {
	header("Location: ../index.php");
	session_destroy();
}

$info = '';
$option = $_GET['option'];

if($option == "success") {
	$info = '<div class="alert alert-success" role="alert">Podany serwer został usunięty!</div>';
} else if($option == "update_success") {
	$info = '<div class="alert alert-success" role="alert">Podany serwer został poprawnie zaktualizowany!</div>';
}
?>
<style>
body { 
	padding-top: 70px; 
}
</style>

<nav class="navbar navbar-default navbar-fixed-top">

	<div class="container">

		<div class="navbar-header">

			<a class="navbar-brand" href="dashboard.php">NetherShop</a>

		</div>

		

		<div class="collapse navbar-collapse" id="navbar">

			<ul class="nav navbar-nav">

				<li class="active"><a href="../dashboard.php"><i class="glyphicon glyphicon-dashboard"></i> Dashboard</a></li>

			</ul>

			

			<ul class="nav navbar-nav navbar-right">

				<li class="dropdown">

					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Zalogowany jako: <?php echo $_SESSION['adminUser']; ?> <span class="caret"></span></a>

					<ul class="dropdown-menu">

						<li><a href="../logout.php"><i class="glyphicon glyphicon-off"></i> Wyloguj się</a></li>

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
					<li><a href="../dashboard.php"><i class="glyphicon glyphicon-dashboard"></i> Dashboard</a></li>
					<li><a href="add_product.php"><i class="glyphicon glyphicon-plus"></i> Dodaj usługę</a></li>
					<li><a href="edit_product.php"><i class="glyphicon glyphicon-pencil"></i> Edytuj usługę</a></li>
					<li><a href="add_server.php"><i class="glyphicon glyphicon-hdd"></i> Dodaj serwer</a></li>				
					<li class="active"><a href="edit_server.php"><i class="glyphicon glyphicon-pushpin"></i> Edytuj serwer</a></li>
					<li><a href="shop_settings.php"><i class="glyphicon glyphicon-cog"></i> Ustawienia sklepu</a></li>
				</ul>
			</div>
		</div>
	</div>

	

	<div class="col-md-8">

		<div class="panel panel-default">

			<div class="panel-body">

			

				<?php echo $info; ?>

				<div class="page-header">

					<h3>

						Edytowanie usług

					</h3>

				</div>

				

				<table class="table">

					<thead>

						<tr>

							<th>ID</th>

							<th>Nazwa</th>

							<th>Akcja</th>

						</tr>

					</thead>

					<tbody>

						<?php 

								

						$servers = $database->query("SELECT * FROM `servers_list`");

								

						if($servers->num_rows > 0) {

							while($s = $servers->fetch_assoc()) {

								?>

								<tr>

									<th><?php echo $s['id']; ?></th>

									<th><?php echo $s['name']; ?></th>

									<th>

										<form style="margin: 0px;" method="post">

											<a href="#" data-toggle="modal" data-target="#<?php echo $s['id']; ?>" class="btn btn-primary"><i class="glyphicon glyphicon-pencil"></i></a>

											<a href="inc/delete_server.php?id=<?php echo $s['id']; ?>" name="delete_button" class="btn btn-danger"><i class="glyphicon glyphicon-remove"></i></a>

										</form>

									</th>

								</tr>

										

								<div class="modal fade" id="<?php echo $s['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

									<div class="modal-dialog" role="document">

										<div class="modal-content">

											<div class="modal-header">

												<button type="button" class="close" data-dismiss="modal" aria-label="Close">

													<span aria-hidden="true">&times;</span>

												</button>

														

												<h4 class="modal-title" id="myModalLabel">Edytujesz serwer: <?php echo $s['name']; ?></h4>

											</div>

											

											<div class="modal-body">

												<form method="post" enctype="multipart/form-data" action="inc/update_server.php?id=<?php echo $s['id']?>">

													<div class="form-group">
														<label for="serverName">Nazwa serwera</label>
														<input type="text" name="serverName" class="form-control" value="<?php echo $s['name']; ?>"/>
													</div>

													<div class="form-group">
														<label for="serverIP">IP serwera</label>
														<input type="text" name="serverIP" class="form-control" value="<?php echo $s['server_ip']; ?>"/>
													</div>
													
													<div class="form-group">
														<label for="serverPort">Port serwera</label>
														<input type="text" name="serverPort" class="form-control" value="<?php echo $s['server_port']; ?>"/>
													</div>
													
													<div class="form-group">
														<label for="rcon_password">Hasło <b>Rcon</b> serwera</label>
														<input type="text" name="rcon_password" class="form-control" value="<?php echo $s['rcon_password']; ?>"/>
													</div>
													
													<div class="form-group">
														<label for="rcon_port">Port <b>Rcon</b> serwera</label>
														<input type="text" name="rcon_port" class="form-control" value="<?php echo $s['rcon_port']; ?>"/>
													</div>
													<div class="form-group text-center">
														<input type="submit" name="update_button" value="Zaktualizuj" class="btn btn-success"/>
													</div>

													

													<input type="hidden" name="id" value="<?php echo $s['id']; ?>" />

												</form>

											</div>

										<div>

									</div>

								</div>

						<?php

							}

						} else {

							echo ('

							<div class="alert alert-danger" role="alert">Brak serwerów do wyświetlenia!</div>

							');

						}

								

						?>

					</tbody>

				</table>

			</div>

		</div>

	</div>

</div>

</body>

</html>