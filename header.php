<?php
session_start();
include "./Config.php";
?>
<div class="header-topbar style-2">
    <div class="container padding-none">
        <div class="row">
            <div class="col-md-8 col-sm-6 welcome-top">
                <ul class="list-inline top-icon">
                    <li><i class="fa fa-envelope"></i> contact@beautymedicare.com</li>
                </ul>
            </div>
            <div class="col-md-4 col-sm-6">
                <ul class="list-inline text-right icon-style-1">
                    <li class=" hvr-rectangle-out"><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                    <li class=" hvr-rectangle-out"><a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                    <li class=" hvr-rectangle-out"><a href="#"><i class="bi bi-tiktok" aria-hidden="true"></i></a></li>
                    <li class=" hvr-rectangle-out"><a href="#"><i class="bi bi-pinterest" aria-hidden="true"></i></a></li>
                </ul>
            </div>
        </div>
    </div>
</div>

<div class="main-navbar conner-style style-2 position-fixed">
    <div class="container padding-none">
        <div class="row">
            <div class="col-md-12">
                <nav class="navbar navbar-default">

                    <div class="navbar-brand">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand dis-none logoLink" href="index.php"><img src="./img/beautymedic-test.png" alt="" style="margin-top: 10px;">
                        </a>
                        <a class="navbar-brand dis-block logoLink" href="index.php"><img src="./img/beautymedic-test.png" alt="" style="margin-top: 10px;">
                        </a>
                    </div>
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1" data-hover="dropdown" data-animations-delay="1.8s" data-animations="fadeInUp">

                        <ul class="nav navbar-nav bg-none navbar-right style-3">
                            <li class="dropdown active">
                                <a href="index.php" class="" data-toggle="" aria-haspopup="true" aria-expanded="false"><span data-hover="Home">Home </span> </a>

                            </li>


                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span data-hover="Depertment">Category <i class="fa fa-angle-down" aria-hidden="true"></i></span></a>

                                <ul class="dropdown-menu">
                                    <?php
                                    include './Config.php';
                                    $query = "select * from category limit 6";
                                    $result = $conn->query($query);
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            $category_name = $row['CATEGORY_NAME'];
                                            $category_id = $row['CATEGORY_ID'];
                                            echo "<li><a href='category.php?id=$category_id'>$category_name</a></li>";
                                        }
                                    }
                                    ?>

                                </ul>
                            </li>
                            <li class="dropdown active">
                                <a href="product-shop.php" class="" data-toggle="" aria-haspopup="true" aria-expanded="false"><span data-hover="Home">Our suggestion </span> </a>

                            </li>
                            <li class="dropdown">
                                <a href="blog-grid.php" class="" aria-haspopup="true" aria-expanded="false"><span data-hover="Blog">Blogs </span></a>

                            </li>
                            <li class="dropdown">
                                <a href="about-us.php" class="" aria-haspopup="true" aria-expanded="false"><span data-hover="Depertment">About-us </span></a>
                            </li>

                            <li class="dropdown">
                                <a href="contact-us.php" class="" aria-haspopup="true" aria-expanded="false"><span data-hover="Contact">Contact </span></a>
                            </li>

                        </ul>
                    </div>
                </nav>
            </div>
        </div>
    </div>
</div>