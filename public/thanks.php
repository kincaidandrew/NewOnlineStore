
    <?php 
    //Start the session
    session_start();

    include '../templates/header.php';
    $userdetails =[];
    $orderdetails =[];
    

    if(isset($_POST["Submit"]))
    {
        $_SESSION["orderid"] =[];
        $_SESSION["cart"]=[];
        header("location:index.php");
    }
    
    ?>

    <div class="main_area">
        <section>

    <h2>Order Recieved</h2>
    <?php
    
   
    if(isset($_SESSION['UserId']) && isset($_SESSION['orderid']))
    {
        

        try
        {
            require_once '../src/UserConnect.php';
            
            $sql = "SELECT u.firstname, p.name, p.email, p.address, p.city, p.postcode
            FROM users u left join paymentdetails p 
            ON u.userid = p.userid
            WHERE u.userId = :userId";
            $userId = $_SESSION['UserId'];
            $statement = $connection->prepare($sql);
            $statement->bindParam(':userId', $userId, PDO::PARAM_INT);
            $statement->execute();
            $userdetails = $statement->fetchAll();
            // var_dump($userdetails);
            //retrieve the customer name from the session variable
            foreach($userdetails as $row){
                    $firstname = $row['firstname'];
                    $customerName = $row['name'];
                    $emailAddress = $row['email'];
                    $address = $row['address'];
                    $city = $row['city'];
                    $postcode = $row['postcode'];
                }

            //get order details joins all the information from each table to make an invoice

            $sql = "SELECT co.total, co.status, pd.productid, pd.name, pd.product_quantity, pd.price
            FROM customer_order co left join (SELECT op.customer_order_id, p.productid, p.name, p.price, op.product_quantity
            FROM order_products op left join products p  
            ON op.product_id = p.productid           
            WHERE op.customer_order_id = :orderId) pd 
            ON co.orderid = pd.customer_order_id
            WHERE co.orderId = :orderId";


            $orderId = $_SESSION['orderid'];
            $statement = $connection->prepare($sql);
            $statement->bindParam(':orderId', $orderId, PDO::PARAM_INT);
            $statement->execute();
            $orderdetails = $statement->fetchAll(); 
        }
        catch(PDOException $error) 
        {
            echo $sql . "<br>" . $error->getMessage();
        } 
        $total = 0;   
           
        //Display the thank you message
        echo "<h1>Thank You, {$firstname}!</h1>";
        echo "<p>Your order has been received and will be delivered soon to.</p>";
        echo "<p>{$address}<br>{$city}<br>{$postcode}</p>";
        echo "<p>Contact email : {$emailAddress}</p><br><hl>";?>

        <table>
            <tr>
                <th>Product Name </th>
                <th>Quantity </th>
                <th>Price </th>
                <th>Total </th>                
            </tr>
    <?php
        foreach($orderdetails as $row)
        {
            $productid = $row['productid'];
            $name = $row['name'];
            $product_quantity = $row['product_quantity'];
            $price = $row['price'];
            $orderstatus = $row['status'];
            

            $item_total = $product_quantity * $price; 
            $total += $item_total;                         

            
            echo "<tr>";
            echo "<td> $name </td>";
            echo "<td> $product_quantity </td>";
            echo "<td> $price </td>";
            echo "<td> &euro;$item_total </td>";            
            echo "</tr>";    
        }               
    
        //Display total s and order status
        echo "<tr>";
        echo "<td xolspan='3'> Total:</td>";
        echo "<td>&euro;$total</td>";
        echo "<td xolspan='3'> Order Status:</td>";
        echo "<td> $orderstatus</td>";
        echo "</tr><br><br>";   
    }
    ?> 
    </table>
    <form action="thanks.php" method="post">
        <input name ="Submit" type="submit" value="OK" class="button"/>
    </form>
</ul>
</section>

<?php require_once "../templates/footer.php";?>