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
include_once '../dbconnect.php';

$errors=array();

$image_dir="upload/nurse_profile/";
$sign_dir="upload/nurse_sign/";
$img_uploadOk=1;
$sign_uploadOK=1;
$img_target_file=$sign_target_file=null;

function  getRegId($val){
    $val ="AN".(1000+$val);
    return $val;
}


if(isset($_POST['subBtn'])){

    $fname=mysqli_real_escape_string($db,$_POST['fname']);
    $lname=mysqli_real_escape_string($db,$_POST['lname']);
    $email=mysqli_real_escape_string($db,$_POST['email']);
    $address=mysqli_real_escape_string($db,$_POST['address']);
    $city=mysqli_real_escape_string($db,$_POST['city']);
    $district=mysqli_real_escape_string($db,$_POST['district']);
    $pincode=mysqli_real_escape_string($db,$_POST['pincode']);
    $nation=mysqli_real_escape_string($db,$_POST['nation']);
    $phone=mysqli_real_escape_string($db,$_POST['phone']);
    $gender=mysqli_real_escape_string($db,$_POST['gender']);
    $age=mysqli_real_escape_string($db,$_POST['age']);
    $salary=mysqli_real_escape_string($db,$_POST['salary']);
    $shifts=mysqli_real_escape_string($db,$_POST['shifts']);
    $emp_type=mysqli_real_escape_string($db,$_POST['emp_type']);



    if(empty(trim($fname))){
        $errors['fname_empty']="First-Name is required";
    }
    if(empty(trim($lname))){
        $errors['fname_empty']="Last-Name is required";
    }
    if(empty(trim($email))){
        $errors['email_empty']="Email is required";
    }
    if(empty(trim($address))){
        $errors['address_empty']="Address is required";
    }
    if(empty(trim($city))){
        $errors['city_empty']="City is required";
    }
    if(empty(trim($district))){
        $errors['district-empty']="District is required";
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
        $errors['gender-empty']="Gender is required";
    }
    if(empty(trim($age))){
        $errors['age_empty']="Age is required";
    }
    if(empty(trim($salary))){
        $errors['salary-empty']="Salary is required";
    }



    if(!isset($_FILES["photo"]) or $_FILES["photo"]["error"] == UPLOAD_ERR_NO_FILE){
        $errors['image_error']="No img Selected";
        $img_uploadOk=0;
    }else{
        $img_target_file=$image_dir.basename($_FILES["photo"]["name"]);
        $imageFileType=strtolower(pathinfo($img_target_file,PATHINFO_EXTENSION));

        if($imageFileType!='jpg' and $imageFileType!='jpeg' and $imageFileType!='png'){
            $errors['image_type_error']="Only jpg, jpeg or png are allowed";
            $img_uploadOk=0;
        }
    }


    if(!isset($_FILES["sign"]) or $_FILES["sign"]["error"] == UPLOAD_ERR_NO_FILE){
        $errors['sign_error']="No Signature Selected";
        $sign_uploadOK=0;
    }else{
        $sign_target_file=$sign_dir.basename($_FILES["sign"]["name"]);
        $signFileType=strtolower(pathinfo($sign_target_file,PATHINFO_EXTENSION));

        if($signFileType!='jpg' and $signFileType!='jpeg' and $signFileType!='png'){
            $errors['image_type_error']="Only jpg, jpeg or png are allowed";
            $sign_uploadOK=0;
        }
    }

    $lquery="SELECT id FROM nurses ORDER BY id DESC LIMIT 1";
    $lrow=mysqli_query($db,$lquery);
    if($lres=mysqli_fetch_assoc($lrow)){
        $last_id=$lres['id'];
    }else{
        $last_id=0;
    }

    if(count($errors)==0 and $img_uploadOk==1 and $sign_uploadOK==1){
        $regId=getRegId($last_id);
        move_uploaded_file($_FILES["photo"]["tmp_name"],$img_target_file);
        move_uploaded_file($_FILES["sign"]["tmp_name"],$sign_target_file);

        $query="INSERT INTO nurses (regId,fname,lname,email,address,city,district,nation,pincode,phone,gender,age,salary,duty_shift,employee_type,photo,signature) VALUES ('$regId','$fname','$lname','$email','$address','$city','$district','$nation','$pincode','$phone','$gender','$age','$salary','$shifts','$emp_type','$img_target_file','$sign_target_file')";
        mysqli_query($db,$query);
    }
}


