<?php
session_start();
// unset($_SESSION['passport']);
// unset($_SESSION['username']);
// unset($_SESSION['password']);

include '../Config.php';
if (!$_SESSION["passport"]) {
  $username = $_POST['username'];
  $password = $_POST['password'];
  $name = "";
  $pass = "";
  $picture = "";
  $first_name = "";
  $last_name = "";
  $query = "select * from admin where USER_NAME='$username'";
  $result = $conn->query($query);
  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
      $name = $row['USER_NAME'];
      $pass = $row['PASSWORD'];
      $first_name = $row['FIRST_NAME'];
      $last_name = $row['LAST_NAME'];
      $picture = $row['PICTURE'];
    }
    if ($pass == $password) {
      $_SESSION['passport'] = 'ok';
      $_SESSION['username'] = $name;
      $_SESSION['password'] = $pass;
      $_SESSION['picture'] = $picture;
      $_SESSION['first_name'] = $first_name;
      $_SESSION['last_name'] = $last_name;
      header("Location:index.php");
    } else {
      echo 'invalid password';
      header("Location:login.php");
      exit();
    }
  } else {
    echo 'invalid email';
    header("Location:login.php");
    exit();
  }
} else {
  header("Location:index.php");
}
