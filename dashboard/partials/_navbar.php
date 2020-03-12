
<nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
  <div class="text-center navbar-brand-wrapper d-flex align-items-top justify-content-center">
    <a class="navbar-brand brand-logo" href="../home.php" style="text-decoration: white" >
<!--      <img src="assets/images/logo.svg" alt="logo" />-->
        <div class="card-text font-weight-bold" style="text-decoration: none" >AarogyaHomeCare</div>
    </a>
<!--    <a class="navbar-brand brand-logo-mini" href="../home.php">-->
<!--      <img src="assets/images/logo-mini.svg" alt="logo" />-->
<!--    </a>-->
  </div>
  <div class="navbar-menu-wrapper d-flex align-items-center">
    <ul class="navbar-nav">
      <li class="nav-item font-weight-semibold ">
          <i class="ion-ios-menu" style="font-size: 20px;" id="sidebar_toggle"></i>
      </li>
    </ul>

    <ul class="navbar-nav ml-auto">
      <li class="nav-item dropdown d-none d-xl-inline-block user-dropdown " id="droplist">
        <a class="nav-link dropdown-toggle" id="UserDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
          <img class="img-xs rounded-circle" src="assets/images/faces/profile_alt.png" alt="Profile image"> </a>
        <div class="dropdown-menu dropdown-menu-right navbar-dropdown " aria-labelledby="UserDropdown">
          <div class="dropdown-header text-center">
            <img class="img-md rounded-circle" src="assets/images/faces/profile_alt.png" alt="Profile image">
            <?php
                if(isset($_SESSION)){
                    if(isset($_SESSION['user']) && isset($_SESSION['email'])){
                        ?>
                        <p class="mb-1 mt-3 font-weight-semibold"><?php echo $_SESSION['user']; ?></p>
                        <p class="font-weight-light text-muted mb-0"><?php echo $_SESSION['email']; ?></p>
                        <?php
                    }
                }else{
                    session_start();
                    if(isset($_SESSION['user']) && isset($_SESSION['email'])){
                        ?>
                        <p class="mb-1 mt-3 font-weight-semibold"><?php echo $_SESSION['user']; ?></p>
                        <p class="font-weight-light text-muted mb-0"><?php echo $_SESSION['email']; ?></p>
                        <?php
                    }
                }
            ?>
          </div>
<!--          <a class="dropdown-item">My Profile <span class="badge badge-pill badge-danger">1</span><i class="dropdown-item-icon ti-dashboard"></i></a>-->
<!--          <a class="dropdown-item">Messages<i class="dropdown-item-icon ti-comment-alt"></i></a>-->
<!--          <a class="dropdown-item">Activity<i class="dropdown-item-icon ti-location-arrow"></i></a>-->
          <a class="dropdown-item" href="../index.php">Home<i class="dropdown-item-icon ti-help-alt"></i></a>
          <a class="dropdown-item" href="../subadmin_login/admin_signout.php">Sign Out<i class="dropdown-item-icon ti-power-off"></i></a>
        </div>
      </li>
    </ul>
    <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
<!--      <span class="mdi mdi-menu"></span>-->
    </button>
  </div>
</nav>