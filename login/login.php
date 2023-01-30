<?php
    include("../config/constants.php");

    if(isset($_SESSION["check"])){
        echo $_SESSION["check"];
        unset($_SESSION["check"]);
    }

    if(isset($_SESSION["login"])){
        echo $_SESSION["login"];
        unset($_SESSION["login"]);
    }

    if(isset($_POST["submit"])){
        $email = $_POST["email"];
        $password = $_POST["password"];
        $sql = "SELECT * FROM customer WHERE email='$email' AND password='$password'";
        $result = mysqli_query($conn, $sql);

        if($result){
            $count = mysqli_num_rows($result);

            if($count == 1){
                $row = mysqli_fetch_assoc($result);
                $_SESSION["customer_id"] = $row["customer_id"];
                $_SESSION["full_name"] = $row["full_name"];
                $_SESSION["login"]="<div class='success'>Hello,".$_SESSION["full_name"]."</div>";
                header("location: account.php");
            } else {
                $_SESSION["login"]="<div class='error'>Username or Password did not match.</div>";
                header("location: login.php");
            }
        }
    }
?>