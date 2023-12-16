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
                                    <h4 class="card-title"> Update Sponsor</h4>
                                    <form class='forms-sample' method='post' action='update.php' enctype='multipart/form-data'>
                                    <?php

                                    if (isset($_GET["id"])) {
                                        $id = $_GET["id"];
                                        $query="select * from sponsor where SPONSOR_ID=$id";
                                        $result=$conn->query($query);
                                        $row=mysqli_fetch_assoc($result);
                                        $sponsor_name = $row["SPONSOR_NAME"];
                                        $sponsor_url = $row["SPONSOR_URL"];
                                        
                
                                       
                                      }
                                    echo "
                                            <div class='form-group'>
                                                <label for='sponsor_name'>Sponsor name</label>
                                                <input hidden name='operation' value='sponsor'>
                                                <input hidden name='id' value='$id'>
                                                <input type='text' class='form-control' id='sponsor_name' placeholder='SPONSOR NAME' name='sponsor_name' value='$sponsor_name' require>
                                            </div>
                                            <div class='form-group'>
                                                <label for='sponsor_url'>Sponsor url</label>
                                                <input type='text' class='form-control' id='sponsor_url' placeholder='SPONSOR URL' name='sponsor_url' value='$sponsor_url' require>
                                            </div>
                                            <div class='mb-3'>
                                                <label for='photo' class='form-label'>Sponsor logo</label>
                                                <input class='form-control' type='file' id='photo' accept='image/png, image/jpeg, image/jpg' name='photo' require>
                                            </div>
                                            <div class='form-group'>
                                                <button type='submit' class='btn btn-primary me-2 text-light' id='submit'>Submit</button>
                                            </div>
                                        ";
                                ?>
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
                        url: 'update.php',
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
                        window.location.href = 'list_sponsor.php';
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