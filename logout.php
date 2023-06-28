<?php
//LOGOUT
include 'ligar_db.php';
session_destroy();
header('Location: login.php');
exit(0);
?>