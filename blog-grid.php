<?php
include "Config.php";
// On détermine sur quelle page on se trouve
if (isset($_GET['page']) && !empty($_GET['page'])) {
    $currentPage = (int) strip_tags($_GET['page']);
} else {
    $currentPage = 1;
}
// On détermine le nombre total d'blog
$sql = 'SELECT COUNT(*) AS nb_blog FROM `blog`;';

$result = $conn->query($sql);
$row = mysqli_fetch_assoc($result);

$nbblog = (int) $row['nb_blog'];

$parPage = 12;

// On calcule le nombre de pages total
$pages = ceil($nbblog / $parPage);

// Calcul du 1er article de la page
$premier = ($currentPage * $parPage) - $parPage;

// if (isset($_GET['id'])) {
//     $id = $_GET['id'];
//     $sql = "select b.BLOG_ID,b.TITLE,b.PHOTO,b.BLOG_SHORT,c.CATEGORY_NAME,b.CREATED_DATE from blog as b INNER JOIN category as c on b.CATEGORY_ID=c.CATEGORY_ID where b.CATEGORY_ID=$id ORDER BY CREATED_DATE DESC LIMIT $premier, $parPage;";
// } else {
//     $sql = "select b.BLOG_ID,b.TITLE,b.PHOTO,b.BLOG_SHORT,c.CATEGORY_NAME,b.CREATED_DATE from blog as b INNER JOIN category as c on b.CATEGORY_ID=c.CATEGORY_ID ORDER BY CREATED_DATE DESC LIMIT $premier, $parPage;";
// }
$sql = "select b.BLOG_ID,b.TITLE,b.PHOTO,b.BLOG_SHORT,c.CATEGORY_NAME,b.CREATED_DATE from blog as b INNER JOIN category as c on b.CATEGORY_ID=c.CATEGORY_ID ORDER BY CREATED_DATE DESC LIMIT $premier, $parPage;";
?>
<!DOCTYPE html>
<html lang="en">



<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">


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
                        <p><a href="index.php">Home</a> <span class="fa fa-angle-right"></span> <a href="blog-single.php">Blog</a></p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section> 

    <section class="blog-area bg-f8 animatedParent animateOnce">
        <div class="container">
            <div class="section-content">
                <div class="row">
                    <div class="blog-feature">
                        <?php

                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                $BLOG_ID = $row["BLOG_ID"];
                                $TITLE = $row["TITLE"];
                                $BLOG_SHORT = $row["BLOG_SHORT"];
                                $CATEGORY_NAME = $row["CATEGORY_NAME"];
                                $PHOTO = $row["PHOTO"];
                                $CREATED_DATE = $row["CREATED_DATE"];
                                if (strlen($BLOG_SHORT) > 160) {
                                    $BLOG_SHORT = substr($BLOG_SHORT, 0, 160);
                                }
                                if (strlen($TITLE) > 30) {
                                    $TITLE = substr($TITLE, 0, 30);
                                }
                                echo "<div class='col-md-4 col-sm-6 col-xs-12'>
                                        <div class='blog-item style-1'>
                                            
                                            <a href='Blog-single.php?id=$BLOG_ID'><div class='blog-img blg_img'><img src='$PHOTO' alt=''>
                                                
                                            </div>
                                            </a>
                                            <div class='blog-content'>
                                                <a href='blog-single.php?id=$BLOG_ID'>
                                                    <h4>$TITLE </h4>
                                                </a>
                                                <i class='fa fa-heart-o'></i> <a href='blog-single.php?id=$BLOG_ID'>Category :$CATEGORY_NAME </a>
                                                <p class='blg_p'>$BLOG_SHORT ...</p>
                                                <a href='blog-single.php?id=$BLOG_ID' class='btn btn-simple'>Read More</a>
                                            </div>
                                        </div>
                                    </div>";
                            }
                        }
                        ?>




                    </div>
                </div>
                <nav aria-label="Page navigation example" style="display: flex;justify-content: center;">
                    <ul class="pagination">
                        <li class="page-item <?= ($currentPage == 1) ? "disabled" : "" ?>"><a class="page-link" href="blog-grid.php?page=<?= $currentPage - 1 ?>">Previous</a></li>
                        <?php for ($page = 1; $page <= $pages; $page++) : ?>
                            <!-- Lien vers chacune des pages (activé si on se trouve sur la page correspondante) -->
                            <li class="page-item <?= ($currentPage == $page) ? "active" : "" ?>">
                                <a href="blog-grid.php?page=<?= $page ?>" class="page-link"><?= $page ?></a>
                            </li>
                        <?php endfor ?>

                        <li class="page-item <?= ($currentPage == $pages) ? "disabled" : "" ?>">
                            <a class="page-link" href="blog-grid.php?page=<?= $currentPage + 1 ?>">Next</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </section>

    <!-- divider start -->
    <?php include './email-service.php'; ?>
    <!-- divider end -->

    <!-- Footer Style start -->
    <?php
    include 'footer.php'
    ?>
    <!-- Footer Style End -->


    <a href="blog-single.php" class="scrollup"><i class="pe-7s-up-arrow" aria-hidden="true"></i></a>
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