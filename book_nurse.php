<?php  include 'header.php'; ?>
<?php  include 'utilities.php'; ?>
<?php
include 'send_mail.php';
include_once 'dbconnect.php';
$errors=array();
$msg=null;
$book_msg=null;
function  getRegId($dis,$lid){
    $d=date("Y");
    $val =$dis[0]."_".$d."_".(100+$lid);
    return $val;
}
if(isset($_POST['sbtn'])){
    $fname=mysqli_real_escape_string($db,$_POST['fname']);
    $lname=mysqli_real_escape_string($db,$_POST['lname']);
    $contact=mysqli_real_escape_string($db,$_POST['contact']);
    $city=mysqli_real_escape_string($db,$_POST['city']);
    $district=mysqli_real_escape_string($db,$_POST['region']);
    $pincode=mysqli_real_escape_string($db,$_POST['pincode']);
    $nation=mysqli_real_escape_string($db,$_POST['nation']);
    $phone=mysqli_real_escape_string($db,$_POST['phone']);
    $email=mysqli_real_escape_string($db,$_POST['email']);
    $gender=mysqli_real_escape_string($db,$_POST['gender']);
    $age=mysqli_real_escape_string($db,$_POST['age']);
    $family_members=mysqli_real_escape_string($db,$_POST['family_members']);
    $rel_guardian=mysqli_real_escape_string($db,$_POST['rel_guardian']);
    $gname=mysqli_real_escape_string($db,$_POST['gname']);
    $dshift=mysqli_real_escape_string($db,$_POST['dshift']);
    $noofdays=mysqli_real_escape_string($db,$_POST['noofdays']);
    $service=mysqli_real_escape_string($db,$_POST['service']);
    $history=mysqli_real_escape_string($db,$_POST['history']);
    $hospital=mysqli_real_escape_string($db,$_POST['hospital']);

    if(empty(trim($fname))){
        $errors['fname_empty']="First-Name is required";
    }
    if(empty(trim($lname))){
        $errors['lname_empty']="Last-Name is required";
    }
    if(empty(trim($contact))){
        $errors['contact_empty']="Contact is required";
    }
    if(empty(trim($city))){
        $errors['city_empty']="City is required";
    }
    if(empty(trim($district))){
        $errors['region_empty']="Region is required";
    }
    if(empty(trim($pincode))){
        $errors['pin_empty']="Pincode is required";
    }
    if(empty(trim($nation))){
        $errors['nation_empty']="Nation is required";
    }
    if(empty(trim($phone))){
        $errors['phone_empty']="Phone is required";
    }
    if(empty(trim($gender))){
        $errors['gender_empty']="gender is required";
    }
    if(empty(trim($age))){
        $errors['age_empty']="Age is required";
    }
    if(empty(trim($family_members))){
        $errors['family_empty']="Family Members is required";
    }
    if(empty(trim($rel_guardian))){
        $errors['rel_empty']="Relatives is required";
    }
    if(empty(trim($gname))){
        $errors['gname_empty']="Guardian Name is required";
    }
    if(empty(trim($dshift))){
        $errors['dshift_empty']="Duty Shift is required";
    }
    if(empty(trim($noofdays))){
        $errors['noofdays_empty']="No of Days is required";
    }
    if(empty(trim($service))){
        $errors['service_empty']="Service is required";
    }
    if(empty(trim($history))){
        $errors['history_empty']="History is required";
    }
    if(empty(trim($hospital))){
        $errors['hospital_empty']="Hospital is required";
    }

    $last_q="SELECT id FROM patient_book_nurse ORDER BY id DESC LIMIT 1";
    $lres=mysqli_query($db,$last_q);
    if($row=mysqli_fetch_assoc($lres)){
        $last_id=$row['id'];
    }else{
        $last_id=0;
    }


    if(count($errors)==0){
//        echo $last_id;
        $regId=getRegId($district,$last_id);
        $query="INSERT INTO patient_book_nurse (registration_id,fname,lname,address,city,district,pincode,nation,phone,email,gender,age,family_members,relation,gname,duty_shift,period,service,history,hospital) VALUES ('$regId','$fname','$lname','$contact','$city','$district','$pincode','$nation','$phone','$email','$gender','$age','$family_members','$rel_guardian','$gname','$dshift','$noofdays','$service','$history','$hospital')";
        if(mysqli_query($db,$query)){
            $book_msg = 'Success .';
            $mail->addAddress($email);
            $mail->Subject = 'AarogyaHomeCare | Nurse Booking Status';
            $mail->Body = ' 
                <h4>Thanks for Choosing Us! </h4>
                <h4>Your Registration Number is: <strong>'.$regId.'</strong></h4>
                <h4>Your Booking is in progress. We will shortly assign a Nurse to you. You will be notified when done. </h4>
                <h4>Thank You!</h4>
            ';
            if($mail->send()){
                $msg = 'Booking info is send successfully to your email. Please check it';
            }else{
                $msg = 'Email Failed .' ;
            }
        }else{
//            echo mysqli_error($db);
            $book_msg = 'Failed .';
        }
    }

}

