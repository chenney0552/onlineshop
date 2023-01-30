<?php include("partials/header.php"); ?>

<main>
    <aside>
        <ul>
            <li><a href="account.php">Account Details</a></li>
            <li><a href="addressbook.php">Address Book</a></li>
            <li><a class="active" href="orderhistory.php">Order History</a></li>
            <li><a id="logout" href="logout.php">Logout</a></li>
        </ul>
    </aside>
    <section>
        <table class="order-details">
            <tr>
                <th>Order Number</th>
                <th>Order Name</th>
                <th>Order Email</th>
                <th>Shipping Address</th>
                <th>Postcode</th>
                <th>Order Date</th>
                <th>Total</th>
            </tr>
            <?php
                $customer_id = $_SESSION["customer_id"];
                $sql = "SELECT * FROM order_online WHERE customer_id=$customer_id";
                $result = mysqli_query($conn, $sql);

                if($result){
                    $count = mysqli_num_rows($result);

                    if($count>0){
                        while($rows=mysqli_fetch_assoc($result)){
                            $order_number = $rows["order_id"];
                            $order_name = $rows["order_name"];
                            $order_email = $rows["order_email"];
                            $shipping_address = $rows["shipping_address"];
                            $postcode = $rows["postcode"];
                            $order_date = $rows["order_date"];
                            $total = $rows["total"];
                            ?>
                            <tr>
                                <td><?php echo $order_number; ?></td>
                                <td><?php echo "$order_name"; ?></td>
                                <td><?php echo "$order_email"; ?></td>
                                <td><?php echo "$shipping_address"; ?></td>
                                <td><?php echo "$postcode"; ?></td>
                                <td><?php echo "$order_date"; ?></td>
                                <td>$<?php echo $total; ?></td>
                            </tr>
                            <?php
                        }
                    } else {
                        echo "<tr><td colspan='7'>You don't have order history.</td></tr>";
                    }   
                } else {
                    die(mysqli_error());
                }
            ?>
        </table>
    </section>
</main>

<?php include("partials/footer.php"); ?>