<?php
include "Config_dashboard.php";
// if (isset($_GET['id'])) {
//     $id = $_GET['id'];
//     $query = "delete from blog where BLOG_ID=$id";
//     $result = $conn->query($query);
// }
if (isset($_POST['id']) and isset($_POST['type'])) {
    $id =  $_POST['id'];
    $type=$_POST['type'];
    if($type=='b'){
        $query = "delete from blog where BLOG_ID=$id";
        $conn->query($query);
    }
    if($type=='p'){
        $query = "delete from product where PRODUCT_ID=$id";
        $conn->query($query);
    }
    if($type=='s'){
        $query = "delete from sponsor where SPONSOR_ID=$id";
        $conn->query($query);
    }
    if($type=='u'){
        $query = "delete from user where USER_ID=$id";
        $conn->query($query);
    }
    exit;
}

echo 0;
exit;