?>

<section class="probootstrap-slider flexslider">
    <ul class="slides">
        <li style="background-image: url(img/banner1.jpg);" class="overlay2">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <div class="slides-text probootstrap-animate" data-animate-effect="fadeIn">
                            <h2>Book Nurse</h2>
                            <p>Fill this form to book Nurse Online</p>
                        </div>
                    </div>
                </div>
            </div>
        </li>
    </ul>
</section>

<section class="probootstrap-section">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="col-12">
                            <?php
                                if(isset($msg)){
                                    ?>
                                        <div class="alert alert-success" role="alert">
                                            <p><strong><?php echo $book_msg." ".$msg; ?></strong></p>
                                        </div>
                                    <?php
                                }
                            ?>
                        </div>
                        <form action="" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="csrf_token" value="<?php echo generateToken('bookNurse'); ?>"/>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputEmail4">FirstName<span class="star">*</span></label>
                                    <input type="text" class="form-control" name="fname" id="inputEmail4"  placeholder="Your Firstname"  required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputPassword4">Lastname<span class="star">*</span></label>
                                    <input type="text" class="form-control" name="lname" id="inputPassword4" placeholder="Your Lastname" required>
                                </div>
                            </div>
                            <div class="container">
                                <div class="form-group mx-3" id="cus-validators">
                                    <label for="address" class="font-weight-bold">Contact Address<span class="star">*</span></label>
                                    <input type="text" id="address" name="contact" class="form-control" placeholder="Your permanent address" required>
                                </div>
                            </div>
                            <div class="form-row p-0 m-0">
                                <div class="form-group col-md-6 p-0 m-0">
                                    <label for="inputEmail4 " style="display: none"></label>
                                    <input type="text" class="form-control" name="city" id="inputEmail4"  placeholder="City" >
                                </div>
                                <div class="form-group col-md-6 p-0 m-0">
                                    <label for="inputPassword4" style="display: none"></label>
                                    <input type="text" class="form-control" id="inputPassword4" name="region" placeholder="District"  required>
                                </div>
                            </div>

                            <div class="form-row m-0 m-0">
                                <div class="form-group col-md-6 p-0 m-0">
                                    <label for="inputEmail4" style="display: none"></label>
                                    <input type="text" class="form-control" name="pincode" id="inputEmail4"  placeholder="Pincode"  required>
                                </div>
                                <div class="form-group col-md-6 p-0 m-0">
                                    <label for="cities" style="display: none"></label>
                                    <select class="form-control p-0 m-0" name="nation" id="cities"  required>
                                        <option>Select</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-row p-0 m-0">
                                <div class="form-group col-md-6 p-0 m-0" id="cus-validators">
                                    <label for="phone" class="font-weight-bold">Phone<span class="star">*</span></label>
                                    <input type="text" id="phone" name="phone" class="form-control" required>
                                </div>
                                <div class="form-group col-md-6 p-0 m-0">
                                    <label for="email" class="font-weight-bold">Email<span class="star">*</span></label>
                                    <input type="email" id="email" name="email" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-row p-0 m-0">
                                <div class="form-group col-md-6 p-0 m-0">
                                    <label for="gender">Gender<span class="star">*</span></label>
                                    <input type="text" class="form-control" name="gender" id="gender"  required>
                                </div>
                                <div class="form-group col-md-6 p-0 m-0">
                                    <label for="age" >Age<span class="star">*</span></label>
                                    <input type="number" name="age" min="1" class="form-control" id="age" required>
                                </div>
                            </div>

                            <div class="container">
                                <div class="form-group" id="cus-validators">
                                    <label for="familymember" class="font-weight-bold">Total Family Member ( Both M/F)<span class="star">*</span> </label>
                                    <input type="number" id="familymember" name="family_members" class="form-control" min="2" required>
                                </div>
                            </div>

                            <div class="container">
                                <div class="form-group " id="cus-validators">
                                    <label for="grelan" class="font-weight-bold">Relation with the Guardian<span class="star">*</span> </label>
                                    <input type="text" id="grelan" name="rel_guardian" class="form-control" required>
                                </div>
                            </div>

                            <div class="form-row p-0 m-0">
                                <div class="form-group col-md-6 p-0 m-0">
                                    <label for="gname">Name of the Guardian<span class="star">*</span> </label>
                                    <input type="text" class="form-control" name="gname" id="gname"  required>
                                </div>
                                <div class="form-group col-md-6 p-0 m-0">
                                    <label for="dshift">Select Shifts</label>
                                    <select class="form-control" id="dshift" name="dshift">
                                        <?php
                                        $dquery="SELECT * FROM nurse_duty_shift";
                                        $dres=mysqli_query($db,$dquery);
                                        while($row=mysqli_fetch_array($dres)){
                                            ?>
                                            <option value="<?php echo $row['id']; ?>"><?php echo $row['Shift']; ?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <div class="form-row p-0 m-0">
                                <div class="form-group col-md-6 p-0 m-0">
                                    <label for="days" >Period of Required (Days)<span class="star">*</span></label>
                                    <select class="form-control pb-2 mb-2" name="noofdays" id="days"  required>
                                        <option>Select</option>
                                        <option>30</option>
                                        <option>60</option>
                                        <option>Others</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-6 p-0 m-0">
                                    <label for="service">Service<span class="star">*</span></label>
                                    <select class="form-control pb-2 mb-2" name="service" id="service"  required>
                                        <option>Select</option>
                                        <option>Nursing Aide</option>
                                        <option>Nursing Attendent</option>s
                                        <option>Others</option>
                                    </select>
                                </div>
                            </div>

                            <div class="container border">
                                <div class="form-group">
                                    <label for="history" class="font-weight-bold">Patient's History<span class="star">*</span></label>
                                    <textarea type="text" id="history" name="history" rows="1" style="width: 100%" required></textarea>
                                </div>
                            </div>

                            <div class="container border">
                                <div class="form-group">
                                    <label for="history" class="font-weight-bold">Doctor and Hospital<span class="star">*</span></label>
                                    <textarea type="text" id="history" name="hospital" rows="1" style="width: 100%" required></textarea>
                                </div>
                            </div>

                            <div class="container">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="customCheck" name="agreecheck">
                                    <label class="custom-control-label" for="customCheck" style="font-size: smaller">I heartly apply Home Care Nursing Service for myself and I agree to the all terms & condition which are mentioned above and I shall Co-operative myself for quickly recovery of my patient.
                                    </label>
                                </div>
                            </div>

                            <div class="container col-12 d-flex justify-content-start">
                                <button class="btn btn-sm btn-success" disabled id="booknursebtn" name="sbtn"><strong>Submit</strong></button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>



<?php  include 'footer.php' ?>
