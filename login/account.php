<?php include("partials/header.php"); ?>
<script>
    // pass data from php to js so that frontend html can use the value
    var uname = "<?php echo $_SESSION["full_name"]; ?>";
    var uid = "<?php echo $_SESSION["customer_id"]; ?>";
    sessionStorage.setItem("username", uname);
    sessionStorage.setItem("uid", uid);
</script>
<main>
    <aside>
        <ul>
            <li><a class="active" href="account.php">Account Details</a></li>
            <li><a href="addressbook.php">Address Book</a></li>
            <li><a href="orderhistory.php">Order History</a></li>
            <li><a id="logout" href="logout.php">Logout</a></li>
        </ul>
    </aside>
    <section>
        <h1>Account Details</h1>
        <?php
            // get id from session
            $customer_id = $_SESSION["customer_id"];
            $sql = "SELECT * FROM customer WHERE customer_id=$customer_id";
            $result = mysqli_query($conn, $sql);
            if($result){
                $row=mysqli_fetch_assoc($result);
                $full_name = $row["full_name"];
                $email = $row["email"];
            }
        ?>
        <?php
            // show message after click SAVE CHANGES button
            if(isset($_SESSION["change"])){
                echo $_SESSION["change"];
                unset($_SESSION["change"]);
            }
        ?>
        <form action="" method="POST">
            <fieldset>
                <legend>Account Information</legend>
                <label for="full_name">Full Name</label>
                <input type="text" name="full_name" id="full_name" value="<?php echo $full_name; ?>">
                <label for="email">Email Address</label>
                <input type="text" name="email" id="email" value="<?php echo $email; ?>">
            </fieldset>
            <fieldset>
                <legend>Account Password</legend>
                <label for="oldpass">Old password</label>
                <input type="password" name="oldpass" id="oldpass">
                <label for="newpass">New password</label>
                <input type="password" name="newpass" id="newpass">
            </fieldset>
            <button class="btn-primary" name="submit" type="submit">SAVE CHANGES</button>
        </form>
    </section>
</main>


<?php 
    if(isset($_POST["submit"])){
        $full_name = $_POST["full_name"];
        $email = $_POST["email"];
        $oldpass = $_POST["oldpass"];
        $newpass = $_POST["newpass"];
        $customer_id = $_SESSION["customer_id"];
        $sql = "SELECT * FROM customer WHERE customer_id=$customer_id AND password='$oldpass'";
        $result = mysqli_query($conn, $sql);
        // check if old password match the record in db
        if($result){
            $count = mysqli_num_rows($result);
            if($count==1){
                // validate new password, update, set message and redirect
                $passRegex = "/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,20}$/";
                if(preg_match($passRegex,$newpass)==1){
                    $sql = "UPDATE customer SET full_name='$full_name',email='$email',password='$newpass' WHERE customer_id=$customer_id";
                    $result = mysqli_query($conn, $sql);
                    $_SESSION["change"]="<div class='success'>Change password successfully.</div>";
                    header("location: account.php");
                } else {
                    $_SESSION["change"]="<div class='error'>New password should be at least 1 digit, 1 uppercase, 1 lowercase and 6 characters long.</div>";
                    header("location: account.php");
                }
            } else {
                $_SESSION["change"]="<div class='error'>Invalid Password!</div>";
                header("location: account.php");
            }
        } else {
            die(mysqli_error());
        }
    }
?>


<?php include("partials/footer.php"); ?>