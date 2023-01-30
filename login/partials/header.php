<?php 
    include("../config/constants.php");
    include("checklogin.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Shu Bo">
    <link rel="stylesheet" href="../css/login.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <title>Account</title>
</head>
<body>
<header>
        <nav>
            <ul class="header-list">
                <li><a href="../index.html">Home</a></li>
                <li><a href="../menswear.html">Menswear</a></li>
                <li><a href="../womenswear.html">Womenswear</a></li>
            </ul>
        </nav>
        <div class="imge-wrapper">
            <img src="../images/logo.png" alt="logo">
        </div>
        <nav>
            <ul class="header-list">
                <li><a class="active" href="account.php">Hello, <?php echo $_SESSION["full_name"]; ?></a></li>
                <li><a id="shoppingbag" href="../shoppingbag.html">Shopping Bag</a></li>
            </ul>
        </nav>
    </header>