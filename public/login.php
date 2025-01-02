
<?php 
// session_start();
require_once('../templates/loginHeader.php');//different for log in page to avoid an infinite loop 

// Initialize the session


 
require_once ('../functions/functions.php');
require_once ('../config/config.php'); // This is where the username and password are currently stored (hardcoded in variables)
require_once '../src/UserConnect.php';

// Define variables and initialize with empty values
$username = $password = "";
$username_err = $password_err = $login_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // var_dump('Testing' ,$username, $password);
    // Check if username is empty
    if(empty(trim($_POST["Username"]))){
        $username_err = "Please enter username.";
    } else{
        $username = test_input($_POST["Username"]);
    }
    
    // Check if password is empty
    if(empty(trim($_POST["Password"]))){
        $password_err = "Please enter your password.";
    } else{
        $password = trim($_POST["Password"]);
    }

   
    
    // var_dump($username, $password, $username_err, $password_err);
    // Validate credentials   
    if(empty($username_err) && empty($password_err)){
        // Prepare a select statement
        $sql = "SELECT Id, Username, Firstname, Lastname, Password, IsAdmin FROM users WHERE Username = :Username";
        
        //$connection = new PDO($dsn, $username, $password, null);
        

        if($stmt = $connection->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":Username", $param_username, PDO::PARAM_STR);
            
            // Set parameters
            $param_username = trim($_POST["Username"]);
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Check if username exists, if yes then verify password
                if($stmt->rowCount() == 1){
                    if($row = $stmt->fetch()){
                        $id = $row["Id"];
                        $username = $row["Username"];
                        $hashed_password = $row["Password"];
                        $isadmin = $row["IsAdmin"];
                        if(password_verify($password, $hashed_password)){
                            // Password is correct, so start a new session
                            session_start();
                            
                            // Store data in session variables
                            $_SESSION["Active"] = true;
                            $_SESSION["Id"] = $id;
                            $_SESSION["Username"] = $username; 
                            $_SESSION["IsAdmin"] = $isadmin;
                            // $_SESSION["cart"] = [];
                            // Redirect user to welcome page
                            header("location: index.php");
                        } else{
                            // Password is not valid, display a generic error message
                            $login_err = "Invalid username or password.";
                        }
                       
                    }
                } else{
                    // Username doesn't exist, display a generic error message
                    $login_err = "Invalid username or password.";
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            unset($stmt);
        }
    }
    
    // Close connection
    unset($pdo);
}
?>

   <!-- <link rel="stylesheet" type="text/css" href="../css/stylesheet.css"> -->
   
    <!-- <title>Sign in</title>
</head> -->


<div class="main_area"> 
    <section>


           <div class="container">
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" name="Login_Form" class="form-horizontal">
                    <h2 class="form-styling-heading">Please sign in</h2>
                    <div class="form-group">
                        <label class="control-label col-sm-2">Username</label>
                        <div class="col-sm-8">
                            <input name="Username" type="username" id="inputUsername" class="form-input" value="<?php echo $username; ?>" placeholder="Username" required autofocus>                            
                        </div>
                    </div>         
                    <div class="form-group">
                        <label class="control-label col-sm-2">Password</label>
                        <div class="col-sm-8">
                            <input name="Password" type="password" id="inputPassword" class="form-input" value="<?php echo $password; ?>" placeholder="Password" required>
                        </div>
                    </div>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" value="remember-me"> Remember me
                        </label>
                    </div>
                        
                        <button name="Submit" value="Login" class="button" type="submit">Sign in</button>
                        <span class="invalid-feedback"><?php echo $login_err;  $_POST = array();?></span>
                        
                        <div class="form-column">
                            <p>Don't have an account? <a href="register.php">Sign up now</a>.</p>
                        </div>
                    </div> <!-- form-row  -->         
                
                </form>

                <?php
                
                // if(isset($_POST['Submit']))
                //     {

                //         /* Check if the form's username and password matches */
                //         /* these currently check against variable values stored in config.php but later we will see how these can be checked against information in a database*/
                //         if( ($_POST['Username'] == $Username) && ($_POST['Password'] == $Password) )
                //         {
                //             //echo 'Success';
                //             /* Success: Set session variables and redirect to protected page */
                //             $_SESSION['Username'] = $Username; //store Username to the session
                //             $_SESSION['Active'] = true; //remember we can call a session what we like e.g. $_SESSION["newsession"]=$value;
                //             header("location:index.php"); /* 'header() is used to redirect the browser */
                //             exit; //we’ve just used header() to redirect to another page but we must terminate all current code so that it doesn’t run when we redirect
                        

                //         }
                //         else
                //             echo 'Incorrect Username or Password';
                //     }
                ?>
                

            </div>
        </section>
    </div>
    


    <?php require_once "../templates/footer.php";?>
