
<!--<nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex flex-row">-->
<!--  <div class="text-center navbar-brand-wrapper d-flex align-items-top ">-->
<!--    <a class="navbar-brand brand-logo" href="../../index.php" style="text-decoration: white" >-->
<!--        <div class="card-text font-weight-bold" style="text-decoration: none" >AarogyaHomeCare</div>-->
<!--    </a>-->
<!--  </div>-->
<!--  <div class="navbar-menu-wrapper d-flex align-items-center">-->
<!--    <ul class="navbar-nav ml-auto">-->
<!--      <li class="nav-item dropdown user-dropdown " id="droplist">-->
<!--        <a class="nav-link dropdown-toggle" id="UserDropdown" href="#" data-toggle="dropdown" aria-expanded="false">-->
<!--          <img class="img-xs rounded-circle" src="../../dashboard/assets/images/faces/profile_alt.png" alt="Profile image"> </a>-->
<!--        <div class="dropdown-menu dropdown-menu-right navbar-dropdown " aria-labelledby="UserDropdown">-->
<!--          <div class="dropdown-header text-center">-->
<!--            <img class="img-md rounded-circle" src="../../dashboard/assets/images/faces/profile_alt.png" alt="Profile image">-->
<!--            --><?php
//                if(isset($_SESSION)){
//                    if(isset($_SESSION['nurse_regId']) && isset($_SESSION['nurse_name'])){
//                        ?>
<!--                        <p class="mb-1 mt-3 font-weight-semibold">--><?php //echo $_SESSION['nurse_name']; ?><!--</p>-->
<!--                        <p class="font-weight-light text-muted mb-0 text-capitalize">--><?php //echo $_SESSION['nurse_regId']; ?><!--</p>-->
<!--                        --><?php
//                    }
//                }else{
//                    session_start();
//                    if(isset($_SESSION['nurse_regId']) && isset($_SESSION['nurse_name'])){
//                        ?>
<!--                        <p class="mb-1 mt-3 font-weight-semibold">--><?php //echo $_SESSION['nurse_name']; ?><!--</p>-->
<!--                        <p class="font-weight-light text-muted mb-0">--><?php //echo $_SESSION['nurse_regId']; ?><!--</p>-->
<!--                        --><?php
//                    }
//                }
//            ?>
<!--          </div>-->
<!--          <a class="dropdown-item" href="../index.php">Home<i class="dropdown-item-icon ti-help-alt"></i></a>-->
<!--          <a class="dropdown-item" href="temp_signOut.php">Sign Out<i class="dropdown-item-icon ti-power-off"></i></a>-->
<!--        </div>-->
<!--      </li>-->
<!--    </ul>-->
<!--    <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">-->
<!--    </button>-->
<!--  </div>-->
<!--</nav>-->



<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">Navbar</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Link</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Dropdown
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="#">Action</a>
                    <a class="dropdown-item" href="#">Another action</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">Something else here</a>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
            </li>
        </ul>

    </div>
</nav>