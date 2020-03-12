<?php
session_start();
if(isset($_SESSION['user'])){
    header('location:../dashboard/home.php');
}
?>
<?php
include('../dbconnect.php');
$errors=array();

if(isset($_POST['adminlogin'])){
    $username=mysqli_real_escape_string($db,$_POST['uname']);
    $userpass=mysqli_real_escape_string($db,$_POST['urpass']);

    $uquery="SELECT username,password,email FROM sub_admins WHERE username='$username'";
    $row=mysqli_query($db,$uquery);
    $res=mysqli_fetch_assoc($row);
    $r=mysqli_num_rows($row);;
//    echo $res['email'];
    if($r>0){
        if(password_verify($userpass,$res['password'])){
//            echo $res['password'];
            session_start();
            $_SESSION['user']=$res['username'];
            $_SESSION['email']=$res['email'];
            $_SESSION['admin']=1;
            header("location:../dashboard/home.php");
        }else{
            $errors['pass_error']="Invalid Password";
//            echo mysqli_error($db);
        }
    }else{
        $errors['username_error']="Username does not exist";
        echo "Username does not exist";
    }


}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Login | AarogyaHomeCare</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="../dashboard/assets/vendors/iconfonts/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="../dashboard/assets/vendors/iconfonts/ionicons/css/ionicons.css">
    <link rel="stylesheet" href="../dashboard/assets/vendors/iconfonts/typicons/src/font/typicons.css">
    <link rel="stylesheet" href="../dashboard/assets/vendors/iconfonts/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="../dashboard/assets/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="../dashboard/assets/vendors/css/vendor.bundle.addons.css">
    <!-- endinject -->
    <!-- plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="../dashboard/assets/css/shared/style.css">
     <link rel="stylesheet" href="../css/signin.css">
    <!-- endinject -->
    <link rel="shortcut icon" href="../dashboard/assets/images/favicon.png" />
  </head>
  <body>
    <div class="container-scroller">
      <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="content-wrapper d-flex align-items-center auth auth-bg-1 theme-one">
          <div class="row w-100">
            <div class="col-lg-4 mx-auto">
                <div class="col-12 d-flex justify-content-center">
                    <a href="../index.php" style="text-decoration: none; color: black">Go back Home </a>
                </div>
              <div class="auto-form-wrapper">

                <form action=" " method="post" id="cus-validators">
                  <div class="form-group">
                    <label class="label">Username</label>
                    <div class="input-group">
                        <input type="text" name="uname" class="form-control" placeholder="Username">
                          <div class="input-group-append">
                            <span class="input-group-text">
                              <i class="mdi mdi-check-circle-outline"></i>
                            </span>
                          </div>
                    </div>
                    <p class="text-center"><?php if(isset($errors['username_error'])){echo $errors['username_error'];} ?></p>
                  </div>
                  <div class="form-group">
                    <label class="label">Password</label>
                    <div class="input-group">
                      <input type="password" name="urpass" class="form-control" placeholder="*********">
                      <div class="input-group-append">
                        <span class="input-group-text">
                          <i class="mdi mdi-check-circle-outline"></i>
                        </span>
                      </div>
                    </div>
                    <p class="text-center"><?php if(isset($errors['pass_error'])){echo $errors['pass_error'];} ?></p>
                  </div>
                  <div class="form-group">
                    <button type="submit" name="adminlogin" class="btn btn-primary submit-btn btn-block">Login</button>
                  </div>
                  <div class="text-block text-center my-3">
                    <span class="text-small font-weight-semibold">Not a member ?</span>
                    <a href="admin_register.php" class="text-black text-small">Create new account</a>
                  </div>
                </form>
              </div>
              <ul class="auth-footer">
                <li>
                  <a href="#">Conditions</a>
                </li>
                <li>
                  <a href="#">Help</a>
                </li>
                <li>
                  <a href="#">Terms</a>
                </li>
              </ul>
              <p class="footer-text text-center">copyright © 2019 SEWA Organisation. All rights reserved.</p>
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
    <!-- endinject -->
  </body>
</html>