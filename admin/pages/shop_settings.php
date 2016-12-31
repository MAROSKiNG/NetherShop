<?php
session_start();
include_once('header_page.php');

if(empty($_SESSION['adminUser'])) {
	header("Location: ../index.php");
	session_destroy();
}
$info = '';

if(isset($_POST['save_button'])) {
	if((!empty($_POST['shopName'])) && (!empty($_POST['shopDescription'])) && (!empty($_POST['microsms_userid'])) && (!empty($_POST['microsms_serviceid']))) {
		if((is_numeric($_POST['microsms_userid'])) && (is_numeric($_POST['microsms_serviceid']))) {
			
			$shopName = mysqli_real_escape_string($database, $_POST['shopName']);
			$shopDescription = mysqli_real_escape_string($database, $_POST['shopDescription']);
			$microsms_userid = mysqli_real_escape_string($database, $_POST['microsms_userid']);
			$microsms_serviceid = mysqli_real_escape_string($database, $_POST['microsms_serviceid']);
			
			$database->query("UPDATE `shop_settings` SET shop_name='$shopName', shop_description='$shopDescription', microsms_userid='$microsms_userid', microsms_serviceid='$microsms_serviceid'");
			
			$info = '<div class="alert alert-success" role="alert">Ustawienia sklepu zostały zaktualizowane poprawnie!</div>';
		} else {
			$info = '<div class="alert alert-danger" role="alert">UserID i ServiceID musi być w postani cyfer!</div>';
		}
	} else {
		$info = '<div class="alert alert-danger" role="alert">Musisz wypełnić wszystkie pola, aby dokonać zapisu!</div>';
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
					<li><a href="add_server.php"><i class="glyphicon glyphicon-hdd"></i> Dodaj serwer</a></li>
					<li><a href="edit_server.php"><i class="glyphicon glyphicon-pushpin"></i> Edytuj serwer</a></li>
					<li class="active"><a href="shop_settings.php"><i class="glyphicon glyphicon-cog"></i> Ustawienia sklepu</a></li>
				</ul>
			</div>
		</div>
	</div>
	
	<div class="col-md-8">
		<div class="panel panel-default">
			<div class="panel-body">
				<div class="page-header">
					<h3>
						Ustawienia sklepu
						<small>Wypełnij wszystkie pola poprawnie!</small>
					</h3>
				</div>
				
				<?php 
				
				echo $info; 
				
				$shop_settings = $database->query("SELECT * FROM `shop_settings`");
				$shop = $shop_settings->fetch_assoc();
				
				?>
				<form method="post">
					<div class="form-group">
						<label for="shopName">Nazwa sklepu</label>
						<input type="text" name="shopName" class="form-control" value="<?php echo $shop['shop_name']; ?>"/>
					</div>
					
					<div class="form-group">
						<label for="shopDescription">Opis sklepu</label>
						<input type="text" name="shopDescription" class="form-control"  value="<?php echo $shop['shop_description']; ?>"/>
					</div>
					
					<div class="form-group">
						<label for="microsms_userid">UserID <small>(id użytkownika MicroSMS)</small></label>
						<input type="text" name="microsms_userid" class="form-control"  value="<?php echo $shop['microsms_userid']; ?>"/>
					</div>
					
					<div class="form-group">
						<label for="microsms_serviceid">ServiceID <small>(id usługi MicroSMS)</small></label>
						<input type="text" name="microsms_serviceid" class="form-control" value="<?php echo $shop['microsms_serviceid']; ?>"/>
					</div>
					
					<div class="form-group text-center">
						<input type="submit" name="save_button" class="btn btn-success" value="Zapisz"/>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
</body>
</html>