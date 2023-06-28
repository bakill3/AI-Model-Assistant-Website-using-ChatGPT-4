<?php 
include 'ligar_db.php';

check_login();
?>

<!DOCTYPE html>
<html>
<head>
  <title>São 9€</title>
  <link rel="stylesheet" type="text/css" href="styles.css">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <style>
    body {
      background-color: #abd9e9;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Roboto', sans-serif;
    }

    .container {
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      width: 90%;
      height: 90vh;
    }

    .card {
      background-size: cover;
      background-position: center;
      margin: 5px 2px;
      width: calc(25% - 10px);
      height: 95%;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      transition: all 0.5s ease;
      overflow: hidden;
      position: relative;
      box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
      border-radius: 10px;
    }

    #card1 {
      background-image: url('psicologo.jpg');
    }

    #card2 {
      background-image: url('programmer.jpg');
    }

    #card3 {
      background-image: url('jarvis.png');
    }

    #card4 {
      background-image: url('buddy.jpg');
    }

    .card::before {
      content: "";
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-image: inherit;
      background-size: cover;
      background-position: center;
      transition: transform 0.5s ease;
      transform: scale(1);
      z-index: -2;
      border-radius: 10px;
    }

    .card::after {
      content: "";
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: rgba(0, 0, 0, 0);
      transition: background 0.5s ease;
      z-index: -1;
    }

    .card:hover::before {
      transform: scale(1.1);
    }

    .card:hover::after {
      background: rgba(0, 0, 0, 0.5);
    }

    .card:hover {
      z-index: 1;
      box-shadow: 0 5px 15px rgba(0, 0, 0, 0.5);
      cursor: pointer;
    }

    .card.reverse::before {
      transform: scale(1);
    }

    .card.reverse::after {
      background: rgba(0, 0, 0, 0);
    }

    .card.reverse {
      z-index: 0;
      box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
    }


    .title,
    .description {
      position: relative;
      z-index: 2;
      padding: 10px;
      border-radius: 5px;
    }

    .title {
      color: white;
      font-weight: bold;
      text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
    }

    .description {
      color: white;
      background-color: rgba(0, 0, 0, 0.5);
    }
    a {
      text-decoration: none; /* Remove underline */
      color: inherit; /* Inherit the text color from the parent */
    }
  </style>

</head>
<body>
  <div style="    background-color: rgba(30, 40, 51, 0.85);
  color: white;
  padding: 1%; position: fixed;
  left: 0.5%;
  bottom: 0.5%; z-index: 2;">
  <h6>Hello <?php echo "$nome $apelido ($email)"; ?></h6>
  <a href="logout.php" class="btn btn-danger btn-lg" style="width: 100%;">Logout</a>
</div>

<div class="container">
  <a href="index.php?chat=psicologo" class="card" id="card1">
    <h2 class="title">Psychologist</h2>
    <p class="description">This model will act the best a mental health adviser.</p>
  </a>
  <a href="index.php?chat=programmer" class="card" id="card2">
    <h2 class="title">Programmer</h2>
    <p class="description">This assistant will help you debug, improve, and fix your code.</p>
  </a>
  <a href="index.php?chat=jarvis" class="card" id="card3">
    <h2 class="title">Jarvis</h2>
    <p class="description">This assistant will give you straight up facts. Great for knowledge.</p>
  </a>
  <a href="index.php?chat=buddy" class="card" id="card4">
    <h2 class="title">Your Buddy</h2>
    <p class="description">It's your usual friend you can tell your life and your stories, and you'll probably laugh along.</p>
  </a>
</div>


<script>
  $(document).ready(function() {
    $('.card').mouseenter(function() {
      $(this).removeClass('reverse');
    });

    $('.card').mouseleave(function() {
      $(this).addClass('reverse');
    });
  });

</script>
</body>
</html>
