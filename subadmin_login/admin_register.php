<?php
include_once '../dbconnect.php';
$errors=array();
$success=$fail=null;
$options=[ 'cost'=>12,];
if(isset($_POST['regbtn'])){
    $username=mysqli_real_escape_string($db,$_POST['username']);
    $newpass=mysqli_real_escape_string($db,$_POST['upass']);
    $conpass=mysqli_real_escape_string($db,$_POST['conpass']);
    $mobile=mysqli_real_escape_string($db,$_POST['mobile']);
    $email=mysqli_real_escape_string($db,$_POST['email']);
    $district = mysqli_real_escape_string($db,$_POST['district']);

    $passhash=password_hash($newpass,PASSWORD_BCRYPT,$options);

    $uquery="SELECT * FROM sub_admins WHERE username='$username' LIMIT 1";
    $res=mysqli_query($db,$uquery);
    $user=mysqli_fetch_assoc($res);
    if($user){
        $fail="Username Exists";
    }else{
        if($conpass==$newpass){
            $regquery="INSERT INTO sub_admins (username,password,mobile,email,district) VALUES ('$username','$passhash','$mobile','$email','$district')";
            if(mysqli_query($db,$regquery)){
//                header("location:../dashboard/home.php");
                $success="Registration Success";
            }else{
                $fail=mysqli_error($db);
            }
        }else{
            echo "Password Mismatch";
        }

    }

}
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
    <link rel="stylesheet" href="assets/vendors/iconfonts/font-awesome/css/font-awesome.css">
    <link rel="stylesheet" href="assets/vendors/iconfonts/font-awesome/css/font-awesome.min.css" />
    <link rel="stylesheet" href="assets/vendors/iconfonts/ionicons/css/ionicons.css">
    <link rel="stylesheet" href="../dashboard/assets/css/shared/style.css">
</head>
<body>

<div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="content-wrapper d-flex align-items-center auth register-bg-1 theme-one">

            <div class="row w-100">
                <div class="col-lg-4 mx-auto">
                    <?php
                        if(isset($success)){
                            ?>
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong><?php echo $success; ?></strong>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <?php
                        }else if(isset($fail)){
                            ?>
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <strong><?php echo $fail; ?></strong>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <?php
                        }
                    ?>
                    <div class="col-12 d-flex justify-content-center">
                        <a href="../index.php" style="text-decoration: none; color: black">Go back Home </a>
                    </div>
                    <div class="auto-form-wrapper">
                    <h4 class="text-center mb-3">User Registration</h4>
                        <form action=" " method="post">
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
                                <a href="admin_login.php" class="text-black text-small">Login</a>
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
