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
<?php include 'header_dash.php' ?>

<?php
include '../dbconnect.php';
if(isset($_POST['dutybtn'])){
    $shift=mysqli_real_escape_string($db,$_POST['shift']);
    $sfrom=mysqli_real_escape_string($db,$_POST['tfrom']);
    $sto=mysqli_real_escape_string($db,$_POST['tto']);
//
//    echo $shift."<br>";
//    echo $sfrom."<br>";
//    echo $sto."<br>";

    $qry="INSERT INTO nurse_duty_shift (Shift,from_time,to_time) VALUES ('$shift','$sfrom','$sto')";
    if(mysqli_query($db,$qry)){
        echo 'success';
    }else{
        echo mysqli_error($db);
    }
}
$index=0;
?>


<!--Page Title Header-->
<div class="row page-title-header">
    <div class="col-12">
        <div class="page-header">
            <h4 class="page-title">Dashboard</h4>
            <div class="quick-link-wrapper w-100 d-md-flex flex-md-wrap">
                <ul class="quick-links">
                    <li><a href="#">Nurse</a></li>
                    <li><a href="#">Duty Shifts</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>


<div class="row d-flex justify-content-center">
    <div class="col-10">
        <div class="card">
            <div class="card-body">
                <div class="col-12 d-flex justify-content-end">
                    <button class="btn btn-primary" data-toggle="modal" data-target="#dutyModal">Add New Shift</button>
                </div>
                <table class="table table-striped table-bordered mt-3">
                    <thead>
                            <th>Serial No.</th>
                            <th>Duty Shift of Nurse</th>
                            <th>To</th>
                            <th>From</th>
                    </thead>
                    <tbody>
                    <?php
                        $rquery="SELECT * FROM nurse_duty_shift";
                        $res=mysqli_query($db,$rquery);
                        while($row=mysqli_fetch_array($res)){
                            $index++;
                            if($row['from_time']!=0){
                                $f_time=date('h:i A',strtotime($row['from_time']));
                            }else{
                                $f_time="00.00";
                            }
                            if($row['to_time']!=0){
                                $t_time=date('h:i A',strtotime($row['to_time']));
                            }else{
                                $t_time="00.00";
                            }
                            ?>
                                <tr>
                                    <td><?php echo $index; ?></td>
                                    <td><?php echo $row['Shift']; ?></td>
                                    <td><?php echo $f_time; ?></td>
                                    <td><?php echo $t_time; ?></td>
                                </tr>
                            <?php
                        }
                    ?>
                    </tbody>
                </table>

                <div class="modal fade" id="dutyModal" tabindex="-1" role="dialog" aria-labelledby="dutyModal" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Add Nurse Duty Shift</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="" method="post">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Enter Nurse Shift</label>
                                        <input type="text" class="form-control" name="shift" id="exampleInputEmail1" aria-describedby="emailHelp">
                                    </div>
                                    <div class="row">
                                        <div class="col-4 d-flex align-items-center">
                                            <div class="card-text">Enter Timing</div>
                                        </div>
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label for="from">From</label>
                                                <input type="time" name="tfrom" class="form-control" id="from" >
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label for="to">To</label>
                                                <input type="time" name="tto" class="form-control" id="to" >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 d-flex justify-content-end">
                                        <button type="button" class="btn btn-secondary mr-3" data-dismiss="modal">Close</button>
                                        <button type="submit" name="dutybtn" class="btn btn-primary">Save changes</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>



<?php include 'footer_dash.php' ?>
