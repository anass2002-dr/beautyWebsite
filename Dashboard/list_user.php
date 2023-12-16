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
                                    <table class='table table-hover'>
                                        <thead>
                                            <tr>
                                                <th scope='col'>USER ID</th>
                                                <th scope='col'>FIRST NAME</th>
                                                <th scope='col'>LAST NAME</th>
                                                <th scope='col'>EMAIL</th>
                                                <th scope='col'>PASSWORD</th>
                                                <th scope='col'>PHONE NUMBER</th>
                                                <th colspan="2"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $query = "SELECT * FROM user ";
                                            $result = $conn->query($query);

                                            if ($result->num_rows > 0) {
                                                while ($row = $result->fetch_assoc()) {
                                                    $user_id = $row["USER_ID"];
                                                    $first_name = $row["FIRST_NAME"];
                                                    $last_name = $row["LAST_NAME"];
                                                    $email = $row["EMAIL"];
                                                    $password = $row["PASSWORD"];
                                                    $phone_number = $row["PHONE_NUMBER"];
                                                    echo "<tr>
                                <th scope='row'>$user_id</th>
                                <td>$first_name</td>
                                <td>$last_name</td>
                                <td>$email</td>
                                <td>$password</td>
                                <td>$phone_number</td>
                                <td><a href='update_user.php?id=$user_id' class='update btn text-light' style='background-color:#00e7a1;' id='update_<?= $user_id ?>' data-id='$user_id' >update</A>
                                </td>
                                <td><button class='delete btn text-light' style='background-color:red;' id='del_<?= $user_id ?>' data-id='$user_id' >Delete</button>
                                </td>
                               
                              </tr>
                          ";
                                                }
                                            }

                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="modal fade" id="mymodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-body" id="modal_body">
                            Do you really want to delete this user?<br>
                            <h2 class="text-warning">Warning</h2>
                           <!-- <span class="text-danger">By removing this user, all products linked to this sponsor are also removed!!!</span> -->
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" id="delete" data-bs-dismiss="modal">Delete</button>
                            <button type="button" class="btn btn-secondary" id="Cancel" data-bs-dismiss="modal">Cancel</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- content-wrapper ends -->
            <!-- partial:_footer.html -->

            <!-- partial -->
        </div>
        <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
    </div>
    <?php
    include '_footer.php'
    ?>
    <!-- container-scroller -->
    <!-- plugins:js -->
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
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {

            // Delete 
            $('.delete').click(function() {
                var el = this;

                // Delete id
                var deleteid = $(this).data('id');

                // Confirm box
                $('#mymodal').modal('show');
                $('#delete').click(function() {
                    $.ajax({
                        url: 'delete.php',
                        type: 'POST',
                        data: {
                            id: deleteid,
                            type:'u'
                        },
                        success: function(response) {
                            location.reload();
                        }
                    });
                });


            });
        });
    </script>
</body>

</html>