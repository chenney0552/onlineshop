<?php include("partials/header.php"); ?>

<main>
    <aside>
        <ul>
            <li><a href="account.php">Account Details</a></li>
            <li><a class="active" href="">Address Book</a></li>
            <li><a href="orderhistory.php">Order History</a></li>
            <li><a id="logout" href="logout.php">Logout</a></li>
        </ul>
    </aside>
    <section>
        <h1>Address Book</h1>
        <?php
            if(isset($_SESSION["add"])){
                echo $_SESSION["add"];
                // remove session message after displayed once
                unset($_SESSION["add"]);
            }
            if(isset($_SESSION["delete"])){
                echo $_SESSION["delete"];
                unset($_SESSION["delete"]);
            }
            if(isset($_SESSION["update"])){
                echo $_SESSION["update"];
                unset($_SESSION["update"]);
            }
        ?>
        
        <a id="add-address" class="btn-primary" href="newaddress.php">Add Address</a>
        
        
        <table class="address-table">
            <tr>
                <th>Address</th>
                <th>Postcode</th>
                <th>Actions</th>
            </tr>
            <?php
                $customer_id=$_SESSION['customer_id'];
                $sql = "SELECT * FROM address WHERE customer_id=$customer_id";
                $result = mysqli_query($conn, $sql);
                if($result){
                    $count = mysqli_num_rows($result);
                    if($count>0){

                        while($rows=mysqli_fetch_assoc($result)){

                            $address_id=$rows["address_id"];
                            $customer_id=$rows["customer_id"];
                            $address=$rows["address"];
                            $postcode=$rows["postcode"];
                            ?>
                            <!-- break php here -->
                            <tr>
                                <td><?php echo $address; ?></td>
                                <td><?php echo $postcode; ?></td>
                                <td class="actions">
                                    <a href="<?php echo "updateaddress.php?id=".$address_id; ?>" class="btn-secondary">Update</a>
                                    <a href="<?php echo "deleteaddress.php?id=".$address_id; ?>" class="btn-danger">Delete</a>
                                </td>
                            </tr>
                            <!-- continue here -->
                            <?php
                        }
                    } else {
                        echo "<tr><td colspan='3'>Your address book is empty now.</td></tr>";
                    }
                } else {
                    die(mysqli_error());
                }
            ?>
        </table>
    </section>
</main>

<?php include("partials/footer.php"); ?>