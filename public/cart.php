
        <?php 
       
            session_start();
       
       
        ?>


        <?php 
        
        include '../templates/header.php';
        require_once ('../functions/functions.php');


        if(isset($_POST['Checkout'])){
            try {
                require_once '../src/UserConnect.php';
                $newOrderId = [];

                $sql =  sprintf(
                    "INSERT INTO %s (customerid,total, status) values (%s,%f, '%s')",
                    "customer_order",
                    $_SESSION["UserId"],
                    $_SESSION["orderTotal"],
                    'Order Received'
                );
                

                $statement = $connection->prepare($sql);
                $statement->execute();
                //gets the new order Id so now we can save the items and link to the order
                $newOrderId =$connection->lastInsertId();
                
            //   var_dump($_SESSION["cart"]);
            //  // die;
               //Loop through items in cart and display in table
               foreach ($_SESSION["cart"] as $productid => $quantity) {
                    
                        $sql =  sprintf(
                        "INSERT INTO %s (customer_order_id, product_id,product_quantity) values (%s,%s, '%s')",
                        "order_products",
                        $newOrderId,
                        $productid,
                        $quantity);
                    

                    $statement = $connection->prepare($sql);
                    $statement->execute();
                }

                //once order is processed clear cart[]
                //and dircet to the thanks page
                $_SESSION["cart"] = [];
                $_SESSION["orderid"] = $newOrderId;

                header("Location: thanks.php");


            }catch(PDOException $error)
            {
                echo $sql . "<br>" .$error->getMessage();
            } 
        }        
        ?>
        
        <div class="main_area">
            <section>
                <table>
                    <tr>
                        <th>Product Name </th>
                        <th>Quantity </th>
                        <th>Price </th>
                        <th>Total </th>
                    </tr>

                    <?php
                    require_once('../src/UserConnect.php');
                    
                    $total = 0;
                   
                   //Loop through items in cart and display in table
                    foreach ($_SESSION["cart"] as $productid => $quantity) {
                        $sql = "SELECT * FROM products WHERE productid = $productid";
                        $result = $connection->query($sql);                        

                        if($result->rowCount() > 0) {
                            $row = $result ->fetch();
                            $name = $row['name'];
                            $price = $row['price'];
                            
                            $item_total = $quantity * $price;
                            $total += $item_total;

                            echo "<tr>";
                            echo "<td> $name </td>";
                            echo "<td> $quantity </td>";
                            echo "<td> $price </td>";
                            echo "<td> &euro;$item_total </td>";
                            echo "</tr>";
                        }
                    }
                    //Display total
                    echo "<tr>";
                    echo "<td xolspan='3'> Total:</td>";
                    echo "<td>&euro;$total</td>";
                    echo "</tr>";

                    $_SESSION["orderTotal"] = $total;
                    
                    

                    ?>                    
                </table>
                <form action="cart.php" method="post">
                    <input name ="Checkout" type="submit" value="Checkout" class="button"/>
                </form>
            </section>
        </div>
        <?php require_once "../templates/footer.php";?>