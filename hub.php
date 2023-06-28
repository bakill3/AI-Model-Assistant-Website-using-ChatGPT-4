<?php
include 'ligar_db.php';  //CONNECT TO THE DATABASE
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
			<h1 class="display-4">GPT Advanced Assitant</h1>
			<p class="lead">Welcome to your best asssintant, that will help you out in long conversations.</p>
			<hr class="my-4">
			<h1 class="display-4">Login</h1>
			<form style="width: 40%; margin: 0 auto;">
				<div class="form-group">
					<input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Email">
				</div>
				<div class="form-group">
					<input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
				</div>
				<button type="submit" class="btn btn-primary btn-lg" style="width: 100%;">Submit</button>
			</form>
		</div>
	</div>
</body>
</html>