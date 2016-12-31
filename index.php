<?php
include_once ('header.php');
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
		<div class="col-lg-8">
			<div class="row">
				<?php
				
				$servers = $database->query("SELECT * FROM `servers_list`");
				
				if($servers->num_rows > 0) {
					while($s = $servers->fetch_assoc()) {
						echo ('
						<div class="col-sm-6 col-md-4">
							<div class="thumbnail">
								<img width="250" height="150" class="text-center" src="'.$s['image'].'" alt="'.$s['name'].'">
								<div class="caption text-center">
									<h4>'.$s['name'].'</h4>
									<p><a href="buy.php?server_id='.$s['id'].'" class="btn btn-success">Zakup</a></p>
								</div>
							</div>
						</div>
						');
					}
				} else {
					echo ('
						<div class="alert alert-danger" role="alert">W sklepie nie ma żadnych serwerów!</div>
					');
				}
				?>
			</div>
		</div>
		
		<div class="col-lg-4">
			<div class="panel panel-default">
				<div class="panel-heading">
					<i class="glyphicon glyphicon-signal"></i> Status serwerów
				</div>
				
				<div class="panel-body">
					<?php
						$servers = $database->query("SELECT * FROM `servers_list`");
			
						if($servers->num_rows > 0) {
							while($s = $servers->fetch_assoc()) {
								$server = new MCServerStatus($s['server_ip'], $s['server_port']);
								
								if($server->online) {
									echo ('
									<p>
										<h5>
											<span class="label label-success"><i class="glyphicon glyphicon-ok"></i> '.$s['name'].'</span>
										</h5>
										
										<div class="progress">
											<div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: '.$server->online_players.'%;">
											'.$server->online_players.'
										  </div>
										</div>
									</p>
									');
								} else {
									echo ('
										<h5><span class="label label-danger"><i class="glyphicon glyphicon-remove"></i> '.$s['name'].' aktulanie nie działa!</span></h5>
									');
								}
							}
						} else {
							echo ('
								<div class="alert alert-danger" role="alert">W sklepie nie ma żadnych serwerów!</div>
							');
						}
					?>
				</div>
			</div>
			
			<div class="panel panel-default">
				<div class="panel-heading">
					<i class="glyphicon glyphicon-shopping-cart"></i> Ostatni kupujący
				</div>
				
				<div class="panel-body">
					<?php
					
					$last_buyer = $database->query("SELECT * FROM `last_buyer`");
					
					if($last_buyer->num_rows > 0) {
						while($lb = $last_buyer->fetch_assoc()) {
							$srv = $lb['server_id'];
							$prd = $lb['product_id'];
							
							$server = $database->query("SELECT * FROM `servers_list` WHERE id=$srv");
							$s = $server->fetch_assoc();
							
							$product = $database->query("SELECT * FROM `products_shop` WHERE id=$prd");
							$p = $product->fetch_assoc();
							
							echo ('
							<img src="https://minotar.net/avatar/'.$lb['nick'].'/24" data-toggle="tooltip" title="Gracz <b>'.$lb['nick'].'</b><br/>Serwer <b>'.$s['name'].'</b><br/>Produkt <b>'.$p['name'].'</b><br/>Data <b>'.$lb['date'].'</b>">
							');
						}
					} else {
						echo ('
						<div class="alert alert-danger" role="alert">Ostatnio nikt nie dokonał zakupu!</div>
						');
					}
					?>
				</div>
			</div>
		</div>
	</div>
	
	<footer><hr>
		<p>&copy; <a href="#">NetherShop</a> 2016</p>
    </footer>
</div>

<script>
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip({html: true}); 
});
</script>
</body>
</html>