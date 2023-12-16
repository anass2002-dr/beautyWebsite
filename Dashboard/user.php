<?php
include 'Config_dashboard.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- plugins:css -->
    <?php
    include 'style.php'
    ?>
</head>

<body>
    <!-- https://wordtohtml.net/ -->
    <!-- https://onlinehtmleditor.dev/ -->
    <div class="container-scroller">
        <!-- partial:_navbar.html -->
        <?php
        include '_navbar.php'
        ?>
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <!-- partial:_sidebar.html -->
            <?php
            include '_sidebar.php'
            ?>
            <!-- partial -->
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="row">
                        <div class="col-md-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title"> New User</h4>

                                    <form class="forms-sample" method="post" action="insertUser.php" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label for="fisrt_name">First name</label>
                                            <input type="text" class="form-control" id="first_name" placeholder="First name" name="first_name" >
                                        </div>
                                        <div class="form-group">
                                            <label for="last_name">Last name</label>
                                            <input type="text" class="form-control" id="last_name" placeholder="Last name" name="last_name" >
                                        </div>
                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input type="email" class="form-control" id="email" placeholder="Email" name="email" require>
                                        </div>
                                        <div class="form-group">
                                            <label for="password">Password</label>
                                            <input type="password" class="form-control" id="password" placeholder="Password" name="password" >
                                        </div>
                                        <div class="form-group">
                                            <label for="phone_number">Phone Number</label>
                                            <input type="text" class="form-control" id="phone_number" placeholder="Phone Number" name="phone_number">
                                        </div>
                                        <div class="form-group m-4">
                                            <button type="submit" class="btn btn-primary me-2 text-light" id="submit">Add</button>
                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <!-- Modal -->

                <div class="modal fade" id="mymodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-body" id="modal_body">

                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-success" data-bs-dismiss="modal">Ok</button>

                            </div>
                        </div>
                    </div>
                </div>

                <!-- content-wrapper ends -->
                <!-- partial:_footer.html -->
                <?php
                include '_footer.php'
                ?>
                <!-- partial -->
            </div>
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script>
        $(document).ready(
            function() {



                $('form').submit(function(e) {
                    e.preventDefault();
                    $.ajax({
                        type: "POST",
                        url: 'insertUser.php',
                        data: new FormData(this),
                        contentType: false,

                        cache: false,
                        processData: false,
                        success: function(response) {
                            $('#modal_body').text(response);

                            $('#mymodal').modal('show');
                            console.log(response)
                        }
                    })
                    $('#mymodal').on('hidden.bs.modal', function() {
                        location.reload();
                    })
                })
                // $('#submit').click(function(e){


                // })

            })
    </script>
    <script src="vendors/base/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- inject:js -->
    <script src="js/off-canvas.js"></script>
    <script src="js/hoverable-collapse.js"></script>
    <script src="js/template.js"></script>
    <script src="js/todolist.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page-->
    <script src="js/file-upload.js"></script>
    <!-- End custom js for this page-->
</body>

</html>