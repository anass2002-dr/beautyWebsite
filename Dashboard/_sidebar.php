<nav class="sidebar sidebar-offcanvas" id="sidebar">
  <ul class="nav">
    <li class="nav-item">
      <a class="nav-link" href="index.php">
        <i class="ti-shield menu-icon"></i>
        <span class="menu-title">Dashboard</span>
      </a>
    </li>

    <li class="nav-item">
      <a class="nav-link" data-bs-toggle="collapse" href="#blogs" aria-expanded="false" aria-controls="auth">
        <i class="ti-smallcap menu-icon"></i>
        <span class="menu-title">Blogs</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="blogs">
        <ul class="nav flex-column sub-menu">
          <!-- <li class="nav-item"> <a class="nav-link" href="blogs.php"> New Blog </a></li> -->
          <li class="nav-item"> <a class="nav-link" href="blogs_html.php"> New Blog</b> </a></li>
          <li class="nav-item"> <a class="nav-link" href="list_blog.php"> Blogs List </a></li>

        </ul>
      </div>
    </li>


    <li class="nav-item">
      <a class="nav-link" data-bs-toggle="collapse" href="#Product" aria-expanded="false" aria-controls="auth">
        <i class="ti-shopping-cart menu-icon"></i>
        <span class="menu-title">Product</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="Product">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"> <a class="nav-link" href="product.php"> New Product</a></li>
          <li class="nav-item"> <a class="nav-link" href="list_product.php"> Products List </a></li>

        </ul>
      </div>
    </li>

    <li class="nav-item">
      <a class="nav-link" data-bs-toggle="collapse" href="#sponsor" aria-expanded="false" aria-controls="auth">
        <i class="ti-stats-up menu-icon"></i>
        <span class="menu-title">Sponsor</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="sponsor">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"> <a class="nav-link" href="sponsor.php"> New Sponsor</a></li>
          <li class="nav-item"> <a class="nav-link" href="list_sponsor.php"> Sponsors List </a></li>

        </ul>
      </div>
    </li>

    <li class="nav-item">
      <a class="nav-link" data-bs-toggle="collapse" href="#auth" aria-expanded="false" aria-controls="auth">
        <i class="ti-user menu-icon"></i>
        <span class="menu-title">Users setting</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="auth">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"> <a class="nav-link" href="user.php"> Add User </a></li>
          <li class="nav-item"> <a class="nav-link" href="list_user.php"> List users </a></li>
        </ul>
      </div>
    </li>

  </ul>
</nav>