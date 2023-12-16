<footer class="bg-faded">
    <div class="container">
        <div class="section-content">
            <div class="row margin-top-30">
                <div class="col-md-3">
                    <div class="footer-item footer-widget-one">
                        <img alt="" src="./img/beautymedic-test.png" class="footer-logo">
                        <p>Your satisfaction is our top priority. We actively listen to your feedback and needs, and we're always ready to make adjustments to ensure your happiness.</p>

                        <ul class="address">
                            <!-- <li><i class="pe-7s-call"></i>Phone: 001 (407) 901-6400</li> -->
                            <li><i class="pe-7s-mail"></i><a href="mailto:">Email: info@beautymedicare.com</a></li>
                        </ul>

                        <hr>
                        <ul class="social-icon bg-theme">
                            <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                            <li><a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                            <li><a href="#"><i class="bi bi-tiktok" aria-hidden="true"></i></a></li>
                            <li><a href="#"><i class="bi bi-pinterest" aria-hidden="true"></i></a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="footer-item">
                        <div class="footer-title">
                            <h4>Our Peges </h4>
                            <div class="border-style-2"></div>
                        </div>
                        <ul class="footer-list border-deshed color-icon">
                            <li><i class="pe-7s-angle-right"></i><a href="about-us.php">About Us</a></li>
                            <!-- <li><i class="pe-7s-angle-right"></i><a href="product-shop.php">Services</a></li> -->
                            <li><i class="pe-7s-angle-right"></i><a href="blog-grid.php">Blogs</a></li>
                            <li><i class="pe-7s-angle-right"></i><a href="contact-us.php">Contact</a></li>
                            <li><i class="pe-7s-angle-right"></i><a href="PrivacyPolicy.php">Privacy Policy</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="footer-item">
                        <div class="footer-title">
                            <h4>Our Services </h4>
                            <div class="border-style-2"></div>
                        </div>
                        <ul class="footer-list border-deshed color-icon">
                            <?php
                            include './Config.php';
                            $query = "select * from category limit 6";
                            $result = $conn->query($query);
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    $category_name = $row['CATEGORY_NAME'];
                                    $category_id = $row['CATEGORY_ID'];
                                    echo "<li><i class='pe-7s-angle-right'></i><a href='category.php?id=$category_id'>$category_name</a></li>";
                                }
                            }
                            ?>


                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </div>
</footer>

<section class="footer-copy-right bg-f9">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <p><a target="_blank" href="index.php">© Copyright 2023 - beautymedicare</a></p>
                <div class="container">
                    <!-- <button type="button" class="btn btn-info btn-round" data-toggle="modal" data-target="#loginModal">
                        Login
                    </button>   -->


                </div>
            </div>
        </div>
    </div>
</section>
<?php if (isset($_SESSION['user_mail']) and !empty($_SESSION['user_mail'])) { ?>
    <div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header border-bottom-0">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="d-flex flex-column text-center">
                        <form action="./index.php" method="POST">
                            <div class="form-group">
                                <p class="text-secondary">Add your email to receive the latest news about beauty products</p>

                                <input type="email" class="form-control rounded-4" id="user_mail" placeholder="Your email address..." name="user_mail">
                            </div>

                            <button type="submit" class="btn btn-info btn-block btn-round">Validate</button>
                        </form>


                    </div>
                </div>

            </div>
        </div>
    <?php } ?>
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>

    <script type="text/javascript">
        $(window).on('load', function() {
            setTimeout(function() {
                $('#loginModal').modal();
            }, 2000);

        });
        $(document).ready(
            function() {
                $('#validate').click
                $('#loginModal').click(function(e) {
                    var mail = $('#user_mail').val();
                    e.preventDefault();
                    $.ajax({
                        type: "POST",
                        url: 'add_mail.php',
                        data: {
                            user_mail: mail
                        },
                        contentType: false,

                        cache: false,
                        processData: false,
                        success: function(response) {
                            // $('#modal_body').text(response);

                            // $('#mymodal').modal('show');
                            console.log(response)
                        }
                    })
                    $('#loginModal').on('hidden.bs.modal', function() {
                        window.location.href = 'list_user.php';
                    })
                })



            })
    </script>