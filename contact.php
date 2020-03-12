<?php
  include('header.php');
  include_once ('dbconnect.php');
?>

<?php

if(isset($_POST['submitContact'])){
    $fname=mysqli_real_escape_string($db,$_POST['fname']);
    $lname=mysqli_real_escape_string($db,$_POST['lname']);
    $msg=mysqli_real_escape_string($db,$_POST['message']);
    $email=mysqli_real_escape_string($db,$_POST['email']);

    $conquery="INSERT INTO contact (firstname,lastname,message,email) VALUES ('$fname','$lname','$msg','$email')";
    if($res=mysqli_query($db,$conquery)){
        echo "success";
    }else{
        echo mysqli_error($db);
    }
}
?>


  <!-- END: header -->
  <section class="probootstrap-slider flexslider">
    <ul class="slides">
      <li style="background-image: url(img/banner1.jpg);" class="overlay2">
        <div class="container">
          <div class="row">
            <div class="col-md-12 text-center">
              <div class="slides-text probootstrap-animate" data-animate-effect="fadeIn">
                <h2>Contact</h2>
                <p>Feel free to contact us any time for any Queries</p>
              </div>
            </div>
          </div>
        </div>
      </li>
    </ul>
  </section>
  <!-- END: slider  -->

  <section class="probootstrap-section">
    <div class="container">
      <div class="row">
        <div class="col-md-8 probootstrap-animate overlap">
          <form action="" method="post" class="probootstrap-form probootstrap-form-box mb60">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="fname">First Name</label>
                  <input type="text" class="form-control" id="fname" name="fname" required>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="lname">Last Name</label>
                  <input type="text" class="form-control" id="lname" name="lname" required>
                </div>
              </div>
            </div>
            <div class="form-group">
              <label for="email">Email</label>
              <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="form-group">
              <label for="message">Message</label>
              <textarea cols="30" rows="10" class="form-control" id="message" name="message" required></textarea>
            </div>
            <div class="form-group">
              <input type="submit" class="btn btn-primary" id="submit" name="submitContact" value="Send Message">
            </div>
          </form>
        </div>
        <div class="col-md-3 col-md-push-1 probootstrap-animate">
          <h4 class="text-uppercase">head office</h4>
          <ul class="with-icon colored">
            <li><i class="icon-location2"></i> <span>Mandakini Bibah Bhawan complex, Kotoky Pukhuri, Bye Pass Tini Ali, Jorhat, Pin - 785006, Assam</span></li>
            <li><i class="icon-mail"></i><span>info@aarogyahomecare.com</span></li>
            <li><i class="icon-phone2"></i><span>+91 9435960652, 9101786597, 9531339627</span></li>
          </ul>

        <h4 class="text-uppercase">branch office</h4>
        <ul class="with-icon colored">
            <li><i class="icon-location2"></i> <span>SIVASAGAR: OId Amulapatty, Ganak Patty, By Lane No. 6</span></li>
            <li><i class="icon-mail"></i><span>info@aarogyahomecare.com</span></li>
            <li><i class="icon-phone2"></i><span>+91 9435960652, +91 7086847871</span></li>
        </ul>


        </div>
      </div>
    </div>
  </section>  
  <!-- END section -->
  <div class="col-12 probootstrap-animate" align="center">
    <div id="map" class=" container">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3562.767342342199!2d94.18186801447968!3d26.751799583197204!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3746c3ceb2bc28f7%3A0x8ad690dd9028fe34!2sAAROGYA%20HOME%20CARE%20SERVICE!5e0!3m2!1sen!2sin!4v1580747838248!5m2!1sen!2sin"
                width="1200" height="400" frameborder="0" style="border:0;" allowfullscreen="">
        </iframe>
    </div>
  </div>


  <!-- END section -->
  

<?php
  include('footer.php');
?>
