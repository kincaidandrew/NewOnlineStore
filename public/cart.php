
        <?php 
       
            session_start();
       
       
        ?>


        <?php include '../templates/header.php';?>
        
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
                    foreach ($_SESSION["cart"] as $product_id => $quantity) {
                        $sql = "SELECT * FROM products WHERE id = $product_id";
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
                            echo "<td> $item_total $</td>";
                            echo "</tr>";
                        }
                    }
                    //Display total
                    echo "<tr>";
                    echo "<td xolspan='3'> Total:</td>";
                    echo "<td>$total $</td>";
                    echo "</tr>";
                    ?>                    
                </table>
                <form action="thanks.php" method="post">
                    <input type="submit" value="Checkout" class="button"/>
                </form>
            </section>
        </div>
        <?php require_once "../templates/footer.php";?>