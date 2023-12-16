<?php
include 'Config_dashboard.php';
$target_dir = "../img/sponsor/";

$temp = explode(".", $_FILES["photo"]["name"]);
$newfilename = round(microtime(true)) . '.' . end($temp);
move_uploaded_file($_FILES["photo"]["tmp_name"], $target_dir . $newfilename);
$date = date('Y-m-d-h:i:sa');
$newfilename = "img/sponsor/" . $newfilename;

if (isset($_POST['sponsor_name']) and isset($_POST['sponsor_url'])) {
    $sponsor_name = $_POST['sponsor_name'];
    $sponsor_url = $_POST['sponsor_url'];
    $query = "INSERT INTO `sponsor`( `SPONSOR_NAME`, `SPONSOR_URL`, `SPONSOR_LOGO`,CREATED_DATE) VALUES ('$sponsor_name','$sponsor_url','$newfilename','$date')";

    if ($conn->query($query) === true) {
        echo "New Sponsor created successfully";
    }
} else {
    echo "pleas filed all data input";
}
