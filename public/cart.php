
        <?php 
       
            session_start();  
        ?>



        <?php 
        
        include '../templates/header.php';
        require_once ('../functions/functions.php');        
        
        //if user 
        if(isset($_POST['Home'])){
            header("location: index.php");
        }
        else if(isset($_POST['Login'])){
            header("location: login.php");
        }
        else if(isset($_POST['Update_Pay_Details'])){
            header("location: paymentDetails.php");
        }
        else if(isset($_POST['Checkout'])){
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
            <div class="container">

            <form action="cart.php" method="post">
                <table class="table table-striped">
                    <thead>
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
                    </tbody>
               </table>
               <!-- <form action="checkout.php" method="post">
                    <input type="submit" value="Checkout" class="button"/>
                </form> -->
                
                    
                <?php 
                // if(isset($_GET))
                    {
                        $_SESSION['payDetailsOK'] = false;
                        if (isset($_SESSION['UserId'])) 
                        {
                            $userid = $_SESSION['UserId'];
                            try {
                                require_once '../src/UserConnect.php';
                                // $userid = $_SESSION['UserId'];
                                $sql = "SELECT * FROM paymentDetails WHERE userId = :userid";
                                $statement = $connection->prepare($sql);
                                $statement->bindValue(':userid', $userid);
                                $statement->execute();
                                $user_payDetails = $statement->fetch(PDO::FETCH_ASSOC);
                                if($user_payDetails)
                                {
                                    //if userPayDetails are completed
                                    $_SESSION['payDetailsOK'] = true;
                                }
                                else
                                {
                                    //if userPayDetails are notcompleted
                                    $_SESSION['payDetailsOK'] = false;
                                }
                                // $_SESSION['payDetailsID'] = $user_payDetails['payDetailsID'];
                            
                            } catch(PDOException $error) {
                                echo $sql . "<br>" . $error->getMessage();
                            } 
                        }   
                    } 

                    if ($_SESSION['cart'])
                    {
                        if ((!$_SESSION) ||($_SESSION['UserId'] == -1))
                        {
                            echo '<button name="Login" value="Login" class="button" type="submit">Login</button>';
                            echo '<br><br><h5> User must be registered and logged in to process a payment. </h5>';
                        }
                        else if (!$_SESSION['payDetailsOK'])
                        {
                            echo '<button name="Update_Pay_Details" value="Update_Pay_Details" class="button" type="submit">Update Payment Details</button>' ;
                            echo '<br><br><h5> User needs to update billing details before processing any orders. </h5>';
                        }
                        else if ($_SESSION['payDetailsOK'])
                        {
                            echo '<button name="Checkout" value="Checkout" class="button" type="submit">Checkout</button>';
                        }
                    }
                    else
                    {
                        echo '<button name="Home" value="Home" class="button" type="submit">Back to Shop</button>';
                    }                    
                        
                    ?>
                </form>
            </div>
            </section>
        </div>
        <?php require_once "../templates/footer.php";?>