<?php
session_start();
include_once('header_admin.php');

$info = '';
if(isset($_POST['login_button'])) {
	if((!empty($_POST['adminLogin'])) && (!empty($_POST['adminPassword']))) {
		$login = $_POST['adminLogin'];
		$password = $_POST['adminPassword'];
		
		$admin = $database->query("SELECT * FROM `admin_accounts` WHERE admin_login='$login' AND admin_password='$password'");
		
		if($admin->num_rows == 1) {
			$_SESSION['adminUser'] = $login;
			header("Location: dashboard.php");
		} else {
			$info = '<div class="alert alert-danger" role="alert">Podany administrator nie istnieje!</div>';
		}
	} else {
		$info = '<div class="alert alert-danger" role="alert">Musisz wypełnić wszystkie pola!</div>';
	}
}
?>
<div class="container">
	<div class="row">
		<div class="col-md-4 col-md-offset-4">
			<div class="panel panel-default">
				<div class="panel-body">
					<?php echo $info; ?>
					<form method="post">
						<div class="form-group">
							<label for="adminLogin">Login administratora</label>
							<input type="text" class="form-control" name="adminLogin"/>
						</div>
						
						<div class="form-group">
							<label for="adminPassword">Hasło administratora</label>
							<input type="password" class="form-control" name="adminPassword"/>
						</div>
						
						<div class="form-group text-center">
							<input type="submit" class="btn btn-success" name="login_button" value="Zaloguj sie"/>
						</div>
					</form>
					</div>
				</div>
		</div>
	</div>
</div>
</body>
</html>
