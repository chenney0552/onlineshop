<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="author" content="Shu Bo">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/shop.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <title>Order Form</title>
</head>
<body>
    <header>
        <nav>
            <ul class="header-list">
                <li><a href="index.html">Home</a></li>
                <li><a href="menswear.html">Menswear</a></li>
                <li><a href="womenswear.html">Womenswear</a></li>
            </ul>
        </nav>
        <div class="imge-wrapper">
            <img src="images/logo.png" alt="logo">
        </div>
        <nav>
            <ul class="header-list">
                <li><a id="login" href="loginpage.php">Login</a></li>
                <li><a id="shoppingbag" class="active" href="shoppingbag.html">Shopping Bag</a></li>
            </ul>
        </nav>
    </header>

    <?php
        // prevent user access from knowing url
        // the page is only accessible when submit successfully
        if(isset($_POST["submit"])){
            // import db connection
            include("config/constants.php");
            // get all form values
            $order_name = $_POST["name"];
            $order_email = $_POST["email"];
            $shipping_address = $_POST["address"];
            $postcode = $_POST["postcode"];
            $total = $_POST["total"];
            // check if buyer logged in or not
            if(isset($_SESSION["customer_id"])){
                $customer_id = $_SESSION["customer_id"];
            } else {
                $customer_id = 0;
            }
            // insert order data into order_online table
            $sql = "INSERT INTO order_online VALUES(null,$customer_id,'$order_name','$order_email','$shipping_address','$postcode',current_timestamp(),$total)";
            $result = mysqli_query($conn, $sql) or die(mysqli_error()); 
    
            // show message
            echo "<h1 style='color: green;'>Your order has been placed successfully.<br>Thank you ".$order_name." for your business!</h1>"; 
        } else {
            // redirect to home page
            header("location: index.html");
        }    
    ?>

    <footer>
        <ul class="business-list">
            <li><a href="">COUNTRY/REGION: CANADA</a></li>
            <li><a href="">NEWSLETTER SIGNUP</a></li>
            <li><a href="">CUSTOMER CARE</a></li>
            <li><a href="">ABOUT US</a></li>
        </ul>
        <ul class="social-list">
            <li><a href="https://www.youtube.com" target="_blank"><i class="uil uil-youtube"></i></a></li>
            <li><a href="https://www.instagram.com/" target="_blank"><i class="uil uil-instagram-alt"></i></a></li>
            <li><a href="https://www.facebook.com" target="_blank"><i class="uil uil-facebook"></i></a></li>
            <li><a href="https://www.twitter.com/" target="_blank"><i class="uil uil-twitter"></i></a></li>
        </ul>
    </footer>
    <script src="js/confirmation.js"></script>
</body>
</html>


