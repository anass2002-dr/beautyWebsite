<?php
// session_start();
$_SESSION['user_mail'] = (!isset($_SESSION['user_mail']) or empty($_SESSION['user_mail'])) ? "" : $_SESSION['user_mail'];

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "beautymedic";
$conn = new mysqli($servername, $username, $password, $dbname);
