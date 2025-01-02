<?php 
session_start();
?>


<?php include '../templates/header.php';
require_once ('../functions/functions.php');

// if(isset($_POST['Add_Pay_Details'])){
//     try {
//         require_once '../src/UserConnect.php';
//         // insert new user code will go here        
//         $new_payDetails = array(               
//             "userId" => ($_SESSION['Id']),   
//             "name" => test_input($_POST['name']),
//             "email" => test_input($_POST['email']),
//             "address" => test_input($_POST['address']),
//             "city" => test_input($_POST['city']),
//             "state" => test_input($_POST['state']),        
//             "postcode" => test_input($_POST['postcode']),        
//             "nameOnCard" => test_input($_POST['nameOnCard']),        
//             "cardNumber" => test_input($_POST['cardNumber']),        
//             "expMonth" => test_input($_POST['expMonth']),
//             "expYear" => test_input($_POST['expYear']),
//             "cvv" => test_input($_POST['cvv'])
//         );

//         $sql = sprintf( 
//             "INSERT INTO %s (%s) values (%s)", 
//             "paymentDetails", 
//             implode(", ",
//         array_keys($new_payDetails)), ":" . implode(", :", array_keys($new_payDetails)) );

//         $statement = $connection->prepare($sql);
//         $statement->execute($new_payDetails);
//     } catch(PDOException $error)
//     {
//         echo $sql . "<br>" .$error->getMessage();
//     } 
// }

if(isset($_POST['Update_User_Details'])){
    try {
        require_once '../src/UserConnect.php';
        // insert new user code will go here        
        $updated_userDetails = array(    
            "firstname" => test_input($_POST['firstname']),
            "lastname" => test_input($_POST['lastname']),
            "email" => test_input($_POST['email']),
            "age" => test_input($_POST['age']),
            "location" => test_input($_POST['location'])
            // "username" => test_input($_POST['username']),        
            // "password" => test_input($_POST['password'])
        );

        //var_dump($user_payDetails); 
        $user_ID = $_SESSION['Id'];

        $set_values = '';
        foreach ($updated_userDetails as $key => $value)            
            {
                if ( $key != 'location')
                {
                    $set_values = $set_values . "{$key} = :{$key},";
                }
                else{
                    $set_values = $set_values . "{$key} = :{$key} ";
                }
                

            }
        
           
    
     $sql = sprintf( 
        "UPDATE %s set %s where id = %s", 
        "users", 
        $set_values,
        $user_ID
    );

    //    var_dump($sql); 
    //    die;   

    $statement = $connection->prepare($sql);
    $statement->execute($updated_userDetails);
    } catch(PDOException $error)
    {
        echo $sql . "<br>" .$error->getMessage();
    } 
}


if (isset($_SESSION['Id'])) {
    try {
        require_once '../src/UserConnect.php';
        $id = $_SESSION['Id'];
        $sql = "SELECT * FROM users WHERE id = :id";
        $statement = $connection->prepare($sql);
        $statement->bindValue(':id', $id);
        $statement->execute();
        $user_Details = $statement->fetch(PDO::FETCH_ASSOC);
        // var_dump($user_Details);
        // $_SESSION['payDetailsID'] = $user_payDetails['payDetailsID'];
    } catch(PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    } 
} else {
    echo "Something went wrong!";

    exit;
} 



?>
<div class="main_area"> <section>

<!-- <div class="main_area"> -->
    <div class="container">  
            
            <form action="userDetails.php" method="post" class="form-horizontal">
                <h2>User Details</h2>
                
                <div class ="form-group">
                    <label for="name" class="control-label col-sm-2">Firstname:</label>
                    <div class="col-sm-8">
                        <input name="firstname" type="text" id="firstname"  class="form-control" value = "<?php echo (($user_Details) ? test_input($user_Details["firstname"]) : ''); ?>">
                    </div>
                </div> 
                <div class ="form-group">
                    <label for="name" class="control-label col-sm-2">Surname:</label>
                    <div class="col-sm-8">
                        <input name="lastname" type="text" id="lastname"  class="form-control" value = "<?php echo (($user_Details) ? test_input($user_Details["lastname"]) : ''); ?>">
                    </div>
                </div>                 
                <div class ="form-group">
                    <label for="email" class="control-label col-sm-2">Email:</label>
                    <div class="col-sm-8">
                        <input name="email" type="email" id="email" class="form-control" value = "<?php echo (($user_Details) ? test_input($user_Details["email"]) :''); ?>" required>                
                    </div>
                </div>
                <div class ="form-group">
                    <label for="age" class="control-label col-sm-2">Age:</label>
                    <div class="col-sm-4">
                        <input name="age"  type="text" id="age"  class="form-control" value = "<?php echo (($user_Details) ? test_input($user_Details["age"]):''); ?>" required>
                    </div>
                </div>
                <div class ="form-group">
                    <label for="location" class="control-label col-sm-2">Location:</label>
                    <div class="col-sm-10">
                        <input name="location" type="textarea" id="loaction" class="form-control" value = "<?php echo (($user_Details) ? test_input($user_Details["location"]):''); ?>" equired>
                    </div>
                </div>
                
                <div class ="form-group">
                    <label for="username" class="control-label col-sm-2">Username:</label>
                    <div class="col-sm-4">
                        <input name="username" type="text" id="username"  class="form-control" value = "<?php echo (($user_Details) ? test_input($user_Details["username"]):''); ?>" disabled>
                    </div>
                </div>
                <!-- <div class ="form-group">
                    <label for="password" class="control-label col-sm-2">Password:</label>
                    <div class="col-sm-4">
                        <input name="password" type="password" id="password"  class="form-control" value = "<?php echo (($user_Details) ? test_input($user_pDetails["password"]):''); ?>" required>
                    </div>
                </div> -->
            
            
                <?php echo (($user_Details) ? '<button name="Update_User_Details" value="Update_User_Details" class="button" type="submit">Update</button>'
                                                : 
                                                '<button name="Add_Pay_Details" value="Add_Pay_Details" class="button" type="submit">Add Pay Details</button>' );?> 
                
                <button name="Reset" value="Reset" class="button" type="reset">Reset</button>
                
            </form>
        
        </div>
    </section>
    </div>
    


    <?php require_once "../templates/footer.php";?>