if(isset($_POST['deductBtn'])){
    $hra=mysqli_real_escape_string($db,$_POST['hra']);
    $pf=mysqli_real_escape_string($db,$_POST['pf']);
    $advpay=mysqli_real_escape_string($db,$_POST['advpay']);
    $esic=mysqli_real_escape_string($db,$_POST['esic']);
    $bonus=(int)mysqli_real_escape_string($db,$_POST['bonus']);
    $id=mysqli_real_escape_string($db,$_POST['nurseId']);
    $nurseSal=(int)mysqli_real_escape_string($db,$_POST['nurseSal']);
    $special_allowance=(int)mysqli_real_escape_string($db,$_POST['specialallow']);

    $real_esic=0;
    $real_bonus=floatval(($bonus*$nurseSal)/100);
    if(isset($esic) && trim($esic)!=''){
        $real_esic=floatval(((int)$esic*$nurseSal)/100);
    }else{
        $real_esic=floatval((4*$nurseSal)/100);
    }
    if(!isset($advpay) && trim($advpay)==''){
        $advpay=0;
    }
    echo $real_esic."<br>";
    echo $real_bonus;

        $dquery="INSERT INTO nurse_salary_infos (nurse_id,HRA,PF,ESIC,Advance,Bonus,special_allowance) VALUES ('$id','$hra','$pf','$real_esic','$advpay','$real_bonus','$special_allowance')";
    if($res=mysqli_query($db,$dquery)){
        echo "success";
    }else{
        echo mysqli_error($db);
    }

}

?>

<div class="col-12 d-flex justify-content-end">
    <a href="#addModal" class="btn btn-primary btn-sm" data-toggle="modal" >Add New Nurse</a>
