<?php
include 'Config_dashboard.php';
$target_dir = "../img/blog/";

$temp = explode(".", $_FILES["photo"]["name"]);
$newfilename = round(microtime(true)) . '.' . end($temp);
move_uploaded_file($_FILES["photo"]["tmp_name"], $target_dir . $newfilename);



$target_dir = "../videos/blog/";
$tempv = explode(".", $_FILES["video"]["name"]);
$newfilenamev = round(microtime(true)) . '.' . end($tempv);
move_uploaded_file($_FILES["video"]["tmp_name"], $target_dir . $newfilenamev);
move_uploaded_file($_FILES["video"]["tmp_name"], $target_dir);



$title = $_POST['title'];
$category = $_POST['category'];
$photo = (isset($_POST['photo_link']) and !empty($_POST['photo_link'])) ? $_POST['photo_link'] : 'img/blog/' . $newfilename;
$video = (isset($_POST['video_link']) and !empty($_POST['video_link'])) ? $_POST['video_link'] : 'video/blog/' . $newfilenamev;
$product_link = $_POST['product_link'];
$blog = $_POST['blog'];
$blog_short = $_POST['blog_short'];
$blog_keywords = $_POST['blog_keywords'];
$date = date('Y-m-d-h:i:sa');

if (!empty($title) and !empty($category) and !empty($photo) and !empty($blog) and !empty($blog_short)) {
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $blog = mysqli_real_escape_string($conn, $blog);
    $title = mysqli_real_escape_string($conn, $title);
    $blog_short = mysqli_real_escape_string($conn, $blog_short);
    $blog_keywords = mysqli_real_escape_string($conn, $blog_keywords);
    $sql = "INSERT INTO blog (TITLE, CATEGORY_ID, PHOTO, VIDEO, PRODUCT_LINK, CONTENT,BLOG_SHORT,BLOG_KEYWORDS, CREATED_DATE) VALUES ('$title', $category, '$photo','$video','$product_link','$blog','$blog_short','$blog_keywords','$date')";
    if ($conn->query($sql) === TRUE) {
        $sql2 = "SELECT BLOG_ID FROM blog ORDER BY BLOG_ID DESC LIMIT 1;";
        $result = $conn->query($sql2);
        $row = mysqli_fetch_assoc($result);
        $id_blog = $row['BLOG_ID'];
        if (!empty($_FILES['photo_collection']['name'][0])) {
            $files = $_FILES['photo_collection'];
            $file_count = count($files['name']);
            for ($i = 0; $i < $file_count; $i++) {
                $filenameC = $files['name'][$i];
                $tmp_nameC = $files["tmp_name"][$i];
                $target_dirC = "../img/blog/";
                $tempC = explode(".", $filenameC);
                $newfilenameC = rand() . '.' . end($tempC);
                move_uploaded_file($tmp_nameC, $target_dirC . $newfilenameC);
                $newfilenameC = "img/blog/" . $newfilenameC;
                $query3 = "INSERT INTO collection_photos(BLOG_ID, PHOTO_PATH,UPDATE_DATE) VALUES ($id_blog,'$newfilenameC','$date')";
                $conn->query($query3);
            }
            echo " adding blog with local collections photos ";
        } else if (isset($_POST['collection_link']) and !empty($_POST['collection_link'])) {
            foreach ($_POST['collection_link'] as $links) {
                $query3 = "INSERT INTO collection_photos(BLOG_ID, PHOTO_PATH,UPDATE_DATE) VALUES ($id_blog,'$links','$date')";
                $conn->query($query3);
            }
            echo " adding blog with collection photos links";
        } else {
            echo " adding blog without collection photo";
        }
        echo "New Blog created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $conn->close();
} else {
    echo "please filed all input";
}
