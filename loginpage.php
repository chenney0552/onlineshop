<?php include("config/constants.php"); ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="author" content="Chen Cheng" />
  <link rel="stylesheet" href="css/loginpage.css" />
  <title>Login Page</title>
</head>

<body>

  <div id="id01" class="modal">
    <form class="modal-content" action="" method="POST">
      <h2 class="login-title">Login</h2>

      <div class="imgcontainer">
        <img name="login-logo" src="images/logo.png" alt="Logo" class="Logo">
      </div>
      <?php
        // prompt user who is not logged in and like to access account pages by typing url
        if(isset($_SESSION["check"])){
          echo $_SESSION["check"];
          unset($_SESSION["check"]);
        }
        // prompt user that they fail to login
        if(isset($_SESSION["login"])){
            echo $_SESSION["login"];
            unset($_SESSION["login"]);
        }
        // prompt user if they signed up successful
        if(isset($_SESSION["sign-up"])){
          echo $_SESSION["sign-up"];
          unset($_SESSION["sign-up"]);
      }
      ?>
      <div class="container">
        <label for="email"><b>Email</b></label>
        <input type="text" placeholder="Enter Email" id="email" name="email" required>

        <label for="psw"><b>Password</b></label>
        <input type="password" placeholder="Enter Password" id="psw" name="psw" required>

        <button type="submit" name="submit">Login</button>
        <span class="register">Looking to <a class="register-link" href="register.html">register an account </a>?</span>
      </div>
      
      <div class="container-cancel">
        <a href="index.html" class="cancel">Cancel</a>
      </div>
    </form>
  </div>
</body>
<?php
    if(isset($_POST["submit"])){
        $email = $_POST["email"];
        $password = $_POST["psw"];
        $sql = "SELECT * FROM customer WHERE email='$email' AND password='$password'";
        $result = mysqli_query($conn, $sql);

        if($result){
            $count = mysqli_num_rows($result);

            if($count == 1){
                $row = mysqli_fetch_assoc($result);
                $_SESSION["customer_id"] = $row["customer_id"];
                $_SESSION["full_name"] = $row["full_name"];
                header("location: login/account.php");
            } else {
                $_SESSION["login"]="<div class='error'>Username or Password did not match.</div>";
                header("location: loginpage.php");
            }
        } else {
            die(mysqli_error());
        }
    }
?>
</html>

