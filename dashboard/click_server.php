<?php
include '../dbconnect.php';
include '../send_mail.php';



if(isset($_POST['inregId'])){
    $nurse_id=$_POST['inregId'];

    $year=date("Y");
    $mon=date("m");
    $day=date("d");

    $curr_time = date('H:i',time());
    $in_query="INSERT INTO nurse_attendence (Year,Month,Day,nurse_reg_id,clock_in) VALUES ('$year','$mon','$day','$nurse_id','$curr_time')";

    if($res=mysqli_query($db,$in_query)){
        echo json_encode(["status"=>"success"]);
    }else{
        echo json_encode(["status"=>mysqli_error($db)]);
    }
}


if(isset($_POST['outregId'])){

    $nurse_id=$_POST['outregId'];
    $given_working_hours=null;
    $deadline_hours=null;
    $clk_in_time=null;
    $present=null;

    $year=date("Y");
    $mon=date("m");
    $day=date("d");

    //Get nurse Id from registration id
    $nid_query = mysqli_query($db,"SELECT id FROM nurses WHERE regId='$nurse_id'");
    $nid_res=mysqli_fetch_assoc($nid_query)['id'];

    //get working hours for this nurse
    $d_query="SELECT * FROM nurse_duty_shift,patient_nurse_allocation WHERE nurse_duty_shift.id = patient_nurse_allocation.allocated_duty_shift AND patient_nurse_allocation.nurse_id='$nid_res'";
    if($res=mysqli_query($db,$d_query)){
        $val = mysqli_fetch_assoc($res);
        $given_working_hours=$val['working_hours'];
        $deadline_hours=$val['deadline_hours'];
    }

    //get clock in time
    $clkin_query="SELECT clock_in FROM nurse_attendence WHERE nurse_reg_id='$nurse_id' AND Day='$day' AND Month='$mon' AND Year='$year'";
    if($ires=mysqli_query($db,$clkin_query)){
        $ival=mysqli_fetch_assoc($ires);
        $clk_in_time = date("H:i",strtotime($ival['clock_in']));
    }

    $curr_time = date('H:i',time());
    //get diffrence of clock in and clock time
    $time_diff=round(gmdate(strtotime($curr_time)-strtotime($clk_in_time))/3600,2);

    if($time_diff>=$deadline_hours){
        $present = true;
    }else{
        $present = false;
    }

    $clkout_query = "UPDATE nurse_attendence SET clock_out = '$curr_time', present = '$present' WHERE nurse_reg_id='$nurse_id' AND Day='$day' AND Month='$mon' AND Year='$year'";
    if(mysqli_query($db,$clkout_query)){
        echo json_encode(["status"=>"success","present"=>$present]);
    }else{
        echo json_encode(["status"=>mysqli_error($db)]);
    }
    //   echo json_encode(["status"=>"success","diff"=>$time_diff,"work_hrs=>$given_working_hours","present"=>$present]);

}


?>

