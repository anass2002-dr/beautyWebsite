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

</head>

<body>
<!-- https://www.duplichecker.com/ -->
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
                        <h3>Shop </h3>
                        <p><a href="index-one.html">Home</a> <span class="fa fa-angle-right"></span> <a href="#">Shop </a></p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php
    include "Config.php";
    $query = "select * from product where PRODUCT_ID=$id";
    $result = $conn->query($query);
    $row = mysqli_fetch_assoc($result);
    $title = $row["TITLE"];
    $category_id = $row["CATEGORY_ID"];
    $photo = $row["PHOTO"];
    $video = $row["VIDEO"];
    $product_link = $row["PRODUCT_LINK"];
    $sponsor_id = $row["SPONSOR_ID"];
    $content = $row["CONTENT"];
    $product_short = $row["PRODUCT_SHORT"];
    $product_price = $row["PRODUCT_PRICE"];
    $query = "select * from sponsor where SPONSOR_ID=$sponsor_id";
    $result = $conn->query($query);
    $row = mysqli_fetch_assoc($result);
    $sponsor_name = $row["SPONSOR_NAME"];
    $sponsor_url = $row["SPONSOR_URL"];

    $result = $conn->query("SELECT * FROM `product_collection_photos` where PRODUCT_ID=$id");
    $cp = $result->num_rows;
    
    if($video!=''){
        $cp+=1;
    }
    
    ?>
    <!-- SHOPING CART AREA START -->
    <section class="shoping-cart-area bg-f8">
        <div class="container">
            <div class="row">

                <div class='col-12'>
                    <div class='blog-item'>
                        <div class='blog-images col-12 col-md-6'>
                            <div id="bootstrap-touch-slider" class="carousel bs-slider fade  control-round indicators-line" data-ride="carousel" data-pause="hover" data-interval="5000">
                                
                                <!-- Wrapper For Slides -->
                                <div class="carousel-inner" role="listbox">
                                    <!-- Third Slide -->
                                    <?php
                                    echo "<div class='item active'>
                                            <img src='$photo' alt='Slider Images' class='slide-image' />
                                            
                                            </div>";

                                    while ($row = $result->fetch_assoc()) {
                                        $path = $row["PHOTO_PATH"];
                                        echo "<div class='item'>
                                                <img src='$path' alt='Slider Images' class='slide-image' />
                                              </div>";
                                    }
                                        if($video!=''){
                                            echo "
                                            <div class='item vd'>
                                                <video controls>
                                                <source src='$video' type='video/mp4'>
                                                Your browser does not support the video tag.
                                                </video>
                                            </div>
                                            ";

                                        }
                                    ?>
                                    
                                </div><!-- End of Wrapper For Slides -->

                                <!-- Left Control -->
                                <a class="left carousel-control" href="#bootstrap-touch-slider" role="button" data-slide="prev">
                                    <span class="fa fa-angle-left" aria-hidden="true"></span>
                                    <span class="sr-only">Previous</span>
                                </a>

                                <!-- Right Control -->
                                <a class="right carousel-control" href="#bootstrap-touch-slider" role="button" data-slide="next">
                                    <span class="fa fa-angle-right" aria-hidden="true"></span>
                                    <span class="sr-only">Next</span>
                                </a>

                            </div> <!-- <div class='blog-img'><a href='#'><img src='$photo' alt=''></a></div> -->
                        </div>
                        

                        <div class='blog-content col-12 col-md-6'>
                            <h4><?=$title?></h4>
                            <a href='<?=$sponsor_urlµ?>' target='blank'>
                                <h6 class='color-defult text-lowercase'><?=$sponsor_name?></h6>
                            </a>
                            <div class='blog-date margin-bottom-20 margin-top-30'>
                                <h3>$ <?=$product_price?><sub>/Only</sub></h3>
                            </div>
                            <p><?=$product_short?></p>
                            <a href='<?=$product_link?>'target='_blank' class='btn btn-simple'>View product</a>
                        </div>
                    </div>
                </div>
                <div class='col-12' style='background-color: #fff;padding: 30px; '>
                    <p style='bacground-color:#fff;'><?=$content?>
                    </p> 
                </div>
                
                        
            </div>
        </div>
    </section>
    <!-- SHOPING CART AREA END -->




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