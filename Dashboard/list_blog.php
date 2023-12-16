<?php
include 'Config_dashboard.php';
$query = "";
$search = "";
$premier = "";
$pages = "";
$sql = "";
$last_page = "";

if (isset($_POST['search'])) {
  $currentPage = 1;

  $search = $_POST['search'];


  // On détermine le nombre total d'blog
  $sql = 'SELECT COUNT(*) AS nb_blog FROM `blog` where TITLE like "%' . $search . '%"';

  $result = $conn->query($sql);
  $row = mysqli_fetch_assoc($result);

  $nbblog = (int) $row['nb_blog'];


  // On calcule le nombre de pages total
  $pages = ceil($nbblog / $parPage);

  // Calcul du 1er article de la page
  $premier = ($currentPage * $parPage) - $parPage;
  $parPage = 12;
  if ($pages > 6) {
    $last_page = $currentPage + 6;
  } else {
    $last_page = $pages;
  }

  if ($last_page >= $pages) {
    $last_page = $pages;
  }

  $query = 'SELECT b.BLOG_ID,b.TITLE,c.CATEGORY_NAME,b.PRODUCT_LINK,b.CREATED_DATE FROM blog as b INNER JOIN category as c
      ON b.CATEGORY_ID = c.CATEGORY_ID  where TITLE like "%' . $search . '%" order by CREATED_DATE ASC LIMIT ' . $premier . ',' . $parPage;
} else {
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
  if ($pages > 6) {
    $last_page = $currentPage + 6;
  } else {
    $last_page = $pages;
  }

  if ($last_page >= $pages) {
    $last_page = $pages;
  }
  $query = "SELECT b.BLOG_ID,b.TITLE,c.CATEGORY_NAME,b.PRODUCT_LINK,b.CREATED_DATE FROM blog as b INNER JOIN category as c
    ON b.CATEGORY_ID = c.CATEGORY_ID order by CREATED_DATE ASC LIMIT $premier, $parPage;";
}
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
            <div class="col-6">
              <form action="list_blog.php" method="post">
                <div class="input-group mb-3">
                  <input type="text" class="form-control" name="search" placeholder="search by title" aria-label="search by title" aria-describedby="basic-addon2">
                  <div class="input-group-append">
                    <button class="btn btn-outline-secondary" type="submit">search</button>
                  </div>
                </div>
              </form>
            </div>

            <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <table class='table table-hover'>
                    <thead>
                      <tr>
                        <th scope='col'>BLOG_ID</th>
                        <th scope='col'>TITLE</th>
                        <th scope='col'>CATEGORY_NAME</th>
                        <th scope='col'>CREATED_DATE</th>
                        <th colspan="3"></th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php

                      $result = $conn->query($query);
                      $BLOG_ID = "";
                      $TITLE = "";
                      $CATEGORY_NAME = "";
                      $PRODUCT_LINK = "";
                      $CREATED_DATE = "";
                      $BLOG_ID_SELECTED = "";
                      if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                          $BLOG_ID = $row["BLOG_ID"];
                          $TITLE = $row["TITLE"];
                          $CATEGORY_NAME = $row["CATEGORY_NAME"];
                          $PRODUCT_LINK = $row["PRODUCT_LINK"];
                          $CREATED_DATE = $row["CREATED_DATE"];
                          if (strlen($TITLE) > 20) {
                            $TITLE = substr($TITLE, 0, 20);
                            $TITLE = $TITLE . '...';
                          }
                          echo "<tr>
                                <th scope='row'>$BLOG_ID</th>
                                <td>$TITLE</td>
                                <td>$CATEGORY_NAME</td>
                                <td>$CREATED_DATE</td>
                                <td><a href='update_blog.php?id=$BLOG_ID' class='update btn text-light' style='background-color:#00e7a1;' id='update_<?= $BLOG_ID ?>' data-id='$BLOG_ID' >update</A>
                                </td>
                                <td><button class='delete btn text-light' style='background-color:red;' id='del_<?= $BLOG_ID ?>' data-id='$BLOG_ID' >Delete</button>
                                </td>
                                <td><a class='btn ' style='background-color:orange;color:white;' href='../blog-single.php?id=$BLOG_ID'>View product</a>
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
          <nav aria-label="Page navigation example" style="display: flex;justify-content: center;">
            <ul class="pagination">
              <li class="page-item "<?= ($currentPage == 1) ? "hidden" : "" ?>><a class="page-link" href="list_blog.php?page=<?= $currentPage - 1 ?>">Previous</a></li>
              <li class="page-item "<?= ($currentPage - 5 <= 1) ? "hidden" : "" ?>>
                <a class="page-link" href="list_blog.php?page=<?= $currentPage - 5 ?>">...</a>
              </li>
              <?php for ($page = $currentPage; $page <= $last_page; $page++) : ?>
                <!-- Lien vers chacune des pages (activé si on se trouve sur la page correspondante) -->
                <li class="page-item <?= ($currentPage == $page) ? "active" : "" ?>">
                  <a href="list_blog.php?page=<?= $page ?>" class="page-link"><?= $page ?></a>
                </li>
              <?php endfor ?>
              <li class="page-item "<?= ($currentPage + 5 >= $pages) ? "hidden" : "" ?>>
                <a class="page-link" href="list_blog.php?page=<?= $currentPage + 5 ?>">...</a>
              </li>

              <li class="page-item "<?= ($currentPage == $pages) ? "hidden" : "" ?>>
                <a class="page-link" href="list_blog.php?page=<?= $currentPage + 1 ?>">Next</a>
              </li>
            </ul>
          </nav>
        </div>

      </div>
      <div class="modal fade" id="mymodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-body" id="modal_body">
              Do you really want to delete this blog?
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" id="delete" data-bs-dismiss="modal">Delet</button>
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
              type: 'b'
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