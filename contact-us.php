<?php
use PHPMailer\PHPMailer\PHPMailer;
$msg = '';
if (array_key_exists('email', $_POST)) {
    require 'vendor/autoload.php';
    $mail = new PHPMailer;
    $mail->isSMTP();
    $mail->Host = 'smtp.hostinger.com';
    $mail->Port = 465;
    $mail->SMTPDebug = 0;
    $mail->SMTPAuth = false;
    $mail->Username = 'contact@beautymedicare.com';
    $mail->Password = 'Ana@21s$';
    $mail->setFrom($_POST['email'], $_POST['name']);
    $mail->addAddress('contact@beautymedicare.com', 'anass dermaj');
    if ($mail->addReplyTo($_POST['email'], $_POST['name'])) {
        $mail->Subject = 'PHPMailer contact form';
        $mail->isHTML(false);
        $mail->Body = <<<EOT
            Email: {$_POST['email']}
            Name: {$_POST['name']}
            Message: {$_POST['message']}
EOT;
        if (!$mail->send()) {
            $msg = 'Sorry, something went wrong. Please try again later.';
        } else {
            $msg = 'Message sent! Thanks for contacting us.';
        }
    } else {
        $msg = 'Share it with us!';
    }
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
                        <h3>Contact Us</h3>
                        <p><a href="index-one.html">Home</a> <span class="fa fa-angle-right"></span> <a href="#">Contact</a></p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="container">
            <div class="section-content">
                <div class="row">
                    <div class="col-md-7">
                        <div class="section-title margin-left-20 ">
                            <h6>Contact</h6>
                            <h2>Get in Touch</h2>
                            <div class="small-line-border-2"></div>
                        </div>
                        <form id="" method="post" action="">
                            <div class="col-md-6">
                                <input type="text" name="name" id="name" class="form-control" placeholder="Your Name" required>
                            </div>
                            <div class="col-md-6">
                                <input type="email" name="email" id="email" class="form-control" placeholder="Your Email" required>
                            </div>
                            <div class="col-md-12">
                                <input type="text" name="subject" class="form-control" placeholder="Subject" id="subject" required>
                            </div>
                            <div class="col-md-12">
                                <div class="contact-textarea">
                                    <textarea class="form-control" rows="6" placeholder="Wright Message" id="message" name="message" required></textarea>
                                    <button class="btn btn-theme" type="submit" value="Submit Form">Send Message</button>
                                </div>
                            </div>
                            <div id="form-messages"></div>
                        </form>
                    </div>
                    <!-- <div class="col-md-5 contact-info margin-top-60">
                        <div class="service-item style-1 bg-f8">
                            <div class="service-icon">
                                <i class="pe-7s-map"></i>
                            </div>
                            <div class="content">
                                <h5><a href="#" class="color-333">Contact Info</a></h5>
                                <p>5B Streat, City 50987 New Town US, <br>Khulna, BD</p>
                            </div>
                        </div>
                        <div class="service-item style-1 bg-f8">
                            <div class="">
                                <i class="pe-7s-clock"></i>
                            </div>
                            <div class="content">
                                <h5><a href="#" class="color-333">Business Hours</a></h5>
                                <p>Monday-Friday: 10am to 8pm <br>Saturday: 11am to 3pm</p>
                            </div>
                        </div>
                        <div class="service-item style-1 bg-f8">
                            <div class="">
                                <i class="pe-7s-mail-open"></i>
                            </div>
                            <div class="content">
                                <h5><a href="#" class="color-333">Email</a></h5>
                                <p>info@bdcoder.com <br> set-info@bdcoder.com </p>
                            </div>
                        </div>
                    </div> -->
                </div>
            </div>
        </div>
    </section>

    <!-- divider start -->
    <?php include 'email-service.php'?>
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
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js"></script>
    <script type="text/javascript" src="js/map.js"></script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAsTvi2dmx_Bnel6F0POzTg6-TaQ16JeDs&amp;callback=initMap" type="text/javascript"></script>


    <!-- Main Custom JS -->
    <script type="text/javascript" src="js/script.js"></script>


</body>



</html>