 
<?php 
      
      session_start();  
      
      //initailize Session to temp user until they log in!!
      // if (!session_status())
      // {
      //   session_start();
      //   $_SESSION["Active"] = false;
      //   $_SESSION["Id"] = -1;
      //   $_SESSION["Username"] = 'Temp'; 
      //   $_SESSION["IsAdmin"] = 0;
      //   $_SESSION["cart"] = [];
        
      // }
      //print_r($_SESSION);
      //$user = $_SESSION['username'];
      //echo $user['name'];   
       //Start the session
   //Check if the add to cart button is clicked
   
   if (isset($_POST["add_to_cart"])){
    
    //Initialize the cart session variable
    // if it does not exist//
    if (!isset($_SESSION["cart"])){
      $_SESSION["cart"] = [];
      header("location:index.php");
  }
    //Get the product id from the form
    $product_id = $_POST["product_id"];

    //Get the product quantity from the form
    $product_quantity = $_POST["product_quantity"];

    
    //Add the product and quantity to the cart

    if (!isset($_SESSION["cart"][$product_id]))
    {
      $_SESSION["cart"][$product_id] = $product_quantity;
    }
    else
    {
      $_SESSION["cart"][$product_id] += $product_quantity;
    }
    
    header("location:index.php");
    
    
  }    
  
//*the code inside these php tags (i.e. the 5 lines of code above) are required for every page you wish to be accessible only after login*/


?>


<?php include '../templates/header.php';?>
<div class="main_area">
  <section>

    <h2>Products</h2>
        <ul>
        <?php //Loop through items in cart and display in table
              require_once '../src/DBConnect.php';             
                $sql = "SELECT * FROM products";
                $result = $pdo->query($sql);   
                $prodCount = 0;
                // if($result->rowCount() > 0) {
                //     $row = $result ->fetch();
                
                    foreach($result as $row){
                      //$prodCount++;
                      $id = $row['id'];
                      $name = $row['name'];
                      $price = $row['price'];
                      $description = $row['description'];
                      $image = $row['imageRef'];
                      $image = '<img src= "../images/' . $image . '" alt ="' . $image . '">';
                      $pQuad_id = "product{$id}_quantity";
                      
                                        
                      $form =  "<form method=\"post\" action=\"index.php\">
                                  <input type=\"hidden\" name=\"product_id\" value=\"{$id}\">
                                  <label for=\"{$pQuad_id}\">Quantity:</label>
                                  <input type=\"number\" id=\"{$pQuad_id}\" name=\"product_quantity\" value=\"\" min=\"0\" max=\"10\">
                                  <button type=\"submit\" name= \"add_to_cart\">Add to Cart</button>
                                </form>";
                      // 
                      //echo($form.str);
                      
                      echo "<li> 
                              <h3>{$name}</h3>
                              {$image} 
                              <p>{$description}</p>
                              <p><span>&euro;{$price}</span></p><br> 
                            {$form}
                          </li>";
                          
                                        
                    }                    
                
            ?>
            
          </ul>
      </section>
    </table>
      <form action="checkout.php" method="post">
          <input type="submit" value="Checkout" class="button"/>
      </form>
  </section>         
</div>

    
    
    <?php require_once "../templates/footer.php";?>
    
    