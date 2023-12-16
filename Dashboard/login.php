<?php 
  session_start();
  
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
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth px-0">
        <div class="row w-100 mx-0">
          <div class="col-lg-4 mx-auto">
            <div class="auth-form-light text-left py-5 px-4 px-sm-5">
              <div class="brand-logo">
                <img src="../img/logo-beauty.png" alt="logo">
              </div>
              <h6 class="font-weight-light">Sign in to continue.</h6>
              <form class="pt-3" method="POST" action="login_check.php">
                
                <?php
                    if(isset($_SESSION["username"])){
                      $username=$_SESSION["username"];
                      echo "<div class='form-group'> <input type='email' class='form-control form-control-lg' id='username' placeholder='Username' name='username' value='$username'></div>";
                    }
                    else{
                      echo "<div class='form-group'> <input type='email' class='form-control form-control-lg' id='username' placeholder='Username' name='username'></div>";
                    }
                    if(isset($_SESSION["password"])){
                      $password=$_SESSION["password"];
                      echo "<div class='form-group'>
                      <input type='password' class='form-control form-control-lg' id='password' placeholder='Password' name='password' value='$password'>
                      </div>";
                    }
                    else{
                      echo "<div class='form-group'>
                      <input type='password' class='form-control form-control-lg' id='password' placeholder='Password' name='password'>
                      </div>";
                    }
                  
                ?>
                <div class="mt-3">
                  <button type="submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">SIGN IN</button>
                </div>
                <div class="form-check">
                  <label class="form-check-label text-muted">
                    <input type="checkbox" class="form-check-input">
                    Keep me signed in
                  </label>
                </div>

              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- plugins:js -->
  <script src="vendors/base/vendor.bundle.base.js"></script>
  <!-- endinject -->
  <!-- inject:js -->
  <script src="js/off-canvas.js"></script>
  <script src="js/hoverable-collapse.js"></script>
  <script src="js/template.js"></script>
  <script src="js/todolist.js"></script>
  <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
  <script>
    $(document).ready(function() {

      // Delete 
      // $('form').submit(function(e) {
      //   // Delete id
      //   $.ajax({
      //     url: 'login_check.php',
      //     type: 'POST',
      //     data: new FormData(this),
      //     contentType: false,
      //     cache: false,
      //     processData: false,
      //     success: function(response) {
      //       alert(response);
      //     }
      //   });



      // });
    });
  </script>
  <!-- endinject -->
</body>

</html>