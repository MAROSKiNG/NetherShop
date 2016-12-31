<?php

session_start();

include_once('header_page.php');



if(empty($_SESSION['adminUser'])) {

	header("Location: ../index.php");

	session_destroy();

}



$info = '';



if(isset($_POST['add_button'])) {

	if((!empty($_POST['productName'])) && (!empty($_POST['productDescription'])) && (!empty($_POST['productSmsContent'])) && (!empty($_POST['productPrice'])) && (!empty($_POST['productCommands'])) && (!empty($_POST['productForServer']))) {

		$productName = mysqli_real_escape_string($database, $_POST['productName']);

		$productDescription = mysqli_real_escape_string($database, $_POST['productDescription']);

		$productSmsContent = mysqli_real_escape_string($database, $_POST['productSmsContent']);

		$productPrice = mysqli_real_escape_string($database, $_POST['productPrice']);

		$productCommands = mysqli_real_escape_string($database, $_POST['productCommands']);

		$productForServer = mysqli_real_escape_string($database, $_POST['productForServer']);

		

		$productImage = "../../img/products/";

		$productImage = $productImage . basename($_FILES['productImages']['name']); 

		

		$sms_price = $_POST['productPrice'];

		

		$srv = $database->query("SELECT * FROM `servers_list` WHERE id={$_POST['productForServer']}");

		$s = $srv->fetch_assoc();

		

		switch($sms_price) {

			case "1": 

				$database->query("INSERT INTO `products_shop` (name, description, sms_price, sms_content, sms_number, image, commands, server_id) VALUES ('$productName', '$productDescription', '0.62', '$productSmsContent', '7055', '$productImage', '$productCommands', '".$s['id']."')");

					

				move_uploaded_file($_FILES['productImages']['tmp_name'], $productImage);

					

				$info = '<div class="alert alert-success" role="alert">Usługa została dodana poprawnie!</div>';

				break;

			case "2": 

				$database->query("INSERT INTO `products_shop` (name, description, sms_price, sms_content, sms_number, image, commands, server_id) VALUES ('$productName', '$productDescription', '1.23', '$productSmsContent', '7136', '$productImage', '$productCommands', '".$s['id']."')");

					

				move_uploaded_file($_FILES['productImages']['tmp_name'], $productImage);

					

				$info = '<div class="alert alert-success" role="alert">Usługa została dodana poprawnie!</div>';

				break;

			case "3": 

				$database->query("INSERT INTO `products_shop` (name, description, sms_price, sms_content, sms_number, image, commands, server_id) VALUES ('$productName', '$productDescription', '2.46', '$productSmsContent', '7255', '$productImage', '$productCommands', '".$s['id']."')");

					

				move_uploaded_file($_FILES['productImages']['tmp_name'], $productImage);

					

				$info = '<div class="alert alert-success" role="alert">Usługa została dodana poprawnie!</div>';

				break;

			case "4": 

				$database->query("INSERT INTO `products_shop` (name, description, sms_price, sms_content, sms_number, image, commands, server_id) VALUES ('$productName', '$productDescription', '3.69', '$productSmsContent', '7355', '$productImage', '$productCommands', '".$s['id']."')");

					

				move_uploaded_file($_FILES['productImages']['tmp_name'], $productImage);

					

				$info = '<div class="alert alert-success" role="alert">Usługa została dodana poprawnie!</div>';

				break;

			case "5": 

				$database->query("INSERT INTO `products_shop` (name, description, sms_price, sms_content, sms_number, image, commands, server_id) VALUES ('$productName', '$productDescription', '4.92', '$productSmsContent', '7455', '$productImage', '$productCommands', '".$s['id']."')");

					

				move_uploaded_file($_FILES['productImages']['tmp_name'], $productImage);

					

				$info = '<div class="alert alert-success" role="alert">Usługa została dodana poprawnie!</div>';

				break;

			case "6": 

				$database->query("INSERT INTO `products_shop` (name, description, sms_price, sms_content, sms_number, image, commands, server_id) VALUES ('$productName', '$productDescription', '6.15', '$productSmsContent', '7555', '$productImage', '$productCommands', '".$s['id']."')");

					

				move_uploaded_file($_FILES['productImages']['tmp_name'], $productImage);

					

				$info = '<div class="alert alert-success" role="alert">Usługa została dodana poprawnie!</div>';

				break;

			case "7": 

				$database->query("INSERT INTO `products_shop` (name, description, sms_price, sms_content, sms_number, image, commands, server_id) VALUES ('$productName', '$productDescription', '7.38', '$productSmsContent', '7636', '$productImage', '$productCommands', '".$s['id']."')");

					

				move_uploaded_file($_FILES['productImages']['tmp_name'], $productImage);

					

				$info = '<div class="alert alert-success" role="alert">Usługa została dodana poprawnie!</div>';

				break;

			case "8": 

				$database->query("INSERT INTO `products_shop` (name, description, sms_price, sms_content, sms_number, image, commands, server_id) VALUES ('$productName', '$productDescription', '8.61', '$productSmsContent', '77464', '$productImage', '$productCommands', '".$s['id']."')");

					

				move_uploaded_file($_FILES['productImages']['tmp_name'], $productImage);

					

				$info = '<div class="alert alert-success" role="alert">Usługa została dodana poprawnie!</div>';

				break;

			case "9": 

				$database->query("INSERT INTO `products_shop` (name, description, sms_price, sms_content, sms_number, image, commands, server_id) VALUES ('$productName', '$productDescription', '9.84', '$productSmsContent', '78464', '$productImage', '$productCommands', '".$s['id']."')");

					

				move_uploaded_file($_FILES['productImages']['tmp_name'], $productImage);

					

				$info = '<div class="alert alert-success" role="alert">Usługa została dodana poprawnie!</div>';

				break;

			case "10": 

				$database->query("INSERT INTO `products_shop` (name, description, sms_price, sms_content, sms_number, image, commands, server_id) VALUES ('$productName', '$productDescription', '11.07', '$productSmsContent', '7936', '$productImage', '$productCommands', '".$s['id']."')");

					

				move_uploaded_file($_FILES['productImages']['tmp_name'], $productImage);

					

				$info = '<div class="alert alert-success" role="alert">Usługa została dodana poprawnie!</div>';

				break;

			case "11": 

				$database->query("INSERT INTO `products_shop` (name, description, sms_price, sms_content, sms_number, image, commands, server_id) VALUES ('$productName', '$productDescription', '12.30', '$productSmsContent', '91055', '$productImage', '$productCommands', '".$s['id']."')");

					

				move_uploaded_file($_FILES['productImages']['tmp_name'], $productImage);

					

				$info = '<div class="alert alert-success" role="alert">Usługa została dodana poprawnie!</div>';

				break;

			case "12": 

				$database->query("INSERT INTO `products_shop` (name, description, sms_price, sms_content, sms_number, image, commands, server_id) VALUES ('$productName', '$productDescription', '13.53', '$productSmsContent', '91155', '$productImage', '$productCommands', '".$s['id']."')");

					

				move_uploaded_file($_FILES['productImages']['tmp_name'], $productImage);

					

				$info = '<div class="alert alert-success" role="alert">Usługa została dodana poprawnie!</div>';

				break;

			case "13": 

				$database->query("INSERT INTO `products_shop` (name, description, sms_price, sms_content, sms_number, image, commands, server_id) VALUES ('$productName', '$productDescription', '17.22', '$productSmsContent', '91455', '$productImage', '$productCommands', '".$s['id']."')");

					

				move_uploaded_file($_FILES['productImages']['tmp_name'], $productImage);

					

				$info = '<div class="alert alert-success" role="alert">Usługa została dodana poprawnie!</div>';

				break;

			case "14": 

				$database->query("INSERT INTO `products_shop` (name, description, sms_price, sms_content, sms_number, image, commands, server_id) VALUES ('$productName', '$productDescription', '19.68', '$productSmsContent', '91664', '$productImage', '$productCommands', '".$s['id']."')");

					

				move_uploaded_file($_FILES['productImages']['tmp_name'], $productImage);

					

				$info = '<div class="alert alert-success" role="alert">Usługa została dodana poprawnie!</div>';

				break;

			case "15": 

				$database->query("INSERT INTO `products_shop` (name, description, sms_price, sms_content, sms_number, image, commands, server_id) VALUES ('$productName', '$productDescription', '23.37', '$productSmsContent', '91955', '$productImage', '$productCommands', '".$s['id']."')");

					

				move_uploaded_file($_FILES['productImages']['tmp_name'], $productImage);

					

				$info = '<div class="alert alert-success" role="alert">Usługa została dodana poprawnie!</div>';

				break;

			case "16": 

				$database->query("INSERT INTO `products_shop` (name, description, sms_price, sms_content, sms_number, image, commands, server_id) VALUES ('$productName', '$productDescription', '24.60', '$productSmsContent', '92055', '$productImage', '$productCommands', '".$s['id']."')");

					

				move_uploaded_file($_FILES['productImages']['tmp_name'], $productImage);

					

				$info = '<div class="alert alert-success" role="alert">Usługa została dodana poprawnie!</div>';

				break;

			case "17": 

				$database->query("INSERT INTO `products_shop` (name, description, sms_price, sms_content, sms_number, image, commands, server_id) VALUES ('$productName', '$productDescription', '30.75', '$productSmsContent', '92555', '$productImage', '$productCommands', '".$s['id']."')");

					

				move_uploaded_file($_FILES['productImages']['tmp_name'], $productImage);

					

				$info = '<div class="alert alert-success" role="alert">Usługa została dodana poprawnie!</div>';

				break;

		}

	} else {

		$info = '<div class="alert alert-danger" role="alert">Muisz wypełnić wszystkie pola!</div>';

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

					<li class="active"><a href="add_product.php"><i class="glyphicon glyphicon-plus"></i> Dodaj usługę</a></li>

					<li><a href="edit_product.php"><i class="glyphicon glyphicon-pencil"></i> Edytuj usługę</a></li>

					<li><a href="add_server.php"><i class="glyphicon glyphicon-hdd"></i> Dodaj serwer</a></li>
					
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

						Dodowanie nowej usługi 

						<small>Wypełnij wszystkie pola poprawnie!</small>

					</h3>

				</div>

				

				<?php echo $info; ?>

				<form method="post" enctype="multipart/form-data">

					<div class="form-group">

						<label for="productName">Nazwa produktu</label>

						<input type="text" name="productName" class="form-control"/>

					</div>

					

					<div class="form-group">

						<label for="productDescription">Opis produktu</label>

						<textarea name="productDescription" class="form-control"></textarea>

					</div>

					

					<div class="form-group">

						<label for="productSmsContent">Treść SMS'a</label>

						<input type="text" class="form-control" name="productSmsContent"/>

					</div>

					

					<div class="form-group">

						<label for="productPrice">Numer SMS</label>

						<select name="productPrice" class="form-control">

							<option value="1">7055 - 0.5zł (0.62 z VAT)</option>

							<option value="2">7136 - 1zł (1.23 z VAT)</option>

							<option value="3">7255 - 2zł (2.46 z VAT)</option>

							<option value="4">7355 - 3zł (3.69 z VAT)</option>

							<option value="5">7455 - 4zł (4.92 z VAT)</option>

							<option value="6">7555 - 5zł (6.15 z VAT)</option>

							<option value="7">7636 - 6zł (7.38 z VAT)</option>

							<option value="8">77464 - 7zł (8.61 z VAT)</option>

							<option value="9">77464 - 7zł (8.61 z VAT)</option>

							<option value="10">78464 - 8zł (9.84 z VAT)</option>

							<option value="11">7936 - 9zł (11.07 z VAT)</option>

							<option value="12">91055 - 10zł (12.30 z VAT)</option>

							<option value="13">91155 - 11zł (13.53 z VAT)</option>

							<option value="14">91455 - 14zł (17.22 z VAT)</option>

							<option value="15">91664 - 16zł (19.68 z VAT)</option>

							<option value="16">91955 - 19zł (23.37 z VAT)</option>

							<option value="17">92055 - 20zł (24.60 z VAT)</option>

							<option value="18">92555 - 25zł (30.75 z VAT)</option>

						</select>

					</div>

					

					<div class="form-group">

						<label for="productImages">Obraz produktu</label>

						<input type="file" name="productImages" class="btn btn-primary"/>

					</div>

					

					<div class="form-group">

						<label for="productCommands">Komendy <small>Wpisz komendy jakie mają wykonać się po kupnie usługi</small></label>

						<input type="text" name="productCommands" class="form-control"/>

						<p class="text-danger">

							<b>Pamiętaj</b>, aby każdą kolejną komende oddzielić średnikiem (<b>;</b>)!<br/>
						<p>Zmienna {GRACZA} umożliwia użycie nicku gracza (np. say Gracza {GRACZ} zakupił VIP)</p>

						</p>

					</div>

					

					<div class="form-group">

						<label for="productForServer">Serwer <small>Wybierz serwer dla którego ma być przypisana usługa.</small></label>

						<select class="form-control" name="productForServer">

							<?php

							

							$servers = $database->query("SELECT * FROM `servers_list`");

							

							if($servers->num_rows > 0) {

								while($s = $servers->fetch_assoc()) {

									echo ('

									<option value="'.$s['id'].'">'.$s['name'].'</option>

									');

								}

							} else {

								echo ("<option>Brak serwerów, dla których możesz przypisać tą usługę!</option>");

							}

							?>

						</select>

					</div>

					

					<div class="form-group text-center">

						<input type="submit" name="add_button" value="Dodaj usługę" class="btn btn-success"/>

					</div>

					

				</form>

			</div>

		</div>

	</div>

</div>

</body>

</html>
