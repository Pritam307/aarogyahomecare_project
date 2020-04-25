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
    $whrs=mysqli_real_escape_string($db,$_POST['workhrs']);
    $dhrs=mysqli_real_escape_string($db,$_POST['deadline']);

    $qry="INSERT INTO nurse_duty_shift (Shift,working_hours,deadline_hours) VALUES ('$shift','$whrs','$dhrs')";
    if(mysqli_query($db,$qry)){
        echo 'success';
    }else{
        echo mysqli_error($db);
    }
}

if(isset($_POST['editDuty'])){
    $d_id=mysqli_real_escape_string($db,$_POST['shift_id']);
    $eshift=mysqli_real_escape_string($db,$_POST['eshift']);
    $edit_wrkghrs=mysqli_real_escape_string($db,$_POST['eworkhrs']);
    $edit_deadln=mysqli_real_escape_string($db,$_POST['edeadline']);
    $dsql=null;

//        echo $eshift;
//        echo $edit_wrkghrs;
//        echo $edit_wrkghrs;


    #if only shift name
    if(!empty($eshift) AND empty($edit_deadln) AND empty($edit_wrkghrs)){
        echo "shift name";
        $dsql="UPDATE nurse_duty_shift SET Shift='$eshift' WHERE id='$d_id'";
    }
    #if only working hours
    if(!empty($edit_wrkghrs) AND empty($eshift) AND empty($edit_deadln)){
        echo "working hours";
        $dsql="UPDATE nurse_duty_shift SET working_hours='$edit_wrkghrs' WHERE id='$d_id'";
    }
    #if only deadline hours
    if(!empty($edit_deadln) AND empty($eshift) AND empty($edit_wrkghrs)){
        echo "deadline hours";
        $dsql="UPDATE nurse_duty_shift SET deadline_hours='$edit_deadln' WHERE id='$d_id'";
    }
    #if shift name and deadline hours
    if(!empty($eshift) AND !empty($edit_deadln) AND empty($edit_wrkghrs)){
        echo "shift name and deadline hours";
        $dsql="UPDATE nurse_duty_shift SET Shift='$eshift',deadline_hours='$edit_deadln' WHERE id='$d_id'";
    }
    #if only shift name and working hours
    if(!empty($eshift) AND !empty($edit_wrkghrs) AND empty($edit_deadln)){
        echo "shift name and working hours";
        $dsql="UPDATE nurse_duty_shift SET Shift='$eshift',working_hours='$edit_wrkghrs' WHERE id='$d_id'";
    }
    #if only deadline hours and working hours
    if(!empty($edit_wrkghrs) AND !empty($edit_deadln) AND empty($eshift)){
        echo "deadline hours and working hours";
        $dsql="UPDATE nurse_duty_shift SET working_hours='$edit_wrkghrs',deadline_hours='$edit_deadln' WHERE id='$d_id'";
    }
    #if all three
    if(!empty($eshift) AND !empty($edit_deadln) AND !empty($edit_wrkghrs)){
        echo "all three";
        $dsql="UPDATE nurse_duty_shift SET Shift='$eshift',working_hours='$edit_wrkghrs',deadline_hours='$edit_deadln' WHERE id='$d_id'";
    }

    if(mysqli_query($db,$dsql)){
        echo "success";
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
                            <th>Working Hours</th>
                            <th>Minimum hours of Work</th>
                            <th>Action</th>
                    </thead>
                    <tbody>
                    <?php
                        $rquery="SELECT * FROM nurse_duty_shift";
                        $res=mysqli_query($db,$rquery);
                        while($row=mysqli_fetch_array($res)){
                            $index++;
                            ?>
                                <tr align="center">
                                    <td><?php echo $index; ?></td>
                                    <td id="dshift"><?php echo $row['Shift']; ?></td>
                                    <td id="d_work"><?php echo $row['working_hours']; ?> hrs</td>
                                    <td id="d_dline"><?php echo $row['deadline_hours']; ?> hrs </td>
                                    <td>
                                        <button class="btn btn-outline-primary btn-sm" data-target="#editModal" data-toggle="modal" onclick="getIdToModal('<?php echo $row['id'];?>')">Edit</button>
                                    </td>
                                </tr>
                            <?php
                        }
                    ?>
                    </tbody>
                </table>

<!--                ADD MODAL-->
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
                                        <div class="col-4 d-flex align-items-center ">
                                            <div class="card-text">Enter Timing</div>
                                        </div>
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label for="from">Working Hours</label>
                                                <input type="number" name="workhrs" class="form-control" id="workhrs" min="1" >
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label for="from">Deadline Hours</label>
                                                <input type="number" name="deadline" class="form-control" id="deadline" min="1">
                                            </div>
                                        </div>
<!--                                        <div class="col-3  px-0">-->
<!--                                            <div class="form-group">-->
<!--                                                <label for="from">From</label>-->
<!--                                                <input type="time" name="tfrom" class="form-control" id="from" >-->
<!--                                            </div>-->
<!--                                        </div>-->
<!--                                        <div class="col-2  pl-0">-->
<!--                                            <div class="form-group">-->
<!--                                                <label for="fromselect"></label>-->
<!--                                                <select class="form-control" name="fromformat" id="fromselect">-->
<!--                                                    <option>am</option>-->
<!--                                                    <option>pm</option>-->
<!--                                                </select>-->
<!--                                            </div>-->
<!--                                        </div>-->
<!--                                        <div class="col-3  pr-0">-->
<!--                                            <div class="form-group">-->
<!--                                                <label for="to">To</label>-->
<!--                                                <input type="time" name="tto" class="form-control" id="to" >-->
<!--                                            </div>-->
<!--                                        </div>-->
<!--                                        <div class="col-2  pl-0">-->
<!--                                            <div class="form-group">-->
<!--                                                <label for="toselect"></label>-->
<!--                                                <select class="form-control" name="toformat" id="toselect">-->
<!--                                                    <option>am</option>-->
<!--                                                    <option>pm</option>-->
<!--                                                </select>-->
<!--                                            </div>-->
<!--                                        </div>-->
                                    </div>
                                    <div class="col-12 d-flex justify-content-end">
                                        <button type="button" class="btn btn-secondary mr-3" data-dismiss="modal">Close</button>
                                        <button type="submit" name="dutybtn" class="btn btn-primary">Add</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

<!--                EDIT MODAL-->
                <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Edit Duty Timings</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="" method="post">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Enter Nurse Shift</label>
                                        <input type="text" class="form-control" name="eshift" id="exampleInputEmail1" aria-describedby="emailHelp">
                                    </div>
                                    <div class="row">
                                        <div class="col-4 d-flex align-items-center ">
                                            <div class="card-text">Enter Timing</div>
                                        </div>
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label for="from">Working Hours</label>
                                                <input type="number" name="eworkhrs" class="form-control" id="workhrs" min="1" >
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label for="from">Deadline Hours</label>
                                                <input type="number" name="edeadline" class="form-control" id="deadline" min="1">
                                            </div>
                                        </div>
                                        <input type="hidden" id="shift_id" value="" name="shift_id">
                                    </div>
                                    <div class="col-12 d-flex justify-content-end">
                                        <button type="button" class="btn btn-secondary mr-3" data-dismiss="modal">Close</button>
                                        <button type="submit" name="editDuty" class="btn btn-primary">Edit</button>
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
