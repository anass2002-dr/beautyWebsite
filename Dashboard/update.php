<?php
include "Config_dashboard.php";
if (isset($_POST['operation'])) {
    $operation = $_POST['operation'];
    $newfilename = "";
    $newfilenamev = "";
    function insert_media($file, $directory)
    {
        if (isset($_FILES[$file])) {
            if ($_FILES[$file]['error'] != 4 || ($_FILES[$file]['size'] != 0 && $_FILES[$file]['error'] != 0)) {
                $target_dir = $directory;
                $temp = explode(".", $_FILES[$file]["name"]);

                $newfilename = round(microtime(true)) . '.' . end($temp);
                move_uploaded_file($_FILES[$file]["tmp_name"], $target_dir . $newfilename);
                return $newfilename;
                // cover_image is empty (and not an error), or no file was uploaded
            }
        }
    }



    // (isset($_POST['photo_link']) and !empty($_POST['photo_link'])) ? $_POST['photo_link'] : 'img/blog/' . $newfilename;
    if ($operation == 'blog') {
        $id = $_POST["id"];
        $query = "select * from blog where BLOG_ID=$id";
        $result = $conn->query($query);
        $row = mysqli_fetch_assoc($result);
        $photo = (isset($_POST['photo_link']) and !empty($_POST['photo_link'])) ?  $_POST['photo_link'] : $row['PHOTO'];
        $video = (isset($_POST['video_link']) and !empty($_POST['video_link'])) ?  $_POST['video_link'] : $row['VIDEO'];
        $title = $row['TITLE'];
        $category = $row['CATEGORY_ID'];
        $product_link = $row['PRODUCT_LINK'];
        $blog = $row['CONTENT'];
        $blog_short = $row['BLOG_SHORT'];
        $blog_keywords = $row['BLOG_KEYWORDS'];
        $newfilename = insert_media('photo', '../img/blog/');
        $newfilenamev = insert_media('video', '../videos/blog/');
        if (!empty($newfilename)) {
            $photo = 'img/blog/' . $newfilename;
        }
        if (!empty($newfilenamev)) {
            $video = 'videos/blog/' . $newfilenamev;
        }
        if (isset($_POST['title'])) {
            $title = $_POST['title'];
        }
        if (isset($_POST['category'])) {
            $category = $_POST['category'];
        }
        if (isset($_POST['product_link'])) {
            $product_link = $_POST['product_link'];
        }

        if (isset($_POST['blog'])) {
            $blog = $_POST['blog'];
        }
        if (isset($_POST['blog_short'])) {
            $blog_short = $_POST['blog_short'];
        }
        if (isset($_POST['blog_keywords'])) {
            $blog_keywords = $_POST['blog_keywords'];
        }
        $date = date('Y-m-d-h:i:sa');


        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $blog = mysqli_real_escape_string($conn, $blog);
        $blog_short = mysqli_real_escape_string($conn, $blog_short);
        $blog_keywords = mysqli_real_escape_string($conn, $blog_keywords);
        $title = mysqli_real_escape_string($conn, $title);
        $query = "UPDATE blog SET TITLE='$title',CATEGORY_ID='$category',PHOTO='$photo',VIDEO='$video',PRODUCT_LINK='$product_link',CONTENT='$blog',BLOG_SHORT='$blog_short',BLOG_KEYWORDS='$blog_keywords',UPDATE_DATE='$date' where BLOG_ID=$id";

        // $conn->query($query);
        if ($conn->query($query) === TRUE) {
            if (!empty($_FILES['photo_collection']['name'][0])) {
                $query4 = "delete from collection_photos where BLOG_ID=$id";
                $conn->query($query4);
                $files = $_FILES['photo_collection'];
                $file_count = count($files['name']);
                for ($i = 0; $i < $file_count; $i++) {
                    $filenameC = $files['name'][$i];
                    $tmp_nameC = $files["tmp_name"][$i];
                    $target_dirC = "../img/blog/";
                    $tempC = explode(".", $filenameC);
                    $newfilenameC = rand() . '.' . end($tempC);
                    move_uploaded_file($tmp_nameC, $target_dirC . $newfilenameC);
                    $date = date('Y-m-d-h:i:sa');
                    $newfilenameC = 'img/blog/' . $newfilenameC;
                    $query3 = "INSERT INTO collection_photos(BLOG_ID, PHOTO_PATH,UPDATE_DATE) VALUES ($id,'$newfilenameC','$date')";
                    $conn->query($query3);
                }
            } else if (isset($_POST['collection_link']) and !empty($_POST['collection_link'])) {
                $query4 = "delete from collection_photos where BLOG_ID=$id";
                $conn->query($query4);
                foreach ($_POST['collection_link'] as $links) {
                    $query3 = "INSERT INTO collection_photos(BLOG_ID, PHOTO_PATH,UPDATE_DATE) VALUES ($id,'$links','$date')";
                    $conn->query($query3);
                }
                echo " update blog with collection photos links";
            } else {
                echo " update blog without collection photo";
            }
            echo "blog is updated successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
        $conn->close();
    } else if ($operation == 'product') {
        $id = $_POST["id"];
        $query = "select * from product where PRODUCT_ID=$id";
        $result = $conn->query($query);
        $row = mysqli_fetch_assoc($result);
        $photo = (isset($_POST['photo_link']) and !empty($_POST['photo_link'])) ?  $_POST['photo_link'] : $row['PHOTO'];
        $video = (isset($_POST['video_link']) and !empty($_POST['video_link'])) ?  $_POST['video_link'] : $row['VIDEO'];
        $title = $row['TITLE'];
        $category = $row['CATEGORY_ID'];
        $product_link = $row['PRODUCT_LINK'];
        $product_price = $row['PRODUCT_PRICE'];
        $Product = $row['CONTENT'];
        $product_short = $row['PRODUCT_SHORT'];
        $keywords = $row['KEYWORDS'];
        $sponsor = $row['SPONSOR_ID'];
        $newfilename = insert_media('photo', '../img/Product/');
        $newfilenamev = insert_media('video', '../videos/Product/');
        if (!empty($newfilename)) {
            $photo = 'img/Product/' . $newfilename;
        }
        if (!empty($newfilenamev)) {
            $video = 'videos/Product/' . $newfilenamev;
        }

        if (isset($_POST['title'])) {
            $title = $_POST['title'];
        }
        if (isset($_POST['category'])) {
            $category = $_POST['category'];
        }
        if (isset($_POST['product_link'])) {
            $product_link = $_POST['product_link'];
        }
        if (isset($_POST['price'])) {
            $product_price = $_POST['price'];
        }
        if (isset($_POST['product'])) {
            $Product = $_POST['product'];
        }
        if (isset($_POST['product_short'])) {
            $product_short = $_POST['product_short'];
        }
        if (isset($_POST['keywords'])) {
            $keywords = $_POST['keywords'];
        }


        if (isset($_POST['sponsor'])) {
            $sponsor = $_POST['sponsor'];
        }
        $date = date('Y-m-d-h:i:sa');



        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $Product = mysqli_real_escape_string($conn, $Product);
        $product_short = mysqli_real_escape_string($conn, $product_short);
        $keywords = mysqli_real_escape_string($conn, $keywords);
        $title = mysqli_real_escape_string($conn, $title);
        $query = "UPDATE product SET TITLE='$title',CATEGORY_ID='$category',PHOTO='$photo',VIDEO='$video',PRODUCT_LINK='$product_link',CONTENT='$Product',PRODUCT_SHORT='$product_short',KEYWORDS='$keywords',PRODUCT_PRICE=$product_price,SPONSOR_ID=$sponsor,UPDATE_DATE='$date' where PRODUCT_ID=$id";

        // $conn->query($query);
        if ($conn->query($query) === TRUE) {

            if (!empty($_FILES['photo_collection']['name'][0])) {
                $query4 = "delete from product_collection_photos where PRODUCT_ID=$id";
                $conn->query($query4);
                $files = $_FILES['photo_collection'];
                $file_count = count($files['name']);

                for ($i = 0; $i < $file_count; $i++) {
                    $filenameC = $files['name'][$i];
                    $tmp_nameC = $files["tmp_name"][$i];
                    $target_dirC = "../img/Product/";
                    $tempC = explode(".", $filenameC);
                    $newfilenameC =  rand() . '.' . end($tempC);
                    move_uploaded_file($tmp_nameC, $target_dirC . $newfilenameC);
                    $date = date('Y-m-d-h:i:sa');
                    $newfilenameC = "img/Product/" . $newfilenameC;

                    $query3 = "INSERT INTO product_collection_photos(PRODUCT_ID, PHOTO_PATH,UPDATE_DATE) VALUES ($id,'$newfilenameC','$date')";
                    $conn->query($query3);
                }
            } else if (isset($_POST['collection_link']) and !empty($_POST['collection_link'])) {
                $query4 = "delete from collection_photos where BLOG_ID=$id";
                $conn->query($query4);
                foreach ($_POST['collection_link'] as $links) {
                    $query3 = "INSERT INTO product_collection_photos(PRODUCT_ID, PHOTO_PATH,UPDATE_DATE) VALUES ($id,'$links','$date')";
                    $conn->query($query3);
                }
                echo " update blog with collection photos links";
            } else {
                echo " update blog without collection photo";
            }
            echo "Product is updated successfully";
        } else {
            echo "Error: " . $query . "<br>" . $conn->error;
        }
        $conn->close();
    } else if ($operation == 'sponsor') {
        $id = $_POST["id"];
        $query = "select * from sponsor where SPONSOR_ID=$id";
        $result = $conn->query($query);
        $row = mysqli_fetch_assoc($result);
        $sponsor_name = $row['SPONSOR_NAME'];
        $sponsor_url = $row['SPONSOR_URL'];
        $sponsor_logo = $row['SPONSOR_LOGO'];
        $newfilename = insert_media("photo", "../img/sponsor/");
        if (!empty($newfilename)) {
            $sponsor_logo = 'img/sponsor/' . $newfilename;
        }
        if (isset($_POST['sponsor_name'])) {
            $sponsor_name = $_POST['sponsor_name'];
        }
        if (isset($_POST['sponsor_url'])) {
            $sponsor_url = $_POST['sponsor_url'];
        }

        $date = date('Y-m-d-h:i:sa');

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sponsor_name = mysqli_real_escape_string($conn, $sponsor_name);
        $sponsor_url = mysqli_real_escape_string($conn, $sponsor_url);
        $query = "UPDATE sponsor SET SPONSOR_NAME='$sponsor_name',SPONSOR_URL='$sponsor_url',SPONSOR_LOGO='$sponsor_logo' ,UPDATE_DATE='$date' where SPONSOR_ID=$id";

        // $conn->query($query);
        if ($conn->query($query) === TRUE) {

            echo "Sponsor is updated successfully";
        } else {
            echo "Error: " . $query . "<br>" . $conn->error;
        }
        $conn->close();
    } else if ($operation == 'user') {
        $id = $_POST["id"];
        $query = "select * from user where USER_ID=$id";
        $result = $conn->query($query);
        $row = mysqli_fetch_assoc($result);
        // $first_name = $row["FIRST_NAME"];
        // $last_name = $row["LAST_NAME"];
        // $email = $row["EMAIL"];
        // $password = $row["PASSWORD"];
        // $phone_number = $row["PHONE_NUMBER"];
        $first_name = !empty($_POST['first_name']) ? $_POST['first_name'] : $row["FIRST_NAME"];
        $last_name = !empty($_POST['last_name']) ? $_POST['last_name'] : $row["LAST_NAME"];
        $email = !empty($_POST['email']) ? $_POST['email'] : $row["EMAIL"];
        $password = !empty($_POST['password']) ? $_POST['password'] : $row["PASSWORD"];
        $phone_number = !empty($_POST['phone_number']) ? $_POST['phone_number'] : $row["PHONE_NUMBER"];

        // if (isset($_POST['first_name'])) {
        //     $first_name = $_POST['first_name'];
        // }
        // if (isset($_POST['last_name'])) {
        //     $last_name = $_POST['last_name'];
        // }
        // if (isset($_POST['email'])) {
        //     $email = $_POST['email'];
        // }
        // if (isset($_POST['password'])) {
        //     $password = $_POST['password'];
        // }
        // if (isset($_POST['phone_number'])) {
        //     $phone_number = $_POST['phone_number'];
        // }

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }



    $first_name = mysqli_real_escape_string($conn, $first_name);
    $last_name = mysqli_real_escape_string($conn, $first_name);
    $email = mysqli_real_escape_string($conn, $first_name);
    $password = mysqli_real_escape_string($conn, $first_name);
    $phone_number = mysqli_real_escape_string($conn, $first_name);
    $query = "UPDATE user SET FIRST_NAME='$first_name',LAST_NAME='$last_name',EMAIL='$email',
    PASSWORD='$password',PHONE_NUMBER='$phone_number'   where USER_ID=$id";


        $first_name = mysqli_real_escape_string($conn, $first_name);
        $last_name = mysqli_real_escape_string($conn, $first_name);
        $email = mysqli_real_escape_string($conn, $first_name);
        $password = mysqli_real_escape_string($conn, $first_name);
        $phone_number = mysqli_real_escape_string($conn, $first_name);
        $query = "UPDATE user SET FIRST_NAME='$first_name',LAST_NAME='$last_name',EMAIL='$email',
        PASSWORD='$password',PHONE_NUMBER='$phone_number'   where USER_ID=$id";

        $first_name = mysqli_real_escape_string($conn, $first_name);
        $last_name = mysqli_real_escape_string($conn, $first_name);
        $email = mysqli_real_escape_string($conn, $first_name);
        $password = mysqli_real_escape_string($conn, $first_name);
        $phone_number = mysqli_real_escape_string($conn, $first_name);
        $date = date('Y-m-d-h:i:sa');

        $query = "UPDATE user SET FIRST_NAME='$first_name',LAST_NAME='$last_name',EMAIL='$email',PASSWORD='$password',PHONE_NUMBER='$phone_number',UPDATE_DATE='$date'   where USER_ID=$id";

        // $conn->query($query);
        if ($conn->query($query) === TRUE) {

            echo "User is updated successfully";
        } else {
            echo "Error: " . $query . "<br>" . $conn->error;
        }
        $conn->close();
    }
} else {
    header('Location:index.php');
}
