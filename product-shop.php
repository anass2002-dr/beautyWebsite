<?php
include "Config.php";
// On détermine sur quelle page on se trouve
// session_start();

if (isset($_GET['page']) && !empty($_GET['page'])) {
    $currentPage = (int) strip_tags($_GET['page']);
} else {
    $currentPage = 1;
}
// On détermine le nombre total d'blog
$id = '';
$sp_id = '';
$sql = '';
$ddp = isset($_GET['ddp']) ? $_GET['ddp'] : 0;

$query_check = "DDP=" . $ddp;
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT COUNT(*) AS nb_product FROM product  WHERE CATEGORY_ID=$id and $query_check";
} else if (isset($_GET['sp_id']) && !empty($_GET['sp_id'])) {
    $sp_id = $_GET['sp_id'];
    $sql = "SELECT COUNT(*) AS nb_product FROM product  WHERE SPONSOR_ID=$sp_id and $query_check";
} else {
    $sql = "SELECT COUNT(*) AS nb_product FROM product where $query_check";
}
$result = $conn->query($sql);
$row = mysqli_fetch_assoc($result);

$nbblog = (int) $row['nb_product'];

$parPage = 12;

// On calcule le nombre de pages total
$pages = ceil($nbblog / $parPage);

// Calcul du 1er article de la page
$premier = ($currentPage * $parPage) - $parPage;
if ($pages > 6) {
    $last_page = $currentPage + 6;
} else {
    $last_page = $pages;
}

if ($last_page >= $pages) {
    $last_page = $pages;
}
$queryP = '';
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = $_GET['id'];
    $queryP = "SELECT * FROM product as p INNER JOIN sponsor as s on p.SPONSOR_ID=s.SPONSOR_ID WHERE p.CATEGORY_ID=$id and $query_check ORDER BY p.CREATED_DATE ASC LIMIT $premier, $parPage;";
    if (isset($_GET['sp_id']) && !empty($_GET['id'])) {
        $sp_id = $_GET['sp_id'];
        $queryP = "SELECT * FROM product as p INNER JOIN sponsor as s on p.SPONSOR_ID=s.SPONSOR_ID WHERE p.CATEGORY_ID=$id and p.SPONSOR_ID=$sp_id  and $query_check  ORDER BY p.CREATED_DATE ASC LIMIT $premier, $parPage;";
    }
} else if (isset($_GET['sp_id']) && !empty($_GET['sp_id'])) {
    $sp_id = $_GET['sp_id'];
    $queryP = "SELECT * FROM product as p INNER JOIN sponsor as s on p.SPONSOR_ID=s.SPONSOR_ID WHERE p.SPONSOR_ID=$sp_id and $query_check  ORDER BY p.CREATED_DATE ASC LIMIT $premier, $parPage;";
} else if (isset($_GET['title']) && !empty($_GET['title'])) {
    $title = $_GET['title'];
    $queryP = "SELECT * FROM product as p INNER JOIN sponsor as s on p.SPONSOR_ID=s.SPONSOR_ID WHERE p.TITLE='$title' and $query_check  ORDER BY p.CREATED_DATE ASC LIMIT $premier, $parPage;";
} else {
    $queryP = "SELECT * FROM product as p INNER JOIN sponsor as s on p.SPONSOR_ID=s.SPONSOR_ID where $query_check  ORDER BY p.CREATED_DATE ASC LIMIT $premier, $parPage;";
}

if (!empty($id)) {
    $id = '&id=' . $id;
}
if (!empty($sp_id)) {
    $sp_id = '&sp_id=' . $sp_id;
}
$id_ddp = '';
if ($ddp == 1) {
    $id_ddp = '&' . strtolower($query_check);
}



?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="ASCription" content="">
    <meta name="author" content="">

    <?php
    include './styles.php'
    ?>
</head>

