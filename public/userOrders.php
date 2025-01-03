
        <?php 
       
            session_start();      
       
        ?>


        <?php 
        
        include '../templates/header.php';
        require_once ('../functions/functions.php');

        if(isset($_POST["Submit"]))
        {
            // $_SESSION["orderid"] =[];
            // $_SESSION["cart"]=[];
            header("location:index.php");
        }
       
        ?>
        
        <div class="main_area">
            <section>
                <table>
                    <tr>
                        <th>Order Id </th>
                        <th>Customer Name</th>
                        <th>Address</th>
                        <th>Total </th>
                        <th>Date of Order</th>
                        <th>Status</th>
                    </tr>

                    <?php
                    try
                    {
                        require_once('../src/UserConnect.php');
                    
                        $total = 0;
                        
                        $sql = "SELECT co.orderid, co.total, co.status, co.dateoforder, pd.name, pd.address FROM 
                                customer_order co 
                                left join paymentdetails pd on co.customerid = pd.userid
                                WHERE co.customerid = :UserId";
                        
                        $userId = $_SESSION['UserId'];
                        $statement = $connection->prepare($sql);
                        $statement->bindParam(':UserId', $userId, PDO::PARAM_INT);
                        $statement->execute();
                        $orderdetails = $statement->fetchAll(); 
                        //$result = $connection->query($sql);
                    }
                    catch(PDOException $error) 
                    {
                        echo $sql . "<br>" . $error->getMessage();
                    } 
                    // var_dump( $orderdetails);die;

                   //Loop through items in cart and display in table
                    foreach ($orderdetails as $row) {                                           

                        $orderId = $row['orderid'];
                        $customerName = $row['name'];
                        $address = $row['address'];
                        $order_total = $row['total'];
                        $status = $row['status'];
                        $dateOfOrder = $row['dateoforder'];
                        
                        // $item_total = $quantity * $price;
                        // $total += $item_total;

                        echo "<tr>";
                        echo "<td> $orderId </td>";
                        echo "<td> $customerName </td>";
                        echo "<td> $address</td>";
                        echo "<td> &euro;$order_total </td>";
                        echo "<td> $dateOfOrder </td>";
                        echo "<td> $status </td>";                       
                        echo "</tr>";
                    }
                    
                    //Display total
                    echo "<tr>";
                    echo "<td xolspan='3'> Total:</td>";
                    echo "<td>&euro;$total </td>";
                    echo "</tr>";

                    // $_SESSION["orderTotal"] = $total;
                    
                    

                    ?>                    
                </table>
                <form action="userOrders.php" method="post">
                    <input name ="Submit" type="submit" value="OK" class="button"/>
                </form>
            </section>
        </div>
        <?php require_once "../templates/footer.php";?>