<?php 
    // import constants.php
    include("../config/constants.php");
    // destory the session 
    session_destroy();
    // close connection with db
    if(isset($conn)){
        mysqli_close($conn);
    }

    // redirect to home page
    header("location: ../index.html");  
?>



