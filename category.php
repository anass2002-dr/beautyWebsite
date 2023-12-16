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
                        <p><a href="index-one.html" style="color:white;">Home</a> <span class="fa fa-angle-right"></span> <a href="#">Blog</a></p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Blog Posts -->
    <div class="blog-inner-section bg-f8">
        <div class="container">
            <div class="row">
                <?php
                include 'Config.php';

                $query = "SELECT * FROM category where CATEGORY_ID=$id";
                $result = $conn->query($query);
                $row = mysqli_fetch_assoc($result);
                $CATEGORY_ID = $row["CATEGORY_ID"];
                $CATEGORY_NAME = $row["CATEGORY_NAME"];
                $DESCRIPTION = $row["DESCRIPTION"];
                $PHOTO_PATH = $row["PHOTO_PATH"];
                echo "<div class='col-md-10 col-md-offset-1'>
                    <div class='blog-item style-1 margin-bottom-30'>
                        <div class='blog-img'><a href='#'><img src='img/category/$PHOTO_PATH.jpg' alt=''></a>
                            
                        </div>
                        <div class='blog-content w100'>
                                                       
                            <a href='#'>
                                <h4>$CATEGORY_NAME</h4>
                            </a>

                            <p>$DESCRIPTION</p>
                            <a href='product-shop.php?id=$CATEGORY_ID' class='btn btn-simple hvr-bounce-to-top'>Our recommended products </a>
                        </div>
                    </div>
                    
                </div>";
                ?>

            </div>
        </div>
    </div>
    <!-- End Blog Posts -->

    <!-- divider start -->
    <section class="service-area over-layer-default" style="background-image:url(img/bg/5.jpg);">
        <div class="container padding-bottom-none padding-top-40">
            <div class="section-content">
                <div class="row">
                   <div class="col-sm-12 col-md-12">
                        <div class="service-item style-1 text-white border-right">
                            <div class="">
                                <i class="pe-7s-mail-open"></i>
                            </div>
                            <div class="content">
                                <h5><a href="#">Send us a Message</a></h5>
                                <p>info@beauty-medicare.com</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
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