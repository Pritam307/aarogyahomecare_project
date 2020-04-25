<?php  include '../dashboard/header_dash.php'; ?>

<?php
include "../dbconnect.php";
include 'salary_calculator.php';
$mon_array=array(1=>"January",2=>'February',3=>'March',4=>'April',5=>'May',6=>'June',7=>'July',8=>'August',9=>'September',10=>'October',11=>'November',12=>'December');

if(isset($_REQUEST['mon']) && isset($_REQUEST['year'])){
    $requested_month = (int)$_REQUEST['mon'];
    $requested_year = (int)$_REQUEST['year'];
    $no_of_days = cal_days_in_month(CAL_GREGORIAN,$requested_month, $requested_year);
}
$nurse_info_list = array();
$nurse_list_query = "SELECT id FROM nurses";
$list_res = mysqli_query($db,$nurse_list_query);
while( $nurse_list = mysqli_fetch_array($list_res)){
    $test = calulate_salary($nurse_list['id'],$db,$requested_month,$requested_year);
    array_push($nurse_info_list,$test);
}


//print_r($nurse_info_list);

?>

<div class="row">
    <div class="col-3  d-flex justify-content-start align-items-center">
        <div class="alert alert-primary w-100 text-center" style="width: 50%" role="alert">
           Attendence/Salary Sheet For Month
        </div>
    </div>
    <div class="col-3  d-flex justify-content-center align-items-center px-0">
        <div>
            <p class="badge badge-secondary text-uppercase" style="font-size: 20px"><?php echo $mon_array[$requested_month] ?> <?php echo $requested_year ?></p>
        </div>
    </div>
    <div class="col-3  d-flex justify-content-center align-items-center px-0">
        <div>
            <p class="font-weight-bold">FROM</p>
            <p class="badge badge-warning text-uppercase" style="font-size: 20px"><?php echo $mon_array[$requested_month]; ?> 1 <?php echo $requested_year ?></p>
        </div>
    </div>
    <div class="col-3  d-flex justify-content-center align-items-center px-0">
        <div>
            <p class="font-weight-bold">TO</p>
            <p class="badge badge-warning text-uppercase" style="font-size: 20px"><?php echo $mon_array[$requested_month]; ?> <?php echo $no_of_days ?> <?php echo $requested_year ?></p>
        </div>
    </div>
</div>

<div class="col-12">
    <div class="card">
        <div class="card-body">
            <table class="table table-bordered table-striped table-responsive">
                <thead>
                    <th class="border">Emp ID</th>
                    <th class="border">Name</th>
                    <th class="border">Date of Joining</th>
                    <th class="border">Presence</th>
                    <th class="border">Total Days of Months</th>
                    <th class="border">Total Payable Days</th>
                    <th class="border">Salary</th>
                    <th class="border">Per Day Amount</th>
                    <th class="border">Special Allowance</th>
                    <th class="border">HRA</th>
                    <th class="border">ESIC</th>
                    <th class="border">PF</th>
                    <th class="border">Bonus</th>
                    <th class="border">Advance Payment</th>
                    <th class="border">Total Deductions</th>
                    <th class="border">Total Amount</th>
                    <th class="border">Net Pay</th>
                </thead>
                <tbody>
                    <?php
                        foreach($nurse_info_list as $value){
                            $data = json_decode($value,true);
                            ?>
                                <tr class="text-center">
                                    <td><?php echo $data["empId"]; ?></td>
                                    <td><?php echo $data["name"]; ?></td>
                                    <td><?php echo $data["date_of_join"]; ?></td>
                                    <td><?php echo $data["presents"]; ?></td>
                                    <td><?php echo $data["mon_days"]; ?></td>
                                    <td><?php echo $data["total_pay_days"]; ?></td>
                                    <td><?php echo $data["salary"]; ?></td>
                                    <td><?php echo $data["per_day_amount"]; ?></td>
                                    <td><?php echo $data["special_allowance"]; ?></td>
                                    <td><?php echo $data["hra"]; ?></td>
                                    <td><?php echo $data["esic"]; ?></td>
                                    <td><?php echo $data["pf"]; ?></td>
                                    <td><?php echo $data["bonus"]; ?></td>
                                    <td><?php echo $data["adv_payment"]; ?></td>
                                    <td><?php echo $data["deductions"]; ?></td>
                                    <td><?php echo $data["totalAmount"]; ?></td>
                                    <td><?php echo $data["netPay"]; ?></td>
                                </tr>
                            <?php
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>


<?php include '../dashboard/footer_dash.php'; ?>

