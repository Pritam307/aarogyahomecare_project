<?php  include 'header_dash.php'; ?>

<?php
$curr_year = date("Y");
$mon_array=array(1=>"Jan",2=>'Feb',3=>'Mar',4=>'Apr',5=>'May',6=>'Jun',7=>'July',8=>'Aug',9=>'Sept',10=>'Oct',11=>'Nov',12=>'Dec');
$display_mon = array_chunk($mon_array,4,true);
?>

<div class="col-12 d-flex justify-content-center">
    <div class="card-text">Attendence of Year: <span id="salary_year" style="font-weight: bold; color: #bf8300; font-size: 20px;"><?php echo $curr_year; ?></span></div>
</div>

<div class="col-12 mt-md-3">
    <?php
        foreach ($display_mon as $mon_arr){
            ?>
            <div class="row-4">
                <div class="row">
                    <?php
                    foreach ($mon_arr as $key=>$single_mon){
                    ?>
                        <div class="col-md-3">
                        <div class="card m-1 border-0" style="border-radius: 15px">
                            <div class="card-body p-4 text-center">
                                <a href="month_wise_salary_sheet.php?mon=<?php echo $key; ?> && year=<?php echo $curr_year ?>"><div class="card-text text-uppercase" style="font-size: 3vh"><?php echo $single_mon ?></div></a>
                            </div>
                        </div>

                        </div>

                    <?php
                    }
                ?>
                </div>
            </div>
    <?php
        }
    ?>
</div>



<?php include 'footer_dash.php'; ?>
