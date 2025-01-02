<?php session_start();?>


<?php include '../templates/header.php';
require_once ('../functions/functions.php');

if(isset($_POST['Submit'])){
    try {
        require_once '../src/UserConnect.php';
        // insert new user code will go here        
        $new_payDetails = array(   
            "userId" => ($_SESSION['Id']),   
            "name" => test_input($_POST['name']),
            "email" => test_input($_POST['email']),
            "address" => test_input($_POST['address']),
            "city" => test_input($_POST['city']),
            "state" => test_input($_POST['state']),        
            "postcode" => test_input($_POST['postcode']),        
            "nameOnCard" => test_input($_POST['nameOnCard']),        
            "cardNumber" => test_input($_POST['cardNumber']),        
            "expMonth" => test_input($_POST['expMonth']),
            "expYear" => test_input($_POST['expYear']),
            "cvv" => test_input($_POST['cvv'])
        );

        $sql = sprintf( 
            "INSERT INTO %s (%s) values (%s)", 
            "paymentDetails", 
            implode(", ",
        array_keys($new_payDetails)), ":" . implode(", :", array_keys($new_payDetails)) );

        $statement = $connection->prepare($sql);
        $statement->execute($new_payDetails);
    } catch(PDOException $error)
    {
        echo $sql . "<br>" .$error->getMessage();
    } 
}

?>
<div class="main_area"> <section>

<!-- <div class="main_area"> -->
    <div class="container">       
       
        
            <h1>Checkout</h1>
            <form action="checkout.php" method="post" class="form-horizontal">
                <h2>Billing Information</h2>
                
                <div class ="form-group">
                    <label for="name" class="control-label col-sm-2">Name:</label>
                    <div class="col-sm-8">
                        <input name="name" type="text" id="name"  class="form-control">
                    </div>
                </div>                
                <div class ="form-group">
                    <label for="email" class="control-label col-sm-2">Email:</label>
                    <div class="col-sm-8">
                        <input name="email" type="email" id="email" class="form-control" required default="kincaidandrew2000@outlook.com">                
                    </div>
                </div>
                <div class ="form-group">
                    <label for="address" class="control-label col-sm-2">Address:</label>
                    <div class="col-sm-10">
                        <input name="address" type="textarea" id="address" class="form-control" required>
                    </div>
                </div>
                <div class ="form-group">
                    <label for="city" class="control-label col-sm-2">City:</label>
                    <div class="col-sm-4">
                        <input name="city"  type="text" id="city"  class="form-control" required>
                    </div>
                </div>
                <div class ="form-group">
                    <label for="state" class="control-label col-sm-2">State:</label>
                    <div class="col-sm-4">
                        <input name="state" type="text" id="state"  class="form-control" required>
                    </div>
                </div>
                <div class ="form-group">
                    <label for="postcode" class="control-label col-sm-2">Postal Code:</label>
                    <div class="col-sm-4">
                        <input name="postcode" type="text" id="postcode"  class="form-control" required>
                    </div>
                </div>
            
            </form>
            
            <form action="checkout.php" method="post" class="form-horizontal">   
                <h2>Payment Information</h2>

                
                <div class ="form-group">
                        <label for="nameOnCard" class="control-label col-sm-2">Name on Card:</label>
                        <div class="col-sm-4">
                            <input type="text" id="nameOnCard" name="nameOnCard" class="form-control" required > 
                        </div>                      
                    </div>
                    <div class ="form-group">
                        <label for="cardNumber" class="control-label col-sm-2">Card Number:</label>
                        <div class="col-sm-4">
                            <input type="text" id="cardNumber" name="cardNumber" class="form-control" required  pattern="\d{4}-?\d{4}-?\d{4}-?\d{4}" required ">
                         </div>
                    </div>
                    <div class ="form-group">
                        <label for="expMonth" class="control-label col-sm-2">Expiration Month:</label>
                        <div class="col-sm-4">
                            <input type="text" id="expMonth" name="expMonth" class="form-control" required > 
                        </div>
                    </div>
                    <div class ="form-group" >
                        <label for="expYear" class="control-label col-sm-2">Expiration Year:</label>
                        <div class="col-sm-4">
                            <input type="text" id="expYear" name="expYear" class="form-control" required >
                        </div>
                    </div>
                    <div class ="form-group" >
                        <label for="cvv" class="control-label col-sm-2">CVV:</label>
                        <div class="col-sm-4">
                            <input type="text" id="cvv"name="cvv" class="form-control" required >
                        </div>
                    </div>
                </div>
                <div class ="form-group">
                    <!-- <input type="submit" value="Place Order"> -->
                    <button name="Submit" value="Submit" class="button" type="submit">Submit</button>
                    <!-- <input type="submit" class="btn btn-primary" value="Submit"> -->
                    <button name="Reset" value="Reset" class="button" type="reset">Reset</button>
                    <!-- <input type="reset" class="btn btn-secondary ml-2" value="Reset"> -->
                </div>
            </form>
        
        </div>
    </section>
    </div>
    


    <?php require_once "../templates/footer.php";?>