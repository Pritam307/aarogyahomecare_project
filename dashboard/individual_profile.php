<?php
if(!isset($_SESSION)){
    session_start();
    if(!isset($_SESSION['user'])) {
        header('location:../subadmin_login/admin_login.php');
    }
}else{
    if(!isset($_SESSION['user'])){
        header('location:../subadmin_login/admin_login.php');
    }
}
?>
<?php include 'header_dash.php' ; ?>


<div class="row page-title-header">
    <div class="col-12">
        <div class="page-header">
            <h4 class="page-title">Dashboard</h4>
            <div class="quick-link-wrapper w-100 d-md-flex flex-md-wrap">
                <ul class="quick-links">
                    <li><a href="#">Nurse</a></li>
                    <li><a href="#">My Profile</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>



<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="row d-flex align-items-center">
                    <div class="col-4">
                        <div class="row d-flex justify-content-center">
                            <img src="../dashboard/assets/images/profile_placeholder.png" height="200" width="200" class="img-responsive rounded-circle">
                        </div>
                        <div class="row d-flex justify-content-center">
                            <button class="btn btn-primary">Give Attendence</button>
                        </div>
                    </div>
                    <div class="col-8 d-flex justify-content-center">
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <td class="font-weight-bold">Name</td>
                                    <td>sdsdsd</td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">Registration ID</td>
                                    <td>sdsdsd</td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">Email</td>
                                    <td>sdsdsd</td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">District</td>
                                    <td>sdsdsd</td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">Phone</td>
                                    <td>sdsdsd</td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">Gender</td>
                                    <td>sdsdsd</td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">Salary</td>
                                    <td>sdsdsd</td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">Date of Joining</td>
                                    <td>sdsdsd</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>





<?php include 'footer_dash.php' ; ?>


