<?php 
    // check user is login or not
    if(!isset($_SESSION["full_name"])){
        // user is not logged in
        $_SESSION["check"]= "<div class='error'>Please login to access account.</div>";
        header("location: ../loginpage.php");
    }
?>