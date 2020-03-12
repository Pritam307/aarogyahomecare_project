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
include "header_dash.php";
include_once "../dbconnect.php";
$name=$regid=$djoin=$salary=null;
$mon_arry=array(
    'January'=>1,
    'February'=>2,
    'March'=>3,
    'April'=>4,
    'May'=>5,
    'June'=>6,
    'July'=>7,
    'August'=>8,
    'September'=>9,
    'October'=>10,
    'November'=>11,
    'December'=>12
);
$total_days_in_mon=$present_days=$per_day_amt=$total_deductions=$total_income=$special_allownace=$de_result=0;

if(isset($_GET['n_id'])){
    $id=$_GET['n_id'];
    $query="SELECT fname,lname,regId,date_of_joining,salary FROM nurses WHERE id='$id'";
    if($row=mysqli_query($db,$query)){
        $res=mysqli_fetch_assoc($row);
        $name=$res['fname']." ".$res['lname'];
        $regid=$res['regId'];
        $djoin=$res['date_of_joining'];
        $salary=$res['salary'];
    }else{
        echo mysqli_error($db);
    }

    $q2="SELECT * FROM nurse_salary_infos WHERE nurse_id='$id'";
    $row2=mysqli_query($db,$q2);
    $de_result=mysqli_fetch_assoc($row2);
    echo $de_result['HRA'];

    $total_deductions=(int)$de_result['HRA']+(int)$de_result['ESIC']+(int)$de_result['PF']+(int)$de_result['Bonus']+(int)$de_result['Advance'];

}else{
    echo "fail";
}

if(isset($_POST['calBtn'])){
    $selected_year=(int)mysqli_real_escape_string($db,$_POST['selyear']);
    $selected_mon=mysqli_real_escape_string($db,$_POST['selmon']);
    $total_days_in_mon=cal_days_in_month(CAL_GREGORIAN,$mon_arry[$selected_mon],$selected_year);
//    echo $total_days_in_mon."<br>";
    $q1="SELECT COUNT(present)  FROM nurse_attendence WHERE Month='$mon_arry[$selected_mon]' AND nurse_reg_id='$regid' AND present=1";
    if($row=mysqli_query($db,$q1)){
        $res=mysqli_fetch_array($row);
        $present_days=$res[0];
        $per_day_amt=number_format((int)$salary/$total_days_in_mon);
//        echo $per_day_amt."<br>";
//        echo $special_allownace."<br>";
        $total_income=$per_day_amt*$present_days+$special_allownace;
//        echo $total_income;
//        echo $res[0];
    }else{
        echo mysqli_error($db);

    }
}

$curr_year=date("Y");
$temp_date=date_create($djoin);
$joining_year=date_format($temp_date,"Y");
$joining_mon=date_format($temp_date,"m");


?>


<div class="row">
    <div class="col-12">
        <div class="card h-100">
            <div class="card-body text-center ">
                <form action="" method="post" id="myForm">
                    <div class="row">
    <!--                    --><?php //checkJoiningYear($djoin);?>
                        <div class="col-4">
                            <div class="card-text"><span class="font-weight-bold">Name:</span><?php echo $name; ?></div>
                        </div>
                        <div class="col-4">
                            <div class="card-text"><span class="font-weight-bold">Date Of Joining:</span><?php echo $djoin; ?></div>
                        </div>
                        <div class="col-4">
                            <div class="card-text"><span class="font-weight-bold"> Registration ID:</span> <?php echo $regid; ?></div>
                        </div>

                    </div>
                    <div class="row mt-3">
                        <div class="col-4 ">
                            <div class="card-text d-inline-flex font-weight-bold">Select Year</div>
                            <div class="form-group d-inline-flex align-items-center">
                                <label for="selectYear" style="display: none"></label>
                                <select class="form-control" id="selectYear" name="selyear" data-value="<?php echo $joining_year;  ?>" onclick="changeMonth('<?php echo $joining_mon; ?>','<?php echo $joining_year; ?>')">
                                </select>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="card-text d-inline-flex font-weight-bold">Select Month:</div>
                            <div class="form-group d-inline-flex">
                                <label for="monselect" style="display: none"></label>
                                <select class="form-control month" name="selmon" data-value="<?php echo $joining_mon; ?>" id="monselect" >
                                </select>
                            </div>
                        </div>
                        <div class="col-4">
                            <button type="submit" name="calBtn" class="btn btn-success btb-sm">Calculate</button>
                        </div>
                    </div>
                </form>
                <div class="container d-flex justify-content-center">
                    <div class="col-12">
                        <table class="table table-striped table-bordered">
                            <tbody>
                                <tr>
                                    <td>Present Days</td>
                                    <td><?php echo $present_days; ?></td>
                                </tr>
                                <tr>
                                    <td>Total Days in Month</td>
                                    <td><?php echo $total_days_in_mon;  ?></td>
                                </tr>
                                <tr>
                                    <td>Per Day Amount</td>
                                    <td><?php echo $per_day_amt;  ?></td>
                                </tr>
                                <tr>
                                    <td>Salary</td>
                                    <td>Rs <?php echo $salary; ?></td>
                                </tr>
                                <tr>
                                    <td>Special Allowance</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>HRA</td>
                                    <?php if(isset($de_result['HRA'])){
                                        ?>
                                        <td>Rs <?php echo $de_result['HRA'];  ?></td>
                                        <?php
                                    }else{
                                        ?>
                                        <td>None</td>
                                        <?php
                                    } ?>
                                </tr>
                                <tr>
                                    <td>ESIC(4% of Salary)</td>
                                    <?php if(isset($de_result['ESIC'])){
                                        ?>
                                        <td>Rs <?php echo $de_result['ESIC'];  ?></td>
                                        <?php
                                    }else{
                                        ?>
                                        <td>None</td>
                                        <?php
                                    } ?>
                                </tr>
                                <tr>
                                    <td>PF</td>
                                    <?php if(isset($de_result['PF'])){
                                        ?>
                                        <td>Rs <?php echo $de_result['PF'];  ?></td>
                                        <?php
                                    }else{
                                        ?>
                                        <td>None</td>
                                        <?php
                                    } ?>
                                </tr>
                                <tr>
                                    <td>Bonus(2% of Salary)</td>
                                    <?php if(isset($de_result['Bonus'])){
                                        ?>
                                        <td>Rs <?php echo $de_result['Bonus'];  ?></td>
                                        <?php
                                    }else{
                                        ?>
                                        <td>None</td>
                                        <?php
                                    } ?>
                                </tr>
                                <tr>
                                    <td>Advance Payment(if any)</td>
                                    <?php if(isset($de_result['Advance'])){
                                        ?>
                                        <td>Rs <?php echo $de_result['Advance'];  ?></td>
                                        <?php
                                    }else{
                                        ?>
                                        <td>None</td>
                                        <?php
                                    } ?>
                                </tr>
                                <tr>
                                    <td>Total Deductions</td>

                                    <?php if(isset($total_deductions)){
                                        ?>
                                        <td>Rs <?php echo $total_deductions;  ?></td>
                                        <?php
                                    }else{
                                        ?>
                                        <td>Rs 0.00</td>
                                        <?php
                                    } ?>
                                </tr>
                                <tr>
                                    <td>Total Income Amount</td>
                                    <td><?php echo $total_income; ?></td>
                                </tr>
                                <tr>
                                    <td>Net Pay</td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-12 d-flex justify-content-center mt-3">
                    <button class="btn btn-secondary btn-sm">Print</button>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include "footer_dash.php"; ?>