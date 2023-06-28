<?php
include 'ligar_db.php';  //CONNECT TO THE DATABASE

if (isset($_POST['login'])) {
	$email = htmlspecialchars(mysqli_real_escape_string($link, $_POST['email']));
	$password = htmlspecialchars(mysqli_real_escape_string($link, $_POST['password']));

	if (!empty($email) && !empty($password)) {
		$query = mysqli_query($link, "SELECT * FROM users WHERE email = '$email'");
		$info = mysqli_fetch_assoc($query);
		$pass_db = $info['password'];

		if (mysqli_num_rows($query) > 0 && password_verify($password, $pass_db)) {
			//GET INFO FROM THE USER AFTER LOGIN
			$nome = $info['nome'];
			$apelido = $info['apelido'];
			$idade = $info['idade'];
			$_SESSION['user'] = array($nome, $apelido, $idade, $email);
			header('Location: home.php');
			exit(0);
		} else {
			echo "Invalid Email/Password...";
		}
	} else {
		echo "Fill all the forms...";
	}
}
?>

<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<style>
		body {
			background-color: #abd9e9;
		}
		.jumbotron {
			text-align: center;
		}
	</style>
</head>
<body>
	<div class="container">
		<div class="jumbotron">
			<h1 class="display-4">GPT Advanced Assistant</h1>
			<p class="lead">Welcome to your best asssintant, that will help you out in long conversations.</p>
			<hr class="my-4">
			<h1 class="display-4">Login</h1>
			<form style="width: 40%; margin: 0 auto;" method="POST">
				<div class="form-group">
					<input name="email" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Email" required>
				</div>
				<div class="form-group">
					<input name="password" type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" required>
				</div>
				<button name="login" type="submit" class="btn btn-primary btn-lg" style="width: 100%;">Submit</button>
				<a href="register.php">Register</a>
			</form>
		</div>
	</div>
</body>
</html>