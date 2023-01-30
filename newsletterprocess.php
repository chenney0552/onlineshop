<?php 

    require_once('config/constants.php'); 

    if(isset($_POST["submit"])){
        
        $email = $_POST["email"];
        $subscription = $_POST["category"];
        if(isset($_SESSION["customer_id"])){
            $customer_id = $_SESSION["customer_id"];
        } else {
            $customer_id = 0;
        }
        // check if email is unique 
        $sql1 = "SELECT * FROM newsletter WHERE email='$email' AND subscription='$subscription'";
        $result1 = mysqli_query($conn,$sql1);
        if($result1){
            $count = mysqli_num_rows($result1);
            if($count==0){
                //write down in db
                $sql2 = "INSERT INTO newsletter VALUES ('$email','$subscription','$customer_id')";
                $result2 = mysqli_query($conn,$sql2) or die(mysqli_error());
                header('Location: ' . $_SERVER['HTTP_REFERER']);
            } else {
                $sql3 = "UPDATE newsletter SET subscription='$subscription', customer_id='$customer_id' WHERE email='$email'";
                $result3 = mysqli_query($conn,$sql3) or die(mysqli_error());
                header('Location: ' . $_SERVER['HTTP_REFERER']);
            }
        }
    }

?>