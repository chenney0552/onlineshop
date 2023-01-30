<?php 

    require_once('config/constants.php'); 

    if(isset($_POST["submit"])){
        
        $email = $_POST["email"]; // access the form data
        $full_name = $_POST["full_name"];
        $password = $_POST["pass"];
        // check if email is unique 
        $sql1 = "SELECT email FROM customer WHERE email='$email'";
        $result1 = mysqli_query($conn,$sql1);
        if($result1){
            $count = mysqli_num_rows($result1);
            if($count!=0){
                $_SESSION["sign-up"] = "<div class='error'>The email has been registered.</div>";
                header("location: registerprocess.php");
            } else {
                //register the user in db
                $sql2 = "INSERT INTO customer (full_name, email, password) VALUES ('$full_name','$email','$password')";
                $result2 = mysqli_query($conn,$sql2) or die(mysqli_error());
    
                if($result2){
                    $_SESSION["sign-up"] = "<div class='success'>Signed up successfully!</div>";
                    header("location: loginpage.php");
                } else {
                    $_SESSION["sign-up"] = "<div class='error'>Failed</div>";
                    header("location: loginpage.php");
                }
            }
        }
    }

?>
