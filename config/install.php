
<?php include "../templates/header.php";?>

<?php 
require "config.php";

$connection = new PDO("mysql:host=$host", $username, $password, $options);

try { 
        $sql = file_get_contents("../data/init.sql");
        $connection->exec($sql);
        // Prepare an insert statement
        $sql = "INSERT INTO users (firstname, lastname, email, age, location, Username, Password, isAdmin) VALUES ('Administrator', 'Admin', 'ArkAdmin@ArkSoftware.ie', '1', 'Dublin', :Username, :Password, :IsAdmin)";
         
        if($stmt = $connection->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":Username", $param_username, PDO::PARAM_STR);
            $stmt->bindParam(":Password", $param_password, PDO::PARAM_STR);
            $stmt->bindParam(":IsAdmin", $param_isadmin, PDO::PARAM_INT);
            
            // Set parameters
            $param_username = 'admin';
            $param_password = password_hash('admin', PASSWORD_DEFAULT); // Creates a password hash
            $param_isadmin = 1;

            // Attempt to execute the prepared statement
            if($stmt->execute()){
                //Redirect to login page
                header("location: ..\public\login.php");
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            unset($stmt);
        }
        echo "Database and table users created successfully.";

    } 
    catch(PDOException $error) 
    {
        echo $sql . "<br>" . $error->getMessage();
    } 

?>

<?php include "../templates/footer.php";?>
