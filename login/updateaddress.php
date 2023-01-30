<?php include("partials/header.php"); ?>

<main>
    <aside>
        <ul>
            <li><a href="account.php">Account Details</a></li>
            <li><a class="active" href="addressbook.php">Address Book</a></li>
            <li><a href="orderhistory.php">Order History</a></li>
            <li><a id="logout" href="logout.php">Logout</a></li>
        </ul>
    </aside>
    <section>
        <h1>Update Address</h1>
        <?php 
            $address_id = $_GET["id"];

            $sql = "SELECT * FROM address WHERE address_id=$address_id ";

            $result = mysqli_query($conn, $sql);

            if($result){
                $row = mysqli_fetch_assoc($result);
                $customer_id=$row["customer_id"];
                $address=$row["address"];
                $postcode=$row["postcode"];
            } else{
                die(mysqli_error());
            }           
        ?>
        <form action="" method="POST">
            <table>
                <tr>
                    <td><label for="address">Address:</label></td>
                    <td><input type="text" name="address" id="address" value="<?php echo $address; ?>"></td>
                </tr>
                <tr>
                    <td><label for="postcode">Postcode:</label></td>
                    <td><input type="text" name="postcode" id="postcode" value="<?php echo $postcode; ?>"></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <!-- a technical to pass id that you don't want to show -->
                        <input type="hidden" name="address_id" value="<?php echo $address_id; ?>">
                        <input class="btn-primary" type="submit" name="submit" value="Update">
                    </td>
                </tr>
            </table>
        </form>
    </section>
</main>

<?php 
    if(isset($_POST["submit"])){
        $address_id = $_POST["address_id"];
        $address = $_POST["address"];
        $postcode = $_POST["postcode"];
        $customer_id=$_SESSION["customer_id"];
        $sql = "UPDATE address SET address='$address', postcode='$postcode'"; 
        $sql .= "WHERE address_id=$address_id AND customer_id=$customer_id";
        $result = mysqli_query($conn, $sql);
        if($result){
            $_SESSION["update"]="<div class='success'>Address updated successfully.</div>";
            header("location: addressbook.php");
        } else {
            $_SESSION["update"]="<div class='error'>Failed! Please check your address.</div>";
            header("location: addressbook.php");
        }
    }
?>


<?php include("partials/footer.php"); ?>