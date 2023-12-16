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
                  <h4 class="card-title"> update Blog</h4>
                  <p class="card-description">
                    Update your blog Using html code
                  </p>
                  <?php
                  // include '../Config.php';
                  if (isset($_GET["id"])) {
                    $id = $_GET["id"];
                    $query = "select * from blog where BLOG_ID=$id";
                    //    echo $query;
                    $result = $conn->query($query);
                    $row = mysqli_fetch_assoc($result);
                    $title = $row["TITLE"];
                    $blog = $row["CONTENT"];
                    $blog_short = $row["BLOG_SHORT"];
                    $blog_keywords = $row["BLOG_KEYWORDS"];
                    $product_link = $row["PRODUCT_LINK"];
                    $category_id = $row["CATEGORY_ID"];
                    $photo = $row["PHOTO"];
                    $video = $row["VIDEO"];
                  }
                  ?>
                  <form class='forms-sample' method='post' action='insertBlog.php' enctype='multipart/form-data'>
                    <div class='form-group'>
                      <input hidden name='operation' value='blog'>
                      <input hidden name='id' value='<?= $id ?>'>
                      <label for='titel'>Blog Title</label>
                      <input type='text' class='form-control' id='titel' placeholder='Title' name='title' require value='<?= $title ?>'>
                    </div>
                    <div class='form-group'>
                      <label for='category'>blog category</label>
                      <select class='form-control form-control-lg' id='category' name='category'>
                        <?php
                        $query = "select * from category";
                        $result = $conn->query($query);
                        if ($result->num_rows > 0) {
                          // OUTPUT DATA OF EACH ROW 
                          while ($row = $result->fetch_assoc()) {
                            if ($row["CATEGORY_ID"] == $category_id) {
                              echo "<option value=" . $row["CATEGORY_ID"] . " selected >" . $row["CATEGORY_NAME"] . "</option>";
                            } else {
                              echo "<option value=" . $row["CATEGORY_ID"] . ">" . $row["CATEGORY_NAME"] . "</option>";
                            }
                          }
                        } else {
                          echo "0 results";
                        }
                        ?>
                      </select>
                    </div>
                    <div class='mb-3'>
                      <label for='photo' class='form-label'>Add Cover Photo</label>
                      <input class='form-control' type='file' id='photo' accept='image/png, image/jpeg, image/jpg' name='photo' require>
                    </div>
                    <div class="mb-3">
                      <label for="photo_link" class="form-label text-danger">Or By Link</label>
                      <input class="form-control" type="text" id="photo_link" name="photo_link" placeholder="Add cover Link" value="<?= $photo ?>">
                    </div>
                    <div class='mb-3'>
                      <label for='video' class='form-label'>Add Video</label>
                      <input class='form-control' type='file' id='video' name='video' accept='video/mp4,video/x-m4v,video/*'>
                    </div>
                    <div class="mb-3">
                      <label for="video_link" class="form-label text-danger">Or Add Video By link</label>
                      <input class="form-control m-2" type="text" id="video_link" name="video_link" placeholder="Add video link" value="<?= $video ?>">
                    </div>
                    <div class='mb-3'>
                      <label for='photo_collection' class='form-label'>Add collecttion Photos</label>
                      <input class='form-control' type='file' id='photo_collection' accept='image/png, image/jpeg, image/jpg' name='photo_collection[]' multiple>
                    </div>
                    <div class="mb-3 " id="div_links">
                      <?php
                      $query_collection = "select * from collection_photos where BLOG_ID=$id";
                      $result = $conn->query($query_collection);
                      if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                      ?>
                          <input type="text" class="form-control m-2" name="collection_link[]" value="<?= $row['PHOTO_PATH'] ?>">

                          <!-- <textarea class="form-control" id="collection_links" name="collection_links" placeholder="https:\\www.google.com/photo2.jpg,https:\\www.google.com/photo2.jpg,https:\\www.google.com/photo3.jpg" rows="10"></textarea> -->
                      <?php
                        }
                      }

                      ?>
                      <div class="d-flex">
                        <input type="text" class="form-control m-2 w-25" name="nb_links" id="nb_links" placeholder="type Numbre of links">
                        <input type="button" class="btn btn-primary m-2 text-light" name="btn_links" id="btn_links" value="add new links">

                      </div>
                    </div>
                    <div class='mb-3'>
                      <label for='product_link' class='form-label'>product link</label>
                      <input class='form-control' type='text' id='product_link' name='product_link' placeholder='add product link' value='<?= $product_link ?>' require>
                    </div>
                    <div class='form-group'>
                      <label for='blog-short'>Enter your short Description</label>
                      <textarea name='blog_short' id='blog-short' class='form-control' rows='10'><?= $blog_short ?></textarea>
                    </div>
                    <div class='form-group'>
                      <label for='blog-keywords'>Enter KeyWords</label>
                      <textarea name='blog_keywords' id='blog-keywords' class='form-control' rows='10'><?= $blog_keywords ?></textarea>
                    </div>
                    <div class='form-group'>
                      <label for='blog'>Enter your html code</label>
                      <textarea name='blog' id='blog' class='form-control' rows='50'><?= $blog ?></textarea>
                    </div>

                    <div class='form-group'>
                      <button type='submit' class='btn btn-primary me-2 text-light' id='submit'>Submit</button>
                      <a href='./preveiw_blog.php' target='_blank' class='btn btn-success text-light'>Preview</a>

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
                <button type="submit" class="btn btn-success text-light" data-bs-dismiss="modal">Ok</button>

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
        $('#btn_links').click(function() {
          nb_links = $('#nb_links').val()
          nb_links = parseInt(nb_links)
          div_links = ''
          for (i = 1; i < nb_links + 1; i++) {
            div_links += '<input type="text" class="form-control m-2" name="collection_link[]" placeholder="add link ' + i + '">'
          }
          $('#div_links').append(div_links)
        })
        $('form').submit(function(e) {
          //   $("#paragraph_hiden").val($("#paragrah").text())
          e.preventDefault();
          $.ajax({
            type: "POST",
            url: 'update.php',
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function(response) {
              // console.log(response);
              $('#modal_body').text(response);

              $('#mymodal').modal('show');

              // location.reload();
            }
          })
          $('#mymodal').on('hidden.bs.modal', function() {
            window.location.href = 'list_blog.php';
          })



        })


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