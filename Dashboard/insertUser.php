<?php
include 'Config_dashboard.php';
 
 
if (isset($_POST['email']) and !empty($_POST['email'])) {
    // $first_name = empty($_POST['first_name']) ? "" : $_POST['first_name'];
    $first_name = !empty($_POST['first_name']) ? $_POST['first_name'] : "unknown";

    $last_name = !empty($_POST['last_name']) ? $_POST['last_name'] : "unknown";
    $email = $_POST['email'];
    $password = !empty($_POST['password']) ? $_POST['password'] : "";
    $phone_number = !empty($_POST['phone_number']) ? $_POST['phone_number'] : "unknown";
    $date = date('Y-m-d-h:i:sa');

    $query = "INSERT INTO `user`( `FIRST_NAME`, `LAST_NAME`, `EMAIL`, `PASSWORD`, `PHONE_NUMBER`,`CREATED_DATE`) VALUES ('$first_name','$last_name','$email','$password','$phone_number','$date')";

    if ($conn->query($query) === true) {
        echo "New User created successfully";
    }
} else {
    echo "pleas filed all data input";
}