</div>


    <div class="modal fade" id="addModal">
        <div class="modal-dialog modal-dialog-centered ">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add New Nurse</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body px-3">
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputEmail4" class="font-weight-bold">FirstName<span class="star">*</span></label>
                                <input type="text" class="form-control" name="fname" id="inputEmail4"   required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputPassword4" class="font-weight-bold">Lastname<span class="star">*</span></label>
                                <input type="text" class="form-control" name="lname" id="inputPassword4"  required>
                            </div>
                        </div>

                        <div class="form-group" >
                            <label for="email" class="font-weight-bold">Email<span class="star">*</span></label>
                            <input type="email" id="email" name="email" class="form-control" required>
                        </div>

                        <div class="form-group" >
                            <label for="address" class="font-weight-bold">Contact Address<span class="star">*</span></label>
                            <input type="text" id="address" name="address" class="form-control"  required>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6 ">
                                <label for="inputEmail4 " style="display: none"></label>
                                <input type="text" class="form-control" name="city" id="inputEmail4"  placeholder="City" required >
                            </div>
                            <div class="form-group col-md-6 ">
                                <label for="inputPassword4" style="display: none"></label>
                                <input type="text" class="form-control" id="inputPassword4" name="district" placeholder="District"  required>
                            </div>
                        </div>

                        <div class="form-row ">
                            <div class="form-group col-md-6">
                                <label for="inputEmail4" style="display: none"></label>
                                <input type="text" class="form-control" name="pincode" id="inputEmail4"  placeholder="Pincode"  required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="cities" style="display: none"></label>
                                <input type="text" class="form-control" name="nation" id="inputEmail4"  placeholder="Nation"  required>
                            </div>
                        </div>

                        <div class="form-group " id="cus-validators">
                            <label for="phone" class="font-weight-bold">Phone<span class="star">*</span></label>
                            <input type="text" id="phone" name="phone" class="form-control" required>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="gender" class="font-weight-bold">Gender<span class="star">*</span></label>
                                <input type="text" class="form-control" name="gender" id="gender"  required>
                            </div>
                            <div class="form-group col-md-6 ">
                                <label for="age" class="font-weight-bold">Age<span class="star">*</span></label>
                                <input type="number" name="age" min="1" class="form-control" id="age" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="salery" class="font-weight-bold">Select Employee Type<span class="star">*</span></label>
                            <select id="salery" name="emp_type" class="form-control" required>
                                <option value=" ">Select</option>
                                <option value="parmanent">Parmanent Employee</option>
                                <option value="contactual">Contactual Employee</option>
                            </select>
                        </div>

                        <div class="form-group " id="cus-validators">
                            <label for="salery" class="font-weight-bold">Salary for 30days<span class="star">*</span></label>
                            <input type="number" id="salery" name="salary" class="form-control" required>
                        </div>

                        <div class="form-group " id="cus-validators">
                            <label for="shifts">Select Shifts</label>
                            <select class="form-control" id="shifts" name="shifts" required>
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

                        <div class="custom-file">
                            <label class="custom-file-label" id="textPhoto" style="font-size: 14px;" for="upPhoto">Upload Photo</label>
                            <input type="file" name="photo" class="custom-file-input" id="upPhoto" required >
                        </div>

                        <div class="custom-file mt-2">
                            <label class="custom-file-label" id="textSign" style="font-size: 14px;" for="upSign">Upload Signature</label>
                            <input type="file" name="sign" class="custom-file-input" id="upSign" required >
                        </div>

                        <div class="col-12 d-flex justify-content-end mt-4">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" name="subBtn" class="btn btn-primary ml-2">Save</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <div class="row pt-md-2">
    <?php
        $nquery="SELECT id,fname,lname,email,salary,photo,date_of_joining,regId,employee_type FROM nurses";

        if($sql=mysqli_query($db,$nquery)){
            while($row=mysqli_fetch_array($sql)){
    ?>
        <div class="col-md-4">
            <div class="card my-md-2 ">
                <div class="card-body border">
                    <div class="row">
                        <div class="col-md-8 d-flex justify-content-start mb-2">
                            <button class="btn btn-outline-primary btn-sm" data-toggle="modal" data-target="#salaryModal">Salary Info</button>

                            <div class="modal fade" id="salaryModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Enter Salary Info per Month</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="" method="post">
<!--                                                <div class="container">-->
                                                    <div class="form-group ">
                                                        <label for="salery" class="font-weight-bold">HRA<span class="star">*</span></label>
                                                        <input type="number" name="hra"  class="form-control" min="0" required>
                                                    </div>
                                                    <div class="form-group ">
                                                        <label for="salery" class="font-weight-bold">PF<span class="star">*</span></label>
                                                        <input type="number" name="pf" class="form-control" min="0" required>
                                                    </div>
                                                    <div class="form-group ">
                                                        <label for="salery" class="font-weight-bold">Advance Payment(if any)</label>
                                                        <input type="number" name="advpay" class="form-control" min="0">
                                                    </div>
<!--                                                    <div class="container">-->
                                                        <div class="row mb-2">
                                                            <?php
                                                                if($row['employee_type']=='contactual'){
                                                                    ?>
                                                                        <div class="col-12 font-weight-bold d-flex justify-content-center align-items-center">
                                                                            <p class="card-text text-muted">No ESIC as Employee Type is Contactual</p>
                                                                        </div>
                                                                    <?php
                                                                }else if($row['employee_type']=='parmanent'){
                                                                    ?>
                                                                        <div class="col-4 font-weight-bold d-flex justify-content-start align-items-center">
                                                                            <p class="card-text">Enter ESIC:</p>
                                                                        </div>
                                                                        <div class="col-4  ">
                                                                            <a class="btn btn-warning btn-sm" onclick="hideEsic()">Auto</a>
                                                                        </div>
                                                                        <div class="col-4 ">
                                                                            <a class="btn btn-success btn-sm" onclick="showEsic()">Manual</a>
                                                                        </div>
                                                                    <?php
                                                                }
                                                            ?>
                                                        </div>
                                                        <div class="form-group " id="manHra">
                                                            <label for="salery" class="font-weight-bold">ESIC</label>
                                                            <input type="number" name="esic" class="form-control" min="0" placeholder="Value will be in %">
                                                        </div>
<!--                                                    </div>-->
                                                    <div class="form-group ">
                                                        <label for="salery" class="font-weight-bold">Bonus<span class="star">*</span></label>
                                                        <input type="number" name="bonus"  class="form-control" min="0" required placeholder="Value will be in %">
                                                    </div>
                                                    <div class="form-group ">
                                                        <label for="salery" class="font-weight-bold">Special_allowance(if any)<span class="star">*</span></label>
                                                        <input type="number" name="specialallow"  class="form-control" min="0" required placeholder="calulated per month">
                                                    </div>
                                                    <input type="hidden" name="nurseId" value="<?php echo $row['id']; ?>">
                                                    <input type="hidden" name="nurseSal" value="<?php echo $row['salary']; ?>">

                                                    <div class="col-12 d-flex justify-content-end">
                                                        <button type="button" class="btn btn-secondary mr-2" data-dismiss="modal">Close</button>
                                                        <button type="submit" name="deductBtn" class="btn btn-primary">Submit</button>
                                                    </div>
<!--                                                </div>-->
                                            </form>
                                        </div>

                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="col-md-4 d-flex justify-content-end mb-2">
                            <i class="fa fa-pencil-square-o" style="color: #0a6ebd; font-size: 20px;"></i>
                        </div>
                    </div>

                    <div class="col-md-12">

                            <div class="row-md-6 d-flex d-flex justify-content-center">
                                <img src="<?php echo $row['photo']; ?>" class="rounded-circle" width="148" height="148" style="border: 2px solid grey; ">
                            </div>
                        <div class="row-md-4  mt-3 d-flex justify-content-center">
                            <div class="card-text h3 font-italic"><?php echo $row['fname']." ".$row['lname']; ?></div>
                        </div>
                        <div class="row-md-1  mt-2 d-flex justify-content-center">
                            <div class="card-text"><?php echo $row['email']; ?></div>
                        </div>
                        <div class="row-md-1  mt-2 d-flex justify-content-center">
                            <div class="card-text">Salary/month: <?php echo $row['salary']; ?></div>
                        </div>
                        <div class="row-md-1  mt-2 d-flex justify-content-center">
                            <div class="card-text">Employee Type:<span class="text-capitalize"> <?php echo $row['employee_type']; ?></span> </div>
                        </div>
                        <div class="row-md-1  mt-2 d-flex justify-content-center">
                            <div class="card-text">Date Of Joining: <?php
                                $cdate=date_create($row['date_of_joining']);
                                echo date_format($cdate,"D M Y");
                                ?></div>
                        </div>
<!--                        <div class="col-12 d-flex justify-content-center">-->
<!--                            <a href="../dashboard/nurse_attendence.php?reg_id=--><?php //echo $row['regId']; ?><!--" class="btn btn-sm btn-outline-primary">Give Attendence</a>-->
<!--                        </div>               -->
                         <div class="col-12 d-flex justify-content-center">
                            <a href="../dashboard/nurse_salary.php?n_id=<?php echo $row['id']; ?>" class="btn btn-sm btn-outline-primary">Get Salary Slip</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    <?php
            }
        }else{
            echo mysqli_error($db);
        }
    ?>
    </div>




<?php include 'footer_dash.php' ?>