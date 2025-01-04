
<?php
require_once '../functions/functions.php';
/**
 * List all users with a link to edit
 */
    try {        
        require_once '../src/UserConnect.php';
        $sql = "SELECT * FROM users";
        $statement = $connection->prepare($sql);
        $statement->execute();
        $result = $statement->fetchAll();
    } catch(PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    } 
?>

 <       
        <?php foreach ($result as $row) : ?>
            <tr>
                <td><?php echo test_input($row["userid"]); ?></td>
                <td><?php echo test_input($row["firstname"]); ?></td>
                <td><?php echo test_input($row["lastname"]); ?></td>
                <td><?php echo test_input($row["email"]); ?></td>
                <td><?php echo test_input($row["age"]); ?></td>
                <td><?php echo test_input($row["location"]); ?></td>               
                <td><?php echo test_input($row["username"]); ?></td>
                <td><?php echo test_input($row["isAdmin"]); ?></td>            
                <td><?php echo test_input($row["date"]); ?> </td>
                <td><a href="update-single.php?Id=<?php echo test_input($row["userid"]);?>">Edit</a></td>
            </tr>
        <?php endforeach; ?>
        
    
        <a href="userAdmin.php">Back to admin|home</a>