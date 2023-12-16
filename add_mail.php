<?php
include 'Config.php';
if (isset($_POST['user_mail']) and !empty($_POST['user_mail'])) {
    $email = $_POST['user_mail'];
    $_SESSION['usre_mail'] = $email;
    $date = date('Y-m-d-h:i:sa');

    $query = "INSERT INTO user(EMAIL,CREATED_DATE) value('$email','$date');";
    $conn->query($query);
    if ($conn->query($query)) {
        echo 'email has been inserted with sucesses';
    } else {
        echo 'email not inserted';
    }
} else {
    echo 'no email is set';
}
