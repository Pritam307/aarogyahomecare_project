<?php
    unset($_SESSION["nurse"]);
    unset($_SESSION["nurse_name"]);
    unset($_SESSION["nurse_regId"]);
    header('location:signIn.php');
?>