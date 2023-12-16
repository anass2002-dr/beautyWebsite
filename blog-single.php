<?php
$id = "";
if (isset($_GET['id'])) {
    $id = $_GET['id'];
} else {
    header('Location:error.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">



    <!-- Bootstrap Core CSS -->
    <?php
    include 'styles.php'
    ?>
    <!-- <link rel="stylesheet" href="./node_modules/bootstrap/dist/"> -->
</head>

<body>

    <div class="preloader"></div>

    <!-- Header navbar start -->
    <?php
    include 'header.php'
    ?>
    <!-- Header navbar end -->


    <section class="inner-bg over-layer-black" style="background-image: url('img/beauty/Beauty02.jpg')">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="mini-title inner-style-2">
                        <h3>Blog</h3>
                        <p><a href="index-one.html">Home</a>

                            <!-- title dynamique -->
                            <span class="fa fa-angle-right"> </span>

                            <a href="#">Blog</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php

    $query = "SELECT * FROM blog as b INNER JOIN category as c on b.CATEGORY_ID=c.CATEGORY_ID
        WHERE b.BLOG_ID=$id";
    $result = $conn->query($query);
    $row = mysqli_fetch_assoc($result);
    $blog_id = $row["BLOG_ID"];
    $title = $row["TITLE"];
    $blog = $row["CONTENT"];
    $product_link = $row["PRODUCT_LINK"];
    $photo = $row["PHOTO"];
    $video = $row["VIDEO"];
    $created_date = $row["CREATED_DATE"];
    $category_name = $row["CATEGORY_NAME"];
    $query = "select PHOTO_PATH from collection_photos where BLOG_ID=$blog_id";
    $result = $conn->query($query);
    $cp = $result->num_rows;
    ?>
    <!-- Blog Posts -->
    <div class="bg-f8">
        <div class="container">

            <div class="row">
                <div class="col-md-9">
                    <div class="margin-bottom-30">
                        
                        <div class="blog_style">
                            <h2><?=$title?></h2>

                            <img src="<?=$photo?>" alt="" srcset="">
                            <ul class='list-inline blog-info'>
                                
                                <li><a href='<?=$product_link?>' target='_blank' style='color:#3da1ff;'>Product link</a></li>
                                <li>Category name : <?=$category_name?></li>
                                
                            </ul>
                            <br>
                             
                            <p>
                                <?=$blog?>
                            </p>

                            </div>
                            

                        </div>
                    </div>


                    <div class="col-md-3">
                        <div class="blog-sideber">
                            <div class="widget">
                                <div class="blog-search">
                                    <form action="#" class="clearfix">
                                        <input type="search" placeholder="Search Here..">
                                        <button type="submit">
                                            <span class="pe-7s-search"></span>
                                        </button>
                                    </form>
                                </div>
                            </div>
                           
                            <div class="widget">
                                <div class="sideber-title">
                                    <h4>Recent Posts</h4>
                                </div>
                                <div class="footer-item-3 style-1 news-item">
                                    <?php
                                    $query = "select * from blog limit 3";
                                    $result = $conn->query($query);
                                    while ($row = $result->fetch_assoc()) {
                                        $PHOTO = $row["PHOTO"];
                                        $id_blog = $row["BLOG_ID"];
                                        $titre = $row["TITLE"];
                                        $date = $row["CREATED_DATE"];
                                        if (strlen($titre) > 22) {
                                            $titre = substr($titre, 0, 22);
                                        }
                                        echo "<div class='news-area clearfix'>
                                                    <div class='news-img' style='width: 20%;'>
                                                        <a href='blog-single.php?id=$id_blog'>
                                                            <img src='$PHOTO' alt=''>
                                                            <span class='fa fa-link'></span>
                                                        </a>
                                                    </div>
                                                    <div class='news-content '>
                                                         <a  href='blog-single.php?id=$id_blog'>$titre..</a><br>
                                                        <span>$date</span>
                                                    </div>
                                                </div>";
                                    }
                                    ?>


                                </div>
                            </div>


                            <div class="widget clearfix">
                                <div class="sideber-title">
                                    <h4>Categories</h4>
                                </div>
                                <div class="sideber-content">
                                    <ul>
                                        <?php
                                        include './Config.php';
                                        $query = "select * from category limit 6";
                                        $result = $conn->query($query);
                                        if ($result->num_rows > 0) {
                                            while ($row = $result->fetch_assoc()) {
                                                $category_name = $row['CATEGORY_NAME'];
                                                $category_id = $row['CATEGORY_ID'];
                                                echo "<li> <a href='category.php?id=$category_id'><i class='fa fa-angle-right'></i> $category_name</a> </li>";
                                            }
                                        }
                                        ?>


                                    </ul>
                                </div>
                            </div>
                            
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Blog Posts -->


        <!-- divider end -->

        <!-- Footer Style start -->
        <?php
        include 'footer.php'
        ?>
        <!-- Footer Style End -->


        <a href="#" class="scrollup"><i class="pe-7s-up-arrow" aria-hidden="true"></i></a>
        <!-- jQuery -->
        <script type="text/javascript" src="js/jquery.min.js"></script>

        <!-- Bootstrap Core JavaScript -->
        <script type="text/javascript" src="js/bootstrap.min.js"></script>

        <!-- all plugins and JavaScript -->
        <script type="text/javascript" src="js/bootstrap-datepicker.min.js"></script>
        <script type="text/javascript" src="js/css3-animate-it.js"></script>
        <script type="text/javascript" src="js/bootstrap-dropdownhover.min.js"></script>
        <script type="text/javascript" src="js/owl.carousel.min.js"></script>
        <script type="text/javascript" src="js/gallery.js"></script>
        <script type="text/javascript" src="js/player.min.js"></script>
        <script type="text/javascript" src="js/retina.js"></script>
        <script type="text/javascript" src="js/comming-soon.js"></script>

        <!-- Main Custom JS -->
        <script type="text/javascript" src="js/script.js"></script>


</body>



</html>