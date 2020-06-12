<?php 
require_once "../config/koneksi.php";

if(isset($_SESSION['user'])) {
	echo "<script>window.location='". base_url() ."';</script>";
} else {

?>
<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="author" content="">

<title>Login Page | Rumah Sakit</title>

<!-- Bootstrap Core CSS -->
<link href="<?= base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet">

<!-- Custom CSS -->
<link rel="stylesheet" href="<?= base_url(); ?>assets/css/style.css">


</head>

<body>



<div class="container">
<div class="row">
<div class="col-md-12 text-center">
<div class="login">
	<form action="" method="post" class="navbar-form">
<?php
if(isset($_POST['login'])) {
	$user = trim(mysqli_real_escape_string($conn, $_POST['user']));
	$pass = sha1(trim(mysqli_real_escape_string($conn, $_POST['pass'])));
	// echo $pass;

	$sql_login = mysqli_query($conn, "SELECT * FROM tb_user WHERE username = '$user' AND password = '$pass'") or die(mysqli_error($conn));
	if(mysqli_num_rows($sql_login) > 0) {
		$_SESSION['user'] = $user;
		echo "<script>window.location='". base_url() ."';</script>";
	} else { ?>
		<div class="row">
			<div class="col-lg-6-offset-3">
				<div class="alert alert-danger alert-dismissable" role="alert">
					<a href="" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
					<strong>Login Gagal!</strong> Username / Password Salah!
				</div>
			</div>
		</div>
	<?php
	}


}

?>
		<div class="input-group">
			<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
			<input type="text" name="user" class="form-control" required="" placeholder="Masukan username" autofocus="on">
		</div>
		<div class="input-group">
			<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
			<input type="password" name="pass" class="form-control" required="" placeholder="Masukan password">
		</div>
		<div class="input-group">
			<button type="submit" name="login" class="btn btn-primary">Login</button>
		</div>
	</form>
</div>	
</div>
</div>
</div>



<script src="<?= base_url(); ?>assets/js/jquery.js"></script>
<script src="<?= base_url(); ?>assets/js/bootstrap.min.js"></script>

</body>

</html>
<?php 
}

?>