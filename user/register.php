<?php include('register_server.php');
//forEach(hash_algos() as $v){
//    echo $v."<br>";
//}
echo $fail;
echo $success;

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Register | AarogyaHomeCare</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="../dashboard/assets/vendors/iconfonts/mdi/css/materialdesignicons.min.css">
<!--    <link rel="stylesheet" href="../dashboard/assets/vendors/iconfonts/ionicons/css/ionicons.css">-->
<!--    <link rel="stylesheet" href="../dashboard/assets/vendors/iconfonts/typicons/src/  font/typicons.css">-->
<!--    <link rel="stylesheet" href="../dashboard/assets/vendors/iconfonts/flag-icon-css/css/flag-icon.min.css">-->
<!--    <link rel="stylesheet" href="../dashboard/assets/vendors/css/vendor.bundle.base.css">-->
<!--    <link rel="stylesheet" href="../dashboard/assets/vendors/css/vendor.bundle.addons.css">-->
    <!-- endinject -->

    <link rel="stylesheet" href="../dashboard/assets/css/shared/style.css">

  </head>
  <body>

    <div class="container-scroller">
      <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="content-wrapper d-flex align-items-center auth register-bg-1 theme-one">

          <div class="row w-100">
            <div class="col-lg-4 mx-auto">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong><?php echo $fail; ?></strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
              <h2 class="text-center mb-4">User Registration</h2>
              <div class="auto-form-wrapper">
                <form action="register.php" method="post">
                  <div class="form-group">
                    <div class="input-group">
                      <input type="text" name="username" class="form-control" placeholder="Username" required>
                      <div class="input-group-append">
                        <span class="input-group-text">
                          <i class="mdi mdi-check-circle-outline"></i>
                        </span>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="input-group">
                      <input type="text" name="mobile" class="form-control" placeholder="Mobile Number" required>
                      <div class="input-group-append">
                        <span class="input-group-text">
                          <i class="mdi mdi-check-circle-outline"></i>
                        </span>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="input-group">
                      <input type="email" name="email" class="form-control" placeholder="Email" required>
                      <div class="input-group-append">
                        <span class="input-group-text">
                          <i class="mdi mdi-check-circle-outline"></i>
                        </span>
                      </div>
                    </div>
                  </div>
                <div class="form-group">
                    <div class="input-group">
                        <input type="text" name="district" class="form-control" placeholder="District" required>
                        <div class="input-group-append">
                    <span class="input-group-text">
                      <i class="mdi mdi-check-circle-outline"></i>
                    </span>
                        </div>
                    </div>
                </div>
                  <div class="form-group">
                    <div class="input-group">
                      <input type="password" name="upass" class="form-control" placeholder="Password" required>
                      <div class="input-group-append">
                        <span class="input-group-text">
                          <i class="mdi mdi-check-circle-outline"></i>
                        </span>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="input-group">
                      <input type="password" name="conpass" class="form-control" placeholder="Confirm Password" required>
                      <div class="input-group-append">
                        <span class="input-group-text">
                          <i class="mdi mdi-check-circle-outline"></i>
                        </span>
                      </div>
                    </div>
                  </div>
                  <div class="form-group d-flex justify-content-center">
                    <div class="form-check form-check-flat mt-0">
                      <label class="form-check-label">
                        <input type="checkbox" id="regagree" class="form-check-input" > I agree to the terms </label>
                    </div>
                  </div>
                  <div class="form-group">
                    <button id="regbtn" type="submit" name="regbtn" class="btn btn-primary submit-btn btn-block">Register</button>
                  </div>
                  <div class="text-block text-center my-3">
                    <span class="text-small font-weight-semibold">Already have and account ?</span>
                    <a href="login.php" class="text-black text-small">Login</a>
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
    <script src="../dashboard/assets/vendors/js/vendor.bundle.base.js"></script>
    <script src="../dashboard/assets/vendors/js/vendor.bundle.addons.js"></script>
    <!-- endinject -->
    <!-- inject:js -->
    <script src="../dashboard/assets/js/shared/off-canvas.js"></script>
    <script src="../dashboard/assets/js/shared/misc.js"></script>
    <script src="../js/custom.js"></script>
    <!-- endinject -->
  </body>
</html>