<body>

    <div class="preloader"></div>


    <?php
    include './header.php'
    ?>
    <section class="inner-bg over-layer-black" style="background-image: url('img/beauty/Beauty02.jpg')">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="mini-title inner-style-2">
                        <h3>Shop </h3>
                        <p><a href="product-shop.php">Home</a> <span class="fa fa-angle-right"></span> <a href="#">Shop </a></p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="shop-area">
        <div class="container">
            <div class="row">
                <div class="col-md-12  col-lg-3">147
                    <div class="blog-sideber">
                        <div class="widget clearfix">
                            <div class="blog-search">
                                <form action="" class="clearfix" method="POST" id="form_search">
                                    <input type="search" placeholder="Search Here.." name="search" id="search">

                                    <button type="submit">
                                        <span class="pe-7s-search"></span>
                                    </button>

                                </form>
                                <ul class="list-group" id="list_search">

                                </ul>
                            </div>
                        </div>
                        <div class="widget clearfix">
                            <div class="sideber-title">
                                <h4> Delivered duty paid </h4>
                            </div>
                            <div class="sideber-content">
                                <ul>

                                    <li>
                                        <input type='checkbox' id='ddp' name='ddp' <?= ($ddp == 1) ? "checked" : "" ?>>
                                        <label for='ddp'> Delivered duty paid (DDP)</label>
                                    </li>

                                </ul>
                            </div>
                        </div>
                        <div class="widget clearfix">
                            <div class="sideber-title">
                                <h4>Categories</h4>
                            </div>
                            <div class="sideber-content">
                                <ul>
                                    <li> <a href='product-shop.php'><i class='fa fa-angle-right'></i> All</a> </li>

                                    <?php
                                    include './Config.php';
                                    $query = "select * from category limit 6";
                                    $result = $conn->query($query);
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            $category_name = $row['CATEGORY_NAME'];
                                            $category_id = $row['CATEGORY_ID'];
                                            echo "<li> <a href='product-shop.php?id=$category_id$id_ddp$sp_id'><i class='fa fa-angle-right'></i> $category_name</a> </li>";
                                        }
                                    }

                                    ?>

                                </ul>
                            </div>
                        </div>

                        <div class="widget clearfix">
                            <div class="sideber-title">
                                <h4>Vendor</h4>
                            </div>
                            <div class="sideber-content">
                                <ul>
                                    <li> <a href='product-shop.php'><i class='fa fa-angle-right'></i> All</a> </li>

                                    <?php
                                    include './Config.php';
                                    $query = "select * from sponsor";
                                    $result = $conn->query($query);
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            $sponsor_name = $row['SPONSOR_NAME'];
                                            $sponsor_id = $row['SPONSOR_ID'];
                                            echo "<li> <a href='product-shop.php?sp_id=$sponsor_id$id$id_ddp'><i class='fa fa-angle-right'></i> $sponsor_name</a> </li>";
                                        }
                                    }
                                    ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 col-lg-9">
                    <div class="shop-right-area">

                        <div class="shop-tab-area">

                            <div class="tab-content">
                                <div class="row tab-pane active" id="grid">
                                    <?php
                                    include 'Config.php';
                                    $result = $conn->query($queryP);
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            $product_id = $row["PRODUCT_ID"];
                                            $title = $row["TITLE"];
                                            $category_id = $row["CATEGORY_ID"];
                                            $photo = $row["PHOTO"];
                                            $product_link = $row["PRODUCT_LINK"];
                                            $product_short = $row["PRODUCT_SHORT"];
                                            $product_price = $row["PRODUCT_PRICE"];
                                            $sponsor = $row["SPONSOR_NAME"];
                                            if (strlen($product_short) > 50) {
                                                $product_short = substr($product_short, 0, 50);
                                            }
                                            if (strlen($title) > 20) {
                                                $title = substr($title, 0, 20);
                                            } ?>
                                            <div class='col-md-4 col-sm-6 col-xs-12'>
                                                <div class='product-item'>
                                                    <div class='product-image'>
                                                        <a class='product-img' href='shop-single.php?id=<?= $product_id ?>'>
                                                            <span><?= $sponsor ?></span>
                                                            <img class='primary-img' src='<?= $photo ?>' alt='' />
                                                        </a>
                                                    </div>

                                                    <div class='product-action'>
                                                        <h4><a href='shop-single.php?id=<?= $product_id ?>'><?= $title ?> ...</a></h4>
                                                        <p><?= $product_short ?> ...</p>
                                                        <span class='price'>$ <?= $product_price ?></span>
                                                    </div>
                                                    <div class='pro-action'>
                                                        <ul>
                                                            <li>
                                                                <a href='#'>
                                                                    <i class='fa fa-retweet' aria-hidden='true'></i>
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href='#'>
                                                                    <i class='fa fa-heart' aria-hidden='true'></i>
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a class='' href='<?= $product_link ?>' target='_blank'>
                                                                    <i class='fa fa-shopping-cart' aria-hidden='true'></i>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                    <?php
                                        }
                                    }
                                    ?>

                                </div>

                            </div>

                            <nav aria-label="Page navigation example" style="display: flex;justify-content: center;">
                                <ul class="pagination">
                                    <li class="page-item <?= ($currentPage == 1) ? "hidden" : "" ?>"><a class="page-link" href="product-shop.php?page=<?= $currentPage - 1 . $id . $sp_id ?>">Previous</a></li>
                                    <li class="page-item <?= ($currentPage - 5 <= 1) ? "hidden" : "" ?>">
                                        <a class="page-link" href="product-shop.php?page=<?= $currentPage - 5 . $id . $sp_id  ?>">...</a>
                                    </li>
                                    <?php for ($page = $currentPage; $page <= $last_page; $page++) : ?>
                                        <!-- Lien vers chacune des pages (activé si on se trouve sur la page correspondante) -->
                                        <li class="page-item <?= ($currentPage == $page) ? "active" : "" ?>">
                                            <a href="product-shop.php?page=<?= $page . $id . $sp_id ?>" class="page-link"><?= $page ?></a>
                                        </li>
                                    <?php endfor ?>
                                    <li class="page-item <?= ($currentPage + 5 >= $pages) ? "hidden" : "" ?>">
                                        <a class="page-link" href="product-shop.php?page=<?= $currentPage + 5 ?>">...</a>
                                    </li>

                                    <li class="page-item <?= ($currentPage == $pages) ? "hidden" : "" ?>">
                                        <a class="page-link" href="product-shop.php?page=<?= $currentPage + 1 . $id . $sp_id ?>">Next</a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
    </section>

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



    <!-- Footer Style End -->


    <a href="#" class="scrollup"><i class="pe-7s-up-arrow" aria-hidden="true"></i></a>
    <!-- jQuery -->
    <?php
    include 'footer.php'
    ?>
    <!-- Footer Style End -->
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script>
        $(document).ready(
            function() {



                $('#form_search').submit(function(e) {
                    e.preventDefault();
                    $.ajax({
                        type: "POST",
                        url: 'search.php',
                        data: new FormData(this),
                        contentType: false,
                        cache: false,
                        processData: false,
                        success: function(response) {
                            $('#list_search').html(response);
                        }
                    })
                })
                $('#search').keyup(function() {
                    var text = $(this).val();

                    if (text != '') {
                        // e.preventDefault();
                        $.ajax({
                            type: "POST",
                            url: 'search.php',
                            data: {
                                search: text
                            },
                            success: function(response) {
                                $('#list_search').html(response);
                            }
                        })
                    } else {
                        $('#list_search').html('not found');
                    }

                })
                $('#ddp').change(function() {
                    if (this.checked) {
                        window.location.replace('product-shop.php?ddp=1')
                    } else {
                        window.location.replace('product-shop.php')
                    }
                })

            })
    </script>

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