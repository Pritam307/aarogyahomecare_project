<?php

include '../../dbconnect.php';
$login_error = null;
if(isset($_POST['subLogBtn'])){
    $regId = mysqli_real_escape_string($db,$_POST['regNum']);
    $district = mysqli_real_escape_string($db,$_POST['ndist']);

    $check_login = "SELECT * FROM nurses WHERE regId='$regId' AND district='$district'";
    $login_res = mysqli_query($db,$check_login);
    $login_info = mysqli_fetch_assoc($login_res);
    $r_rows = mysqli_num_rows($login_res);

    if($r_rows>0){
       session_start();
       $_SESSION['nurse_name']=$login_info['fname']." ".$login_info['lname'];
       $_SESSION['nurse_regId']=$login_info['regId'];
       $_SESSION['nurse'] = true;
       header("location:individual_profile.php");
     }else{
        $login_error = "Invalid Registration Id or District";
//        echo "Invalid Info";
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
    <link rel="stylesheet" href="../assets/vendors/iconfonts/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="../assets/vendors/iconfonts/ionicons/css/ionicons.css">
    <link rel="stylesheet" href="../assets/vendors/iconfonts/typicons/src/font/typicons.css">
    <link rel="stylesheet" href="../assets/vendors/iconfonts/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="../assets/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="../assets/vendors/css/vendor.bundle.addons.css">

    <link rel="stylesheet" href="../assets/css/shared/style.css">
    <!-- endinject -->
    <link rel="shortcut icon" href="../assets/images/favicon.png" />
</head>
<body>
<div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper d-flex align-items-center">
        <div class="col-12 d-flex justify-content-center">
            <div class="card border-0" style="width: 95vw; border-radius: 20px" >
                <div class="card-body">
                    <div class="row-4 py-3 border d-flex justify-content-center" style="background-color: #ace7ff">
                        <img src="../../img/logo.png" class="img-fluid img-responsive" style="width: 50%; height: 50%">
                    </div>
                    <div class="row-7 border-dark">
                        <div class="container-fluid border py-3 align-items-center">
                            <form action="" method="post">
                                <div class="form-group">
                                    <label for="exampleInputEmail1" style="display: none"></label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" name="regNum" required placeholder="Enter Employee ID/Registration Number">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1" style="display: none"></label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" name="ndist" required placeholder="Enter District">
                                </div>
                                <?php if(isset($login_error)){
                                    ?>
                                        <div class="row-1 my-2">
                                            <div class="card-text text-center" style="color: red; font-size: 13px;"><?php echo $login_error ?></div>
                                        </div>
                                    <?php
                                } ?>
                                <div class="d-flex justify-content-center">
                                    <button class="btn btn-outline-primary" name="subLogBtn">Login</button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- container-scroller -->
<!-- plugins:js -->
<script src="../assets/vendors/js/vendor.bundle.base.js"></script>
<script src="../assets/vendors/js/vendor.bundle.addons.js"></script>

<script src="../assets/js/shared/off-canvas.js"></script>

</body>
</html>



