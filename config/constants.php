<?php
    // start session
    session_start();
    


    // create constants that are often reused in the project
    define("LOCALHOST", "localhost");
    define("DB_USERNAME", "root");
    define("DB_PASSWORD", "");
    define("DB_NAME", "onlineshop");

    $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD, DB_NAME) or die(mysqli_error());

?>