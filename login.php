<?php
session_start();
if (isset($_SESSION['level'])) {
}
require 'functions/config.php';

if (isset($_POST['login'])) {
	$user = $_POST['username'];
	$pass = $_POST['password'];

	// cek username
	$sql = mysqli_query($conn, "SELECT * FROM users WHERE username = '$user'");
	if (mysqli_num_rows($sql) === 1) {
		$row = mysqli_fetch_array($sql);
		// cek password
		if (password_verify($pass, $row['password'])) {
			$_SESSION['level'] = $row['level'];
			header("Location: dashboard.php");
			exit;
		} else {
			$error = true;
			$message = "Password Salah!";
		}
	} else {
		$error = true;
		$message = "Username Salah!";
	}
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<title>Login Admin</title>
	<link rel="icon" type="image/png" href="assets/img/favicon.ico">
	<link href="assets/css/bootstrap.min.css" rel="stylesheet" />
	<style type="text/css">
		body {
			background: rgb(28, 36, 0);
		}
		form{
			min-height: 80vh;
			display: flex;
			flex-direction: column;
			justify-content: center;
			align-items: center;
		}

		.kotak {
			padding: 10px 30px;
			background: rgb(28, 36, 0);
			background: linear-gradient(127deg, rgba(28, 36, 0, 1) 0%, rgba(71, 121, 9, 1) 31%, rgba(93, 137, 8, 1) 48%, rgba(149, 188, 16, 1) 75%, rgba(249, 255, 0, 1) 100%);
			color: #fff;
			border: 2px solid rgba(255, 255, 255, 0.5);
			border-radius: 10px;
			box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
		}

		.kotak .input-group {
			margin-bottom: 20px;
		}
	</style>
</head>

<body>
	<div class="container-fluid">
		<h1 class="text-center " style="color: white">SISTEM INFORMASI APOTEK</h1>
		<form action="" method="post">
			<div class="col-md-3 kotak">
				<h3 class="text-center">Login</h3>
				<?php if (isset($error)) : ?>
					<p style="color: red;font-style: italic; float: right">Username / Password Salah!</p>
					<p style="color: red;font-style: italic; float: right"><?php echo $message ?></p>
				<?php endif; ?>
				<div class="form-group">
					<input type="text" name="username" class="form-control" value="admin" placeholder="Username" autocomplete="off" autofocus />
				</div>
				<div class="form-group">
					<input type="password" class="form-control" value="admin" placeholder="Password" name="password" autocomplete="off" />
				</div>
				<div class="form-group">
					<input type="submit" name="login" class="btn btn-primary form-control" value="Login">
				</div>
				<br>
				<center>
					<p>belum punya akun? <a href="register.php">register</a></p>
				</center>
			</div>
		</form>
	</div>
</body>

</html>