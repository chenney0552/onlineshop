<?php 
    include("../config/constants.php"); 
    
    $address_id = $_GET["id"];

    $sql = "DELETE FROM address WHERE address_id=$address_id";

    $result = mysqli_query($conn, $sql);

    if($result){

        $_SESSION["delete"] = "<div class='success'>Address delete successfully</div>";
        header("location: addressbook.php");
        
    } else{

        $_SESSION["delete"] = "<div class='error'>Failed to delete address</div>";
        header("location: addressbook.php");
    }

?>