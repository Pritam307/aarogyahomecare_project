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
include 'header_dash.php';
include '../dbconnect.php';
?>

<?php

if(isset($_POST['svebtn'])){
    $adv_payment=mysqli_real_escape_string($db,$_POST['advpay']);
    $blnc_payment=mysqli_real_escape_string($db,$_POST['blc']);
    $total_payment=mysqli_real_escape_string($db,$_POST['total']);
    $patient=mysqli_real_escape_string($db,$_POST['pID']);
    $duration=mysqli_real_escape_string($db,$_POST['duration']);

    $pquery="INSERT INTO patient_payment_history (patient_regId,advance_amt,balance_amt,total_amount,duration_in_month) 
    VALUES ('$patient','$adv_payment','$blnc_payment','$total_payment','$duration')";
    if(mysqli_query($db,$pquery)){
        echo 'success';
    }else{
        echo mysqli_error($db);
    }
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
                    <li><a href="#">Payments Details</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>


<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="col-12 d-flex justify-content-end">
                    <button class="btn btn-primary" data-toggle="modal" data-target="#paymentModal">Add Payment Card</button>
                </div>

                <div class="col-12 mt-3">
                    <table class="table table-striped table-bordered table-bordered">
                        <thead  align="center">
                            <th class="border-right">Patient Request Id</th>
                            <th class="border-right">Advance Payment</th>
                            <th class="border-right">Balance Payment</th>
                            <th class="border-right">Total Amount</th>
                            <th class="border-right">Duration (in month)</th>
                            <th class="border-right">Created At</th>
                        </thead>
                        <tbody align="center">
                        <?php
                            $dquery="SELECT * FROM patient_payment_history";
                            $dres=mysqli_query($db,$dquery);
                            while($row=mysqli_fetch_assoc($dres)){
                        ?>
                            <tr>
                                <td><?php echo $row['patient_regId'] ?></td>
                                <td><?php echo $row['advance_amt'] ?></td>
                                <td><?php echo $row['balance_amt'] ?></td>
                                <td><?php echo $row['total_amount'] ?></td>
                                <td><?php echo $row['duration_in_month'] ?></td>
                                <td><?php echo $row['created_at'] ?></td>
                            </tr>
                        <?php
                            }
                        ?>
                        </tbody>
                    </table>
                </div>

                <div class="modal fade" id="paymentModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Add Patient Payment Details</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="col-12">
                                    <form action="" method="post">
                                        <div class="form-group " id="cus-validators">
                                            <label for="patientId">Select Patient Request</label>
                                            <select class="form-control" id="patientId" name="pID" required>
                                                <option value="">Select</option>
                                                <?php
                                                $dquery="SELECT * FROM patient_book_nurse";
                                                $dres=mysqli_query($db,$dquery);
                                                while($row=mysqli_fetch_array($dres)){
                                                    ?>
                                                        <option value="<?php echo $row['registration_id']; ?>"><?php echo $row['registration_id']; ?></option>
                                                    <?php
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Total Fixed amount for 1 month</label>
                                            <input type="number" name="total" class="form-control" id="exampleInputPassword1" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Advance Payment (if any)</label>
                                            <input type="number" class="form-control" name="advpay" id="exampleInputPassword1" >
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Balance</label>
                                            <input type="number" class="form-control" name="blc" id="exampleInputPassword1" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Duration (in Month)</label>
                                            <input type="number" name="duration" class="form-control" id="exampleInputPassword1" required>
                                        </div>
                                        <div class="col-12">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="submit" name="svebtn" class="btn btn-primary">Save changes</button>
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
</div>




<?php include 'footer_dash.php'; ?>
