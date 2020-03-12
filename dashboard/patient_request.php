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

<?php
include ('header_dash.php') ;
include_once '../dbconnect.php';
include_once '../send_mail.php';
$assign_status=null;
$db_entry=null;
if(isset($_POST['assignBtn'])){
    $nurse_reg=mysqli_real_escape_string($db,$_POST['nurses']);
    $p_id=mysqli_real_escape_string($db,$_POST['p_id']);

    $nurse_info=mysqli_query($db,"SELECT * FROM nurses WHERE regId='$nurse_reg'");
    $res_nurse=mysqli_fetch_assoc($nurse_info);

    $patient_info=mysqli_query($db,"SELECT email,fname,lname,registration_id,district,service,duty_shift FROM patient_book_nurse WHERE id='$p_id'");
    $res_patient=mysqli_fetch_assoc($patient_info);
    $nurse_duty=$res_patient['duty_shift'];
    $nd_shift=mysqli_query($db,"SELECT Shift FROM nurse_duty_shift WHERE id='$nurse_duty'");
    $res_duty=mysqli_fetch_assoc($nd_shift);
//    echo $res_patient['email'];
    $p_email= $res_patient['email'];
//    $query1="INSERT INTO patient_nurse_allocation (patient_id,nurse_id) VALUES ('$p_id',(SELECT id FROM nurses WHERE regId='$nurse_reg'))";
//    $query2="UPDATE patient_book_nurse SET accepted='1' WHERE id='$p_id'";
//
//    if(mysqli_query($db,$query1) && mysqli_query($db,$query2)){
//        echo "success";
        $db_entry='Nurse Assigned Successfully';
        $mail->addAddress($p_email);
        $mail->Subject = 'AarogyaHomeCare | Nurse Assign Status';
        $mail->Body = '
            <h3>Your Booking is Confirmed!</h3>
            <h4>Booking Registration No: '.$res_patient['registration_id'].'</h4>
            <h4>Service requested for: '.$res_patient['service'].'</h4>
            <h3>Assigned Nurse Info:</h3>
            <h4>Name: '.$res_nurse['fname'].' '.$res_nurse['lname'].'</h4>
            <h4>Gender: '.$res_nurse['gender'].'</h4>
            <h4>Age: '.$res_nurse['age'].'</h4>
            <h4>Contact Number: '.$res_nurse['phone'].'</h4>
            <h4>District: '.$res_nurse['district'].'</h4>
            <h4>Requested Duty Shift: '.$res_duty['Shift'].'</h4>
        ';
        if($mail->send()){
            $assign_status='Email sent to patient successfully';
        }else{
            $assign_status='Failed to send email';
        }
//    }else{
//        $db_entry='Nurse Assignation failed!';
//    }
}

?>

<!--Page Title Header-->
<div class="row page-title-header">
    <div class="col-12">
        <div class="page-header">
            <h4 class="page-title">Dashboard</h4>
            <div class="quick-link-wrapper w-100 d-md-flex flex-md-wrap">
                <ul class="quick-links">
                    <li><a href="#">Patient</a></li>
                    <li><a href="#">Nurse Booking Request</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>


