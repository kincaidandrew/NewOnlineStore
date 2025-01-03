
<?php 
// session_start();
require_once('../templates/header.php');//different for log in page to avoid an infinite loop 

require_once ('../functions/functions.php');
require_once ('../config/config.php'); // This is where the username and password are currently stored (hardcoded in variables)


// Define variables and initialize with empty values
$firstname = $lastname = $email = $age = $location = $username = $password = $confirm_password = "";
$firstname_err = $lastname_err = $email_err = $age_err = $location_err = $username_err = $password_err = $confirm_password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate username
    if(empty(trim($_POST["Firstname"]))){
        $firstname_err = "Please enter a firstname.";}
    else{
        $firstname = trim($_POST["Firstname"]);
    }
    if(empty(trim($_POST["Lastname"]))){
        $lastname_err = "Please enter a lastname.";}
        else{
            $lastname = trim($_POST["Lastname"]);
        }
    if(empty(trim($_POST["Email"]))){
        $email_err = "Please enter an email.";}
        else{
            $email = trim($_POST["Email"]);
        }
    if(empty(trim($_POST["Age"]))){
        $age_err = "Please enter an age.";}
        else{
            $age = trim($_POST["Age"]);
        }
    if(empty(trim($_POST["Location"]))){
        $location_err = "Please enter a location.";}
        else{
            $Location = trim($_POST["Location"]);
        }

    if(empty(trim($_POST["Username"]))){
        $username_err = "Please enter a username.";
    } elseif(!preg_match('/^[a-zA-Z0-9_]+$/', test_input($_POST["Username"]))){
        $username_err = "Username can only contain letters, numbers, and underscores.";
    } else{
        // Prepare a select statement
        $sql = "SELECT userid FROM users WHERE username = :Username";
        
        //$pdo = new PDO($dsn, $dbUsername, $dbPassword, $options);
        require_once '../src/DBConnect.php';

        if($stmt = $pdo->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":Username", $param_username, PDO::PARAM_STR);
            
            // Set parameters
            $param_username = test_input($_POST["Username"]);
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                if($stmt->rowCount() == 1){
                    $username_err = "This username is already taken.";
                } else{
                    $username = test_input($_POST["Username"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            unset($stmt);
        }
    }
    
    // Validate password
    if(empty(trim($_POST["Password"]))){
        $password_err = "Please enter a password.";     
    } elseif(strlen(trim($_POST["Password"])) < 6){
        $password_err = "Password must have atleast 6 characters.";
    } else{
        $password = trim($_POST["Password"]);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["Confirm_Password"]))){
        $confirm_password_err = "Please confirm password.";     
    } else{
        $confirm_password = trim($_POST["Confirm_Password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }
    
    // Check input errors before inserting in database
    if(empty($firstname_err) && empty($lastname_err) && empty($email_err) && empty($age_err) && empty($location_err) && empty($username_err) && empty($password_err) && empty($confirm_password_err)){
        
        // Prepare an insert statement
        $sql = "INSERT INTO users (firstname, lastname, email, age, location, Username, Password, IsAdmin) 
                VALUES (:Firstname, :Lastname, :Email, :Age, :Location, :Username, :Password, :IsAdmin)";
         
        if($stmt = $pdo->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":Firstname", $param_firstname, PDO::PARAM_STR);
            $stmt->bindParam(":Lastname", $param_lastname, PDO::PARAM_STR);
            $stmt->bindParam(":Email", $param_email, PDO::PARAM_STR);
            $stmt->bindParam(":Age", $param_age, PDO::PARAM_INT);
            $stmt->bindParam(":Location", $param_location, PDO::PARAM_STR);
            $stmt->bindParam(":Username", $param_username, PDO::PARAM_STR);
            $stmt->bindParam(":Password", $param_password, PDO::PARAM_STR);
            $stmt->bindParam(":IsAdmin", $param_isadmin, PDO::PARAM_INT);
            // Set parameters
            $param_firstname = $firstname;
            $param_lastname = $lastname;
            $param_email = $email;
            $param_age = $age;
            $param_location = $location;
            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            $param_isadmin = 0;
            // Attempt to execute the prepared statement
           //var_dump($stmt); die;
            if($stmt->execute()){
                // Redirect to login page
                header("location: index.php");
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
 
    
    <div class="main_area"> 
        <section>

<!-- <div class="main_area"> -->
        <div class="container">  
        
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" name="Login_Form" class="form-horizontal">
            <h2 class="form-signin-heading">Register</h2>
            <p>Please fill this form to create an account.</p>
            
                <div class="form-group">
                    <label class="control-label col-sm-2">First Name</label>
                    <div class="col-sm-8">
                        <input name="Firstname" type="text" id="inputFirstname" class="form-control" value="<?php echo $firstname; ?>">
                    </div>
                    </div>     
                <div class="form-group">
                    <label class="control-label col-sm-2">Surname</label>
                     <div class="col-sm-8">
                        <input name="Lastname" type="text" id="inputLastname" class="form-control" value="<?php echo $lastname; ?>">
                    </div>
                    </div>     
                <div class="form-group">
                    <label class="control-label col-sm-2">Email</label>
                    <div class="col-sm-8">
                        <input name="Email" type="email" id="inputEmail" class="form-control" value="<?php echo $email; ?>">
                    </div>
                    </div>     
                <div class="form-group">
                    <label class="control-label col-sm-2">Age</label>
                    <div class="col-sm-8">
                        <input name="Age" type="text" id="text" class="form-control" value="<?php echo $age; ?>">
                    </div>
                </div>     
                <div class="form-group">
                    <label class="control-label col-sm-2">Location</label>
                    <div class="col-sm-8">
                        <input name="Location" type="text" id="inputLocation" class="form-control" value="<?php echo $location; ?>">
                    </div>
                </div>     
                <div class="form-group">
                    <label  class="control-label col-sm-2" >Username</label>
                    <div class="col-sm-8">
                        <input name="Username" type="text" id="inputUsername" class="form-control" value="<?php echo $username; ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label  class="control-label col-sm-2" >Password</label>
                    <div class="col-sm-8">
                        <input name="Password" type="password" id="inputPassword" class="form-control" value="<?php echo $password; ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label  class="control-label col-sm-2">Confirm</label>
                    <div class="col-sm-8">
                        <input name="Confirm_Password" type="password" id="inputConfirmPassword" class="form-control" value="<?php echo $confirm_password; ?>">
                    </div>
                </div> 
            
                    <button name="Submit" value="Submit" class="button" type="submit">Submit</button>
                    <button name="Reset" value="Reset" class="button" type="reset">Reset</button>                
            
            <p>Already have an account? <a href="login.php">Login here</a>.</p>

        </form>
        </div>
    </section>
    </div> 
    
    

    <?php require_once "../templates/footer.php";?>
