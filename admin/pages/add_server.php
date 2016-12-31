<?php
session_start();
include_once('header_page.php');

if(empty($_SESSION['adminUser'])) {
	header("Location: ../index.php");
	session_destroy();
}
$info = '';

if(isset($_POST['add_server'])) {
	if((!empty($_POST['serverName'])) && (!empty($_POST['serverIP'])) && (!empty($_POST['serverPort'])) && (!empty($_POST['server_rcon_password'])) && (!empty($_POST['server_rcon_port']))) {
		$serverName = mysqli_real_escape_string($database, $_POST['serverName']);
		$serverIP = mysqli_real_escape_string($database, $_POST['serverIP']);
		$serverPort = mysqli_real_escape_string($database, $_POST['serverPort']);
		$server_rcon_password = mysqli_real_escape_string($database, $_POST['server_rcon_password']);
		$server_rcon_port = mysqli_real_escape_string($database, $_POST['server_rcon_port']);
		
		$serverImage = "../../img/servers/";
		$serverImage = $serverImage . basename($_FILES['serverImage']['name']);
		
		move_uploaded_file($_FILES['serverImage']['tmp_name'], $serverImage);
		
	$database->query("INSERT INTO `servers_list` (name, image, server_ip, server_port, rcon_password, rcon_port) VALUES ('$serverName', '$serverImage', '$serverIP', '$serverPort', '$server_rcon_password', '$server_rcon_port')");
		
		$info = '<div class="alert alert-success" role="alert">Serwer został dodany poprawnie!</div>';
	} else {
		$info = '<div class="alert alert-danger" role="alert">Musisz wypełnić wszystkie pola, aby dodać nowy serwer!</div>';
	}
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
					<li class="active"><a href="add_server.php"><i class="glyphicon glyphicon-hdd"></i> Dodaj serwer</a></li>
					<li><a href="edit_server.php"><i class="glyphicon glyphicon-pushpin"></i> Edytuj serwer</a></li>
					<li><a href="shop_settings.php"><i class="glyphicon glyphicon-cog"></i> Ustawienia sklepu</a></li>
				</ul>
			</div>
		</div>
	</div>
	
	<div class="col-md-8">
		<div class="panel panel-default">
			<div class="panel-body">
				<div class="page-header">
					<h3>
						Dodowanie nowego serwera
						<small>Wypełnij wszystkie pola poprawnie!</small>
					</h3>
				</div>
				
				<?php echo $info; ?>
				<form method="post">
					<div class="form-group">
						<label for="serverName">Nazwa serwera</label>
						<input type="text" name="serverName" class="form-control"/>
					</div>
					
					<div class="form-group">
						<label for="serverImage">Obraz serwra</label>
						<input type="file" name="serverImage" class="btn btn-primary"/>
					</div>
					
					<div class="form-group">
						<label for="serverIP">IP serwera</label>
						<input type="text" name="serverIP" class="form-control"/>
					</div>
					
					<div class="form-group">
						<label for="serverPort">Port serwera</label>
						<input type="text" name="serverPort" class="form-control"/>
					</div>
					
					<div class="form-group">
						<label for="server_rcon_password">Hasło <b>Rcon</b> serwera</label>
						<input type="text" name="server_rcon_password" class="form-control"/>
					</div>
					
					<div class="form-group">
						<label for="server_rcon_port">Port <b>Rcon</b> serwera</label>
						<input type="text" name="server_rcon_port" class="form-control"/>
					</div>
					
					<div class="form-group text-center">
						<input type="submit" name="add_server" class="btn btn-success" value="Dodaj serwer"/>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
</body>
</html>