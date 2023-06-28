<?php
session_start();

$link = mysqli_connect("localhost", "bakill3", "12345", "jarvis_chatgpt");
if ($link === false) {
    die("Não foi possível estabelecer uma conexão: " . mysqli_connect_error());
    exit;
}
mysqli_set_charset($link, "UTF8");

function check_login() {

    if (!isset($_SESSION['user'])) { //IF THE USER IS NOT LOGGED IN
        header('Location: login.php');
        exit(0);
    }
}

if (isset($_SESSION['user'])) {
  $nome = $_SESSION['user'][0];
  $apelido = $_SESSION['user'][1];
  $idade = $_SESSION['user'][2];
  $email = $_SESSION['user'][3];
}
?>