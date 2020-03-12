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
if(isset($_GET['reg_id'])){
    $nurse_regId=$_GET['reg_id'];
}
$today=date("d");
$mon=date("m");
$year=date("Y");

?>
<div class="row d-flex justify-content-center">
    <div class="col-8">
        <div class="card h-100">
            <div class="card-body">
                    <div class="card-text font-weight-bold">Today's Attendence: <?php echo date("d-m-Y");  ?></div>
                    <?php
                        $q="SELECT present FROM nurse_attendence WHERE Day='$today' AND Year='$year' AND Month='$mon' AND nurse_reg_id='$nurse_regId'";
                        $res=mysqli_query($db,$q);
                        if($r=mysqli_fetch_assoc($res)){
                            if($r['present']==1){
                    ?>
                        <div class="card-text font-weight-bold" >Attendence:  <span style="color: rgba(0,176,0,0.75); margin-left: 10px; text-transform: uppercase;">Present</span></div>
                        <?php
                            }else{
                                ?>
                                <div class="card-text font-weight-bold" >Attendence:  <span style="color: rgb(176,56,26); margin-left: 10px; text-transform: uppercase;">Absent</span></div>
                                <?php
                            }
                        }else{
                            echo mysqli_error($db);
                            ?>
                        <div class="card-text font-weight-bold" >Attendence:  <span id="todaystat" style="margin-left: 10px; text-transform: uppercase;"></span></div>
                        <div class="row">
                            <div class="col-6 d-flex justify-content-center">
                                <button class="btn btn-success btn-sm" data-value="<?php echo $nurse_regId; ?>" id="prebtn">Present</button>
                            </div>
                            <div class="col-6 d-flex justify-content-center">
                                <button class="btn btn-warning btn-sm" data-value="<?php echo $nurse_regId; ?>" id="abbtn">Absent</button>
                            </div>
                        </div>
                        <?php
                    }
                ?>

            </div>
        </div>
    </div>
</div>

<?php  include 'footer_dash.php' ?>
