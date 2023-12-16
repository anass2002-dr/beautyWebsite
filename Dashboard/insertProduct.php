<?php
include 'Config_dashboard.php';
$target_dir = "../img/Product/";

$temp = explode(".", $_FILES["photo"]["name"]);
$newfilename = round(microtime(true)) . '.' . end($temp);
// $newfilename = 'img/product/' . $newfilename;
move_uploaded_file($_FILES["photo"]["tmp_name"], $target_dir . $newfilename);



$target_dir = "../videos/Product/";
$tempv = explode(".", $_FILES["video"]["name"]);
$newfilenamev = round(microtime(true)) . '.' . end($tempv);
move_uploaded_file($_FILES["video"]["tmp_name"], $target_dir . $newfilenamev);
move_uploaded_file($_FILES["video"]["tmp_name"], $target_dir);

$title = $_POST['title'];
$category = $_POST['category'];
$photo = (isset($_POST['photo_link']) and !empty($_POST['photo_link'])) ? $_POST['photo_link'] : 'img/Product/' . $newfilename;
$video = (isset($_POST['video_link']) and !empty($_POST['video_link'])) ? $_POST['video_link'] : 'video/Product/' . $newfilenamev;
$product_link = $_POST['product_link'];
$product_price = $_POST['price'];
$product_price = floatval($product_price);
$Product = $_POST['content'];
$product_short = $_POST['product_short'];
$keywords = $_POST['keywords'];
$ddp = 0;
if (isset($_POST['ddp'])) {
    $ddp = $_POST['ddp'];
}
$sponsor = $_POST['sponsor'];
$date = date('Y-m-d-h:i:sa');

if (!empty($title) and !empty($category) and !empty($photo) and !empty($Product) and !empty($product_short)) {
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $Product = mysqli_real_escape_string($conn, $Product);
    $title = mysqli_real_escape_string($conn, $title);
    $ddp = mysqli_real_escape_string($conn, $ddp);
    $product_short = mysqli_real_escape_string($conn, $product_short);
    $keywords = mysqli_real_escape_string($conn, $keywords);

    $sql = "INSERT INTO product (TITLE, CATEGORY_ID, PHOTO, VIDEO, PRODUCT_LINK, CONTENT,PRODUCT_SHORT,KEYWORDS,PRODUCT_PRICE,SPONSOR_ID,DDP ,CREATED_DATE) VALUES ('$title', $category, '$photo','$video','$product_link','$Product','$product_short','$keywords',$product_price,$sponsor,$ddp,'$date')";
    if ($conn->query($sql) === TRUE) {
        $sql2 = "SELECT PRODUCT_ID FROM PRODUCT ORDER BY PRODUCT_ID DESC LIMIT 1;";
        $result = $conn->query($sql2);
        $row = mysqli_fetch_assoc($result);
        $id_Product = $row['PRODUCT_ID'];
        if (!empty($_FILES['photo_collection']['name'][0])) {
            $files = $_FILES['photo_collection'];
            $file_count = count($files['name']);
            for ($i = 0; $i < $file_count; $i++) {
                $filenameC = $files['name'][$i];
                $tmp_nameC = $files["tmp_name"][$i];
                $target_dirC = "../img/Product/";
                $tempC = explode(".", $filenameC);
                $newfilenameC = rand() . '.' . end($tempC);
                move_uploaded_file($tmp_nameC, $target_dirC . $newfilenameC);
                $newfilenameC = 'img/Product' . $newfilenameC;
                $query3 = "INSERT INTO product_collection_photos(PRODUCT_ID, PHOTO_PATH,UPDATE_DATE) VALUES ($id_Product,'$newfilenameC','$date')";
                $conn->query($query3);
                echo " adding Product with local collection photos links";
            }
        } else if (isset($_POST['collection_link']) and !empty($_POST['collection_link'])) {
            foreach ($_POST['collection_link'] as $links) {
                $query3 = "INSERT INTO product_collection_photos(PRODUCT_ID, PHOTO_PATH,UPDATE_DATE) VALUES ($id_Product,'$links','$date')";
                $conn->query($query3);
            }
            echo " adding Product with collection photos links";
        }
        echo "New Product created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $conn->close();
} else {
    echo "please filed all input";
}
