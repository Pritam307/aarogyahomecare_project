<?php


function calulate_salary($nurse_id,$db,$mon,$year){

    //Calculate total deductions
    $deductions_info_query = "SELECT * FROM nurse_salary_infos WHERE nurse_id='$nurse_id'";
    $dres = mysqli_query($db,$deductions_info_query);
    $deductions_info = mysqli_fetch_assoc($dres);
    $hra = $deductions_info['HRA'];
    $esic = $deductions_info['ESIC'];
    $pf = $deductions_info['PF'];
    $bonus = $deductions_info['Bonus'];
    $adv_pay = $deductions_info['Advance'];
    $total_deductions = $hra + $esic+$pf+$bonus+$adv_pay;

    //calculate total amount as per Work
    $nurse_info_query = "SELECT regId,salary,fname,lname,date_of_joining FROM nurses WHERE id='$nurse_id'";
    $info_res = mysqli_query($db,$nurse_info_query);
    $nurse_info = mysqli_fetch_assoc($info_res);
    $nurse_regId= $nurse_info['regId'];
    $EmpId = $nurse_info['regId'];
    $nurse_name = $nurse_info['fname']." ".$nurse_info['lname'];
    $doj = date("d-m-Y",strtotime($nurse_info['date_of_joining']));
    $salary = $nurse_info['salary'];


    $sp_allowance_res = mysqli_query($db,"SELECT special_allowance FROM nurse_salary_infos WHERE nurse_id='$nurse_id'");
    $special_allowance = mysqli_fetch_assoc($sp_allowance_res)['special_allowance'];

    $nurse_attendence_query = "SELECT COUNT(*) AS pdays FROM nurse_attendence WHERE nurse_reg_id='$nurse_regId' AND Month='$mon' AND Year='$year' AND present=1";
    $present_res=mysqli_query($db,$nurse_attendence_query);
    $present_days=mysqli_fetch_assoc($present_res)['pdays'];

    $total_days_of_month = cal_days_in_month(CAL_GREGORIAN,$mon,$year);
    $per_day_amount = round($salary/$total_days_of_month);
    $total_amount =($present_days>0) ? $per_day_amount*$present_days + $special_allowance: 0;

    $net_amount = ($present_days>0) ? $total_amount-$total_deductions : 0;

    return json_encode(array(
        "empId"=>$EmpId,
        "name"=>$nurse_name,
        "date_of_join"=>$doj,
        "presents"=>$present_days,
        "mon_days"=>$total_days_of_month,
        "total_pay_days"=>$present_days,
        "salary"=>$salary,
        "per_day_amount"=>$per_day_amount,
        "special_allowance"=>$special_allowance,
        "hra"=>$hra,
        "esic"=>$esic,
        "pf"=>$pf,
        "bonus"=>$bonus,
        "adv_payment"=>$adv_pay,
        "deductions"=>$total_deductions,
        "totalAmount"=>$total_amount,
        "netPay"=>$net_amount
    ));
}
