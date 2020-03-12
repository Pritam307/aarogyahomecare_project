<?php
include_once '../dbconnect.php';

$errors=array();
if(isset($_POST['sublogin'])){
    $username=mysqli_real_escape_string($db,$_POST['uname']);
    $userpass=mysqli_real_escape_string($db,$_POST['urpass']);

//    echo $userpass;
//    echo $username;

    $uquery="SELECT * FROM users WHERE username='$username'";
    $row=mysqli_query($db,$uquery);
    $res=mysqli_fetch_assoc($row);

    echo strlen($res['password'])."<br>";

    if($res){
        echo password_verify($userpass,$res['password']);
        if(password_verify($userpass,$res['password'])){
            header("location:../dashboard/home.php");
        }else{
            $errors['pass_error']=mysqli_error($db);
        }
    }else{
        $errors['username_error']="Username does not exist";
    }


}
?>
