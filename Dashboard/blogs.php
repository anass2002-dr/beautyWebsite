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
                  <h4 class="card-title"> New blog</h4>
                  <p class="card-description">
                    Create new blog
                  </p>
                  <form class="forms-sample" method="post" action="insertBlog.php" enctype="multipart/form-data">
                    <div class="form-group">
                      <label for="titel">Blog Title</label>
                      <input type="text" class="form-control" id="titel" placeholder="Title" name="title" require>
                    </div>
                    <div class="form-group">
                      <label for="category">blog category</label>
                      <select class="form-control form-control-lg" id="category" name="category">
                        <?php
                        $query = "select * from category";
                        $result = $conn->query($query);
                        if ($result->num_rows > 0) {
                          // OUTPUT DATA OF EACH ROW 
                          while ($row = $result->fetch_assoc()) {
                            echo "<option value=" . $row["CATEGORY_ID"] . ">" . $row["CATEGORY_NAME"] . "</option>";
                          }
                        } else {
                          echo "0 results";
                        }
                        ?>

                      </select>
                    </div>
                    <div class="mb-3">
                      <label for="photo" class="form-label">Add Cover Photo</label>
                      <label for="photo" class="form-label">Size :10x10cm</label>
                      <input class="form-control" type="file" id="photo" accept="image/png, image/jpeg, image/jpg" name="photo" require>
                    </div>
                    <div class="mb-3">
                      <label for="video" class="form-label">Add Video</label>
                      <input class="form-control" type="file" id="video" name="video" accept="video/mp4,video/x-m4v,video/*">
                    </div>
                    <div class="mb-3">
                      <label for="product_link" class="form-label">product link</label>
                      <input class="form-control" type="text" id="product_link" name="product_link" placeholder="add product link" require>
                    </div>
                    <div class="form-group fixed-end">
                      <!-- <label for="font_text">font text</label> -->
                      <select class="form-control w-25" id="font_text" name="font_text">
                        <option value="Arial">Arial</option>
                        <option value="Calibri">Calibri</option>
                        <option value="Comic, Sans MS">Comic Sans MS</option>
                        <option value="sans-serif">sans-serif</option>
                        <option value="Verdana, sans-serif">Verdana sans-serif</option>
                        <option value="Tahoma, sans-serif">Tahoma sans-serif</option>
                        <option value="Trebuchet MS, sans-serif">Trebuchet MS sans-serif</option>
                        <option value="Times New Roman, serif">Times New Roman serif</option>
                        <option value="Georgia, serif">Georgia serif</option>
                        <option value="Garamond, serif">Garamond serif</option>
                        <option value="Courier New monospace">Courier New monospace</option>
                        <option value="Brush Script MT cursive">Brush Script MT cursive</option>
                      </select>
                    </div>
                    <div class="mb-3 para_i">

                      <button type="button" class="btn border border-secondary" id="bold"><b>B</b></button>
                      <button type="button" class="btn border border-secondary" id="italic"><i class="ti-Italic"></i> </button>
                      <button type="button" class="btn border border-secondary" id="link"><i class="ti-link"></i> add link</button>
                      <input type="button" id="_h1" class="btn border border-secondary" value="H1">
                      <input type="button" id="_h2" class="btn border border-secondary" value="H2">
                      <input type="button" id="_h3" class="btn border border-secondary" value="H3">
                      <input type="button" id="_h4" class="btn border border-secondary" value="H4">
                      <input type="button" id="_h5" class="btn border border-secondary" value="H5">
                      <input type="button" id="_h6" class="btn border border-secondary" value="H6">
                      <button type="button" class="btn border border-secondary" id="list"><i class="ti-list"></i> </button>
                      <button type="button" class="btn border border-secondary" id="list-ol"><i class="ti-list-ol"></i> </button>
                      <input type="color" name="txt_color" id="txt_color" class="border border-dark" value="#ff0000">
                      <!-- <img src="" alt="" srcset="" id="img_inserted"> -->

                    </div>
                    <!-- <div class="mb-3 w-25">
                      <label for="photo" class="form-label">insert Photo</label>
                      <input class="form-control" type="file" id="insert_img" multiple name="photo">
                    </div> -->
                    <div class="form-group">
                      <label for="paragrah">Tape your blog</label>
                      <p id="paragrah" contenteditable="true" class="form-control">
                      </p>
                      <input type="text" hidden id="paragraph_hiden" name="blog">
                    </div>

                    <button type="submit" class="btn btn-primary me-2" id="submit">Submit</button>

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
    document.getElementById('txt_color').onchange = function() {
      // do whatever you want with value
      document.execCommand('foreColor', false, this.value)
    }
    document.getElementById('font_text').onchange = function() {
      // do whatever you want with value
      document.execCommand('fontName', false, this.value)
    }

    function link(url) {
      if (window.getSelection().toString()) {
        var a = document.createElement('a');
        a.href = url;

        window.getSelection().getRangeAt(0).surroundContents(a);
      } else {

        document.execCommand('createlink', false, url)
      }
    }
    var insert_link = document.getElementById('link').addEventListener('click', () => {
      var url = prompt('enter your link :')
      link(url)

    })


    $(document).ready(
      function() {


        $('form').submit(function(e) {
          $("#paragraph_hiden").val($("#paragrah").html())
          e.preventDefault();
          $.ajax({
            type: "POST",
            url: 'insertBlog.php',
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function(response) {
              // alert(response);
              $('#modal_body').text(response);

              $('#mymodal').modal('show');
              // location.reload();
            }
          })
          $('#mymodal').on('hidden.bs.modal', function() {
            location.reload();
          })

          // console.log($("#paragraph_hiden").val());

        })
        // $('#submit').click(function(e){


        // })
        function myFunction(para) {
          var selection = window.getSelection();
          var start = selection.anchorOffset;
          var end = selection.focusOffset;
          if (start >= 0 && end >= 0) {
            console.log("start: " + start);
            console.log("end: " + end);
          }
          var paragrah = $('#paragrah').html()
          var selectionBefore = paragrah.substring(0, start);
          var selection = paragrah.substring(start, end);
          var selectionAfter = paragrah.substring(end);
          var surrounder = selection.replace(selection, "<" + para + ">" + selection + "</" + para + ">");
          var newText = selectionBefore + surrounder + selectionAfter;
          $('#paragrah').html(newText)
        }

        function header_change(para, cp) {
          if (cp == 0) {
            document.execCommand('formatBlock', false, para);
            cp = 1
          } else {
            document.execCommand('formatBlock', false, 'p');
            cp = 0
          }
          // var h1 = prompt('Enter your title:');
          // if (h1 != null) {
          //   var paragrah = $('#paragrah').html()
          //   paragrah2 = paragrah + '<' + para + '>' + h1 + '</' + para + '>'
          //   console.log(paragrah2)
          //   $('#paragrah').html(paragrah2)
          // }

        }
        var cp = 0;
        $('#_h1').click(function() {
          header_change('h1', cp)
        })
        var cp2 = 0;
        $('#_h2').click(function() {
          header_change('h2', cp2)
        })
        var cp3 = 0;
        $('#_h3').click(function() {
          header_change('h3', cp3)
        })
        var cp4 = 0;
        $('#_h4').click(function() {
          header_change('h4', cp4)
        })
        var cp5 = 0;
        $('#_h5').click(function() {
          header_change('h5', cp5)
        })
        var cp6 = 0;
        $('#_h6').click(function() {
          header_change('h6', cp6)
        })
        $('#list').click(function() {
          document.execCommand('InsertUnorderedList')
        })
        $('#list-ol').click(function() {
          document.execCommand('insertorderedlist')
        })
        var clickB = 0;
        $('#bold').click(function() {
          document.execCommand("bold");
        })
        $('#italic').click(function() {
          document.execCommand("italic");
        })

        // $("#insert_img").on('change',function(){
        //   var selection = window.getSelection();
        //   var start = selection.anchorOffset;
        //   var end = selection.focusOffset;
        //   var paragrah = $('#paragrah').html()
        //   var selectionBefore = paragrah.substring(0, start);
        //   var selection = paragrah.substring(start, end);
        //   var selectionAfter = paragrah.substring(end);
        //   var surrounder = selectionBefore+ "<img src='" + this.val() + "'>";
        //   var newText = selectionBefore + surrounder + selectionAfter;
        //   $('#paragrah').html(newText)
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