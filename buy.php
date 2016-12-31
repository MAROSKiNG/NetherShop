<?php
include_once ('header.php');

$srv_id = $_GET['server_id'];
$info = '';

if(isset($_POST['buy_button'])) {
	if((!empty($_POST['nick'])) && (!empty($_POST['code']))) {
		$code = addslashes($_POST['code']);
		
		$id = $_POST['id'];
			
		$products = $database->query("SELECT * FROM `products_shop` WHERE id=$id AND server_id=$srv_id");
		$p = $products->fetch_assoc();
			
		if (preg_match("/^[A-Za-z0-9]{8}$/", $code)) {

			$microsms = $database->query("SELECT microsms_userid, microsms_serviceid FROM `shop_settings`");
			$msms = $microsms->fetch_assoc();
			
			$api = @file_get_contents("http://microsms.pl/api/v2/index.php?userid=".$msms['microsms_userid']."&number=" . $p['sms_number'] . "&code=" . $code . '&serviceid='.$msms['microsms_serviceid'].'');
			
			if (!isset($api)) {
				$info = '<div class="alert alert-danger" role="alert">Nie można nawiązać połączenia z serwerem płatności.</div>';
			} else {
				$api = json_decode($api);
				
				if (!is_object($api)) {
					$info = '<div class="alert alert-danger" role="alert">Nie można odczytać informacji o płatności.</div>';
				}

				if (isset($api->error) && $api->error) {
					$info = '<div class="alert alert-danger" role="alert">Nie można odczytać informacji o płatności.</div>';
				} else if ($api->connect == FALSE) {
					$info = '<div class="alert alert-danger" role="alert">Nie można odczytać informacji o płatności.</div>';
				}
			}
			
			if (isset($api->connect) && $api->connect == TRUE) {
				if ($api->data->status == 1) {
					$info = '<div class="alert alert-success" role="alert">Usługa została poprawnie zakupiona! Dziękujemy za wsparcie naszego serwera!</div>';
					
					$database->query("INSERT INTO `last_buyer` (nick, product_id, server_id, date) VALUES ({$_POST['nick']}, ".$p['id'].", $srv_id, NOW())");
					
					$srv_rcon = $database->query("SELECT * FROM `servers_list` WHERE id=$srv_id");
					$srv = $srv_rcon->fetch_assoc();
					
					$commands = explode(';', $p['commands']);
					
					$rcon = new Rcon($srv['server_ip'], $srv['rcon_port'], $srv['rcon_password'], 3);
					
					if($rcon->connect()) {
						foreach($commands as $com) {
							$com = str_replace('{GRACZ}', $_POST['nick'], $com);
							$rcon->send_command($com);
						}
					} else {
						$info = '<div class="alert alert-danger" role="alert">Serwer nie odpowiada! Spróbuj ponownie.</div>';
					}
				} else {
					$info = '<div class="alert alert-danger" role="alert">Przesłany kod jest nieprawidłowy, spróbuj ponownie.</div>';
				}
			}
		} else {
			$info = '<div class="alert alert-danger" role="alert">Przesłany kod jest nieprawidłowy, spróbuj ponownie.</div>';
		}
	} else {
		$info = '<div class="alert alert-danger" role="alert">Muisz wypełnić wszystkie pola, aby dokonać zakupu!</div>';
	}
}
?>

<style>
body { 
	padding-top: 70px; 
}
</style>

<div class="container">
	
	<nav class="navbar navbar-default">
		<div class="container">
			<div class="navbar-header">
				<a class="navbar-brand" href="index.php">NetherShop</a>
			</div>
			
			<div class="collapse navbar-collapse" id="navbar">
				<ul class="nav navbar-nav">
					<li><a href="#"><i class="glyphicon glyphicon-thumbs-up"></i> Jak zagrać?</a></li>
					<li><a href="#"><i class="glyphicon glyphicon-user"></i> Administracja</a></li>
					<li><a href="#"><i class="glyphicon glyphicon-comment"></i> Forum</a></li>
				</ul>

			</div>
		</div>
	</nav>
	
	<div class="row">
		<div class="col-lg-12">
			<?php
					
			$servers = $database->query("SELECT * FROM `servers_list` WHERE id=$srv_id");
			$s = $servers->fetch_assoc();
					
			?>
					
			<ol class="breadcrumb">
				<li><a href="index.php">Sklep</a></li>
				<li><a href="buy.php?server_id=<?php echo $s['id']; ?>"><?php echo $s['name']; ?></a></li>
			</ol>
		
			<?php echo $info; ?>
			
			<div class="row">
				
				<?php
				
				$products = $database->query("SELECT * FROM `products_shop` WHERE server_id=$srv_id");
				
				if($products->num_rows > 0) {
					while($p = $products->fetch_assoc()) {
						echo ('
						
						<div class="col-sm-3 col-md-2">
							<div class="thumbnail">
								<img width="150" height="100" class="text-center" src="'.$p['image'].'" alt="'.$p['name'].'">
								<div class="caption text-center">
									<h4>'.$p['name'].'</h4>
									<p><a href="#" data-toggle="modal" data-target="#'.$p['id'].'" class="btn btn-success">Zakup</a></p>
								</div>
							</div>
						</div>
						
						<div class="modal fade" id="'.$p['id'].'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
							<div class="modal-dialog" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
										</button>
										
										<h4 class="modal-title" id="myModalLabel">Kupujesz usługę: '.$p['name'].'</h4>
									</div>
									
									<div class="modal-body">
										<div class="text-center">
											<img src="'.$p['image'].'" alt="'.$p['name'].'"><hr>
											<h4><b>'.$p['name'].'</b></h4>
											<p>'.$p['description'].'</p><hr>
											
											Aby zakupić <span class="label label-success">'.$p['name'].'</span> wyślij SMS o treści <span class="label label-success">'.$p['sms_content'].'</span> pod numer <span class="label label-success">'.$p['sms_number'].'</span><br/><br/>
										</div>
										
										<div class="row">
											<div class="col-md-6 col-md-offset-3">
												<form method="post">
													<div class="form-group">
														<label for="nick">Nick</label>
														<input type="text" name="nick" class="form-control"/>
													</div>
													
													<div class="form-group">
														<label for="code">Kod SMS</label>
														<input type="text" name="code" class="form-control"/>
														<input type="hidden" name="id" value="'.$p['id'].'" />
													</div>
													
													<div class="form-group text-center">
														<input type="submit" name="buy_button" class="btn btn-success" value="Zakup"/>
													</div>
												</form><hr>
											</div>
										</div>
										
										<div class="text-center">
											Płatności zapewnia firma <a href="http://microsms.pl/">MicroSMS</a>. <br/>
											Korzystanie z serwisu jest jednozanczne z akceptacją <a href="http://microsms.pl/partner/documents/">regulaminów</a>.<br/>
											Jeśli nie dostałeś kodu zwrotnego w ciągu 30 minut skorzystaj z <a href="http://microsms.pl/customer/complaint/">formularza reklamacyjnego</a><br/><br/>
											<img style="width: 100%;" src="http://microsms.pl/public/cms/img/banner.png">
										</div>
									</div>
								</div>
							</div>
						</div>
						');
					}
				?>
			</div>
		</div>
	</div>
	
	<?php
	} else {
		echo ('
		<div class="container">
			<div class="alert alert-danger" role="alert">W sklepie nie ma żadnych produktów przypisanych dla tego serwera!</div>
		</div>
		');
	}
	?>
</div>
</body>
</html>