<?php
session_start();
unset($_SESSION["passport"]);
unset($_SESSION["username"]);
unset($_SESSION["password"]);
unset($_SESSION["first_name"]);
unset($_SESSION["last_name"]);
unset($_SESSION["picture"]);
header("Location:login.php");
