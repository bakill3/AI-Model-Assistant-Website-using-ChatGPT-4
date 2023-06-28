<?php
include 'ligar_db.php';  //CONNECT TO THE DATABASE

if (isset($_POST['registar'])) {
	$nome = htmlspecialchars(mysqli_real_escape_string($link, $_POST['nome']));
	$apelido = htmlspecialchars(mysqli_real_escape_string($link, $_POST['apelido']));
	$idade = htmlspecialchars(mysqli_real_escape_string($link, $_POST['idade']));
	$email = htmlspecialchars(mysqli_real_escape_string($link, $_POST['email']));
	$password = htmlspecialchars(mysqli_real_escape_string($link, $_POST['password']));

	if (!empty($nome) && !empty($apelido) && !empty($idade) && !empty($email) && !empty($password)) { 
		$query = mysqli_query($link, "SELECT * FROM users WHERE email = '$email'");
		if (mysqli_num_rows($query) == 0 && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$password_encrypted = password_hash($password , PASSWORD_DEFAULT); //4later = password_verify($password, $pass_db)
			mysqli_query($link, "INSERT INTO users(nome, apelido, idade, email, password) VALUES('$nome', '$apelido', '$idade', '$email', '$password_encrypted')") or die(mysqli_error($link));

			echo "Login sucessfull";
			$_SESSION['user'] = array($nome, $apelido, $idade, $email);
			header('Location: home.php');
			exit(0);
		} else {
			echo "Error, email already exists...";
		}
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
			<h1 class="display-4">Register</h1>
			<form style="width: 40%; margin: 0 auto;" method="POST">
				<div class="form-group">
					<input type="text" name="nome" class="form-control" placeholder="Name" required>
				</div>
				<div class="form-group">
					<input type="text" name="apelido" class="form-control" placeholder="Surname" required>
				</div>
				<div class="form-group">
					<input type="number" name="idade" class="form-control" placeholder="Age" required>
				</div>
				<div class="form-group">
					<input type="email" name="email" class="form-control" placeholder="Email" required>
				</div>
				<div class="form-group">
					<input type="password" name="password" class="form-control" placeholder="Password" required>
				</div>
				<button type="submit" name="registar" class="btn btn-primary btn-lg" style="width: 100%;">Submit</button>
				<a href="login.php">Login</a>
			</form>
		</div>
	</div>
</body>
</html>