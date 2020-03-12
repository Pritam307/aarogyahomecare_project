<?php
include_once '../dbconnect.php';
$errors=array();
$success=$fail=null;
$isNurse=$isPatient=0;
if(isset($_POST['regbtn'])){
    $username=mysqli_real_escape_string($db,$_POST['username']);
    $newpass=mysqli_real_escape_string($db,$_POST['upass']);
    $conpass=mysqli_real_escape_string($db,$_POST['conpass']);
    $mobile=mysqli_real_escape_string($db,$_POST['mobile']);
    $email=mysqli_real_escape_string($db,$_POST['email']);
    $district = mysqli_real_escape_string($db,$_POST['district']);

    $passhash=password_hash($newpass,PASSWORD_DEFAULT);

    $uquery="SELECT * FROM users WHERE username='$username' LIMIT 1";
    $res=mysqli_query($db,$uquery);
    $user=mysqli_fetch_assoc($res);
    if($user){
        $fail="Username Exists";
    }else{
        if($conpass==$newpass){
            $regquery="INSERT INTO users (username,password,is_patient,district) VALUES ('$username','$passhash',1,'$district')";
            if(mysqli_query($db,$regquery)){
                $success="Registration Success";
            }else{
                $fail=mysqli_error($db);
            }
        }else{
            echo "Password Mismatch";
        }

    }

}
?>
