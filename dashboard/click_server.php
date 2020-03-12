<?php
include '../dbconnect.php';
include '../send_mail.php';

if(isset($_POST['id'])) {
    $patient_id = $_POST['id'];

    $patient_info=mysqli_query($db,"SELECT email,fname,lname,registration_id,district,service,duty_shift FROM patient_book_nurse WHERE id='$patient_id'");
    $res_patient=mysqli_fetch_assoc($patient_info);
    $p_email=$res_patient['email'];

    $query = "UPDATE patient_book_nurse SET accepted='0' WHERE id='$patient_id'";

    if (mysqli_query($db, $query)) {
        $mail->addAddress($p_email);
        $mail->Subject = 'AarogyaHomeCare | Nurse Assign Status';
        $mail->Body = '
            <h3>Your Booking is Rejected. Please contact the official for more info.</h3>
            <h3>Contact Number:  +91 9435960652, 9101786597, 9531339627</h3>
            <h3>Email: info@aarogyahomecare.com</h3>
            <h3><a href="http://aarogya/contact.php">Submit query</a></h3>
        ';
        if($mail->send()){
            echo json_encode(["status" => "success","msg"=>"email send successfully"]);
        }else{
            echo json_encode(["status" => "fail","msg"=>"failed to send message"]);
        }
    } else {
        echo json_encode((["error" => mysqli_error($db)]));
    }
}

if(isset($_POST['regId']) && isset($_POST['attendence'])){
    $nurse_reg=$_POST['regId'];
    $nurse_presence=$_POST['attendence'];

    $year=date("Y");
    $mon=date("m");
    $day=date("d");

    if($nurse_presence){
        echo "present";
        $pre_query="INSERT INTO nurse_attendence (Year,Month,Day,nurse_reg_id,present) VALUES ('$year','$mon','$day','$nurse_reg',1)";
        if($res=mysqli_query($db,$pre_query)){
            echo json_encode(["status"=>"present success"]);
        }else{
            echo json_encode(["status"=>mysqli_error($db)]);
        }
    }else{
        echo "absent";
            $pre_query="INSERT INTO nurse_attendence (Year,Month,Day,nurse_reg_id,present) VALUES ('$year','$mon','$day','$nurse_reg',0)";
        if($res=mysqli_query($db,$pre_query)){
            echo json_encode(["status"=>"absent success"]);
        }else{
            echo json_encode(["status"=>mysqli_error($db)]);
        }
    }
}

?>

