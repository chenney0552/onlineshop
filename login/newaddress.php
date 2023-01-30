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
        <h1>Add Address</h1>

        <?php
            if(isset($_SESSION["add"])){
                echo $_SESSION["add"];
                unset($_SESSION["add"]);
            }
        ?>

        <form action="" method="POST">
            <table>
                <tr>
                    <td><label for="address">Address:</label></td>
                    <td><input type="text" name="address" id="address"></td>
                </tr>
                <tr>
                    <td><label for="postcode">Postcode:</label></td>
                    <td><input type="text" name="postcode" id="postcode"></td>
                </tr>
                <tr>
                    <td colspan="2"><input class="btn-primary" type="submit" name="submit" value="Add Address"></td>
                </tr>
            </table>
        </form>
    </section>
</main>



<?php include("partials/footer.php"); ?>

<?php 
    if(isset($_POST["submit"])){
        $address=$_POST["address"];
        $postcode=$_POST["postcode"];
        $custoemr_id=$_SESSION["customer_id"];
        $sql="INSERT INTO address VALUES(null,'$custoemr_id','$address','$postcode')";
        $result=mysqli_query($conn,$sql);

        if($result){
            $_SESSION["add"] = "<div class='success'>Address added successfully</div>";
            header("location: addressbook.php");
        } else {
            $_SESSION["add"] = "<div class='error'>Failed! Please double check your address and postcode.</div>";
            header("location: newaddress.php");
        }
    }
?>