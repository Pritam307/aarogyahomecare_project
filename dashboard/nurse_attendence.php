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


<?php  include 'header_dash.php';
include_once '../dbconnect.php';
$nurse_regId=null;
$assigned_flag = false;
$nurse_duty_shift=null;
if(isset($_GET['reg_id'])){
    $nurse_regId=$_GET['reg_id'];
}
$num_rows = null;
$nurse_id_query = mysqli_query($db,"SELECT id FROM nurses WHERE regId='$nurse_regId'");
$nurse_id=mysqli_fetch_assoc($nurse_id_query)['id'];
//echo $nurse_id;

//check if nurse has any assignment
$check_assign = "SELECT * FROM patient_nurse_allocation WHERE nurse_id='$nurse_id'";
$assign_res = mysqli_query($db,$check_assign);
$num_rows = mysqli_num_rows($assign_res);
if($num_rows >0){
    $assigned_flag =true;
}

if($assigned_flag){
    $duty_query="SELECT Shift FROM nurse_duty_shift,patient_nurse_allocation WHERE nurse_duty_shift.id = patient_nurse_allocation.allocated_duty_shift AND patient_nurse_allocation.nurse_id='$nurse_id'";
    if($res=mysqli_query($db,$duty_query)){
        $val = mysqli_fetch_assoc($res);
        $num_rows= mysqli_fetch_row($res);
        $nurse_duty_shift=$val['Shift'];
    }
    $today=(int)date("d");
    $mon=(int)date("m");
    $year=(int)date("Y");
}

?>
    <div class="col-12 d-flex justify-content-center">
        <?php
            if($assigned_flag){
                ?>
                    <div class="card rounded w-50">
                        <div class="card-body border">
                            <div class="row d-flex justify-content-center">
                                <div class="col-6 d-flex justify-content-md-start">
                                    <div class="card-text">DUTY: <span class="font-weight-bold text-dark"> <?php echo $nurse_duty_shift;?></span></div>
                                </div>
                                <div class="col-6 d-flex justify-content-md-end">
                                    <div class="card-text font-weight-bold"><?php echo date("d-m-Y");  ?></div>
                                </div>
                            </div>
                            <div class="row mt-2 ">
                                <?php
                                    $q="SELECT clock_in,clock_out,present FROM nurse_attendence WHERE Day='$today' AND Year='$year' AND Month='$mon' AND nurse_reg_id='$nurse_regId'";
                                    $res=mysqli_query($db,$q);
                                    if($r=mysqli_fetch_assoc($res)){
                //                            echo $r['clock_in'];
                                        if($r['clock_in'] && !$r['clock_out']){
                                           ?>
                                                <div class="col-md-6 d-flex justify-content-center">
                                                    <button class="btn btn-warning text-capitalize text-dark" disabled id="clkInBtn" data-value="<?php echo $nurse_regId ?>" >Clock IN</button>
                                                </div>
                                                <div class="col-md-6 d-flex justify-content-center">
                                                    <button class="btn btn-warning text-capitalize text-dark"  id="clkOutBtn" data-value="<?php echo $nurse_regId ?>" >Clock OUT</button>
                                                </div>

                                            <?php
                                        }
                                        if($r['clock_out'] && !$r['clock_in']){
                                            ?>
                                                <div class="col-md-6 d-flex justify-content-center">
                                                    <button class="btn btn-warning text-capitalize text-dark"  id="clkInBtn" data-value="<?php echo $nurse_regId ?>" >Clock IN</button>
                                                </div>
                                                <div class="col-md-6 d-flex justify-content-center">
                                                    <button class="btn btn-warning text-capitalize text-dark" disabled id="clkOutBtn" data-value="<?php echo $nurse_regId ?>" >Clock OUT</button>
                                                </div>
                                            <?php
                                        }
                                        if($r['clock_in'] && $r['clock_out']){
                                            ?>
                                                <div class="col-md-6 d-flex justify-content-center">
                                                    <button class="btn btn-warning text-capitalize text-dark" disabled >Clock IN</button>
                                                </div>
                                                <div class="col-md-6 d-flex justify-content-center">
                                                    <button class="btn btn-warning text-capitalize text-dark" disabled >Clock OUT</button>
                                                </div>
                                            <?php
                                        }
                                        if(!is_null($r['present']) && $r['present']){
                                            ?>
                                            <div class="col-12 text-center">
                                                <div class="card-text"><span class="text-muted">Attendence: </span><span class="text-uppercase font-weight-bold text-success" id="pres">present</span></div>
                                            </div>
                                            <?php
                                        }else if(!is_null($r['present']) && !$r['present']){
                                            ?>
                                            <div class="col-12 text-center">
                                                <div class="card-text"><span class="text-muted">Attendence: </span><span class="text-uppercase font-weight-bold text-danger" id="pres">absent</span></div>
                                            </div>
                                            <?php
                                        }
                                    }else{
                                        ?>
                                            <div class="col-md-6 d-flex justify-content-center">
                                                <button class="btn btn-warning text-capitalize text-dark"  id="clkInBtn" data-value="<?php echo $nurse_regId ?>" >Clock IN</button>
                                            </div>
                                            <div class="col-md-6 d-flex justify-content-center">
                                                <button class="btn btn-warning text-capitalize text-dark" disabled id="clkOutBtn" data-value="<?php echo $nurse_regId ?>" >Clock OUT</button>
                                            </div>
                                        <?php
                                        echo mysqli_error($db);
                                    }
                                ?>
                                <div class="col-12 text-center">
                                    <div class="card-text" id="pres_status"><span class="text-muted">Attendence: </span><span class="text-uppercase font-weight-bold" id="pres"></span></div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php
            }else{
                ?>
                <div class="alert alert-warning text-center" role="alert">
                    No Assigment Present Yet!
                </div>
                <?php
            }
        ?>
    </div>




<?php  include 'footer_dash.php' ?>