<div class="row">
    <div class="col-12 d-flex justify-content-center">
        <?php if(isset($db_entry)){
            ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong><?php echo $db_entry; ?></strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php
        } ?>
        <?php if(isset($assign_status)){
            ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong><?php echo $assign_status;  ?></strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php
        }
        ?>
    </div>
    <table class="table table-bordered table-striped">
        <thead>
            <tr align="center">
                <tH>Name</tH>
                <tH>Reg. Id</tH>
                <tH>Gender</tH>
                <tH>Age</tH>
                <tH>District</tH>
                <tH>Phone</tH>
                <tH>Family Members</tH>
                <tH>Relation</tH>
                <tH>Guardian</tH>
                <tH>Duty Shift</tH>
                <tH>Service</tH>
                <tH>Status</tH>
            </tr>
        </thead>
        <tbody>
            <?php
                $p_query="SELECT * FROM patient_book_nurse ORDER BY id";
                $sql_p=mysqli_query($db,$p_query);
                while($row=mysqli_fetch_array($sql_p)){
            ?>
                <tr align="center">
                    <td><?php  echo $row['fname']." ".$row['lname'];?></td>
                    <td><?php  echo $row['registration_id'];?></td>
                    <td><?php  echo $row['gender'];?></td>
                    <td><?php  echo $row['age'];?></td>
                    <td><?php  echo $row['district'];?></td>
                    <td><?php  echo $row['phone'];?></td>
                    <td><?php  echo $row['family_members'];?></td>
                    <td><?php  echo $row['relation'];?></td>
                    <td><?php  echo $row['gname'];?></td>
                    <?php
                        $dshift=$row['duty_shift'];
                        $squery="SELECT Shift FROM nurse_duty_shift WHERE id='$dshift'";
                        if($res=mysqli_query($db,$squery)){
                            $item=mysqli_fetch_assoc($res);
                            ?>
                                <td><?php echo $item['Shift'];?></td>
                            <?php
                        }else{
                            echo mysqli_error($db);
                        }
                      ?>
                    <td><?php  echo $row['service'];?></td>
                    <td>
                        <?php
                            if($row['accepted']==1) {
                                $id = $row['id'];
                                $q1 = "SELECT nurse_id FROM patient_nurse_allocation WHERE patient_id='$id'";
                                $r1 = mysqli_query($db, $q1);
                                $nurse_id = mysqli_fetch_assoc($r1)['nurse_id'];

                                $q2 = "SELECT regId,fname,lname FROM nurses WHERE id='$nurse_id'";
                                $r2 = mysqli_query($db, $q2);
                                $n_reg = mysqli_fetch_assoc($r2);
                                ?>
                                Assigned Nurse:
                                <br>
                                <h6><strong><?php echo $n_reg['regId']; ?></strong></h6>
                                <?php
                            }else if(is_null($row['accepted'])){
                                ?>
                                <button class="btn btn-success btn-sm" id="acceptBtn<?php echo $row['id']; ?>" data-toggle="modal" data-target="#acceptModal" onclick="getPatientId('<?php echo $row['id']; ?>')">Assign</button>
                                <button class="btn btn-danger btn-sm"  id="rejectBtn<?php echo $row['id'] ?>" onclick="openReject('<?php echo $row['id']; ?>')">Reject</button>

                                <div class="modal fade" id="rejectModal<?php echo $row['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Are you sure to Reject this patient</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" id="rBtn<?php echo $row['id'] ?>" onclick="" class="btn btn-primary">Yes</button>
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <p id="reject_stat<?php echo $row['id'];?>" style="display: none;"><strong>Rejected</strong></p>
                                <?php
                            }else if($row['accepted']==0){
                                ?>
                                Rejected
                                <?php
                            }
                        ?>
                    </td>
                <?php } ?>
        </tbody>
    </table>


    <div class="modal fade" id="acceptModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered " role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Assign Nurse</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body px-3">
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="nurses">Available Nurses</label>
                            <select class="form-control " name="nurses" id="nurses"  >
                                <?php
                                    $num_query="SELECT id,fname,lname,regId FROM nurses";
                                    $res=mysqli_query($db,$num_query);
                                    while($row=mysqli_fetch_array($res)){
                                 ?>
                                    <option><?php echo $row['regId']; ?></option>
                                <?php
                                    }
                                ?>
                            </select>
                        </div>
                        <input type="hidden" value="0" name="p_id" id="patient_id">
                        <div class="col-12 d-flex justify-content-end mt-4">
                            <button type="button" class="btn btn-secondary " data-dismiss="modal">Close</button>
                            <button type="submit" name="assignBtn" class="btn btn-primary ml-2">Save</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>


</div>




<?php include ('footer_dash.php') ?>