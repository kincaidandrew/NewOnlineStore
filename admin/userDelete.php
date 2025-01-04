<?php session_start()?>
<?php
    global $success; //this variable was made global to be able to use further down in code
    /**
     * Delete a user
     */
    require "../functions/functions.php";
    
    if (isset($_GET["userid"])) 
    {
        try {
            require_once '../src/UserConnect.php'; 
            $userid = $_GET["userid"];
            $sql = "DELETE FROM users WHERE userid = :userid";
            $statement = $connection->prepare($sql);
            $statement->bindValue(':userid', $userid);
            $statement->execute();
            $success = "User ". $suerid. " successfully deleted";
        } catch(PDOException $error) {
            echo $sql . "<br>" . $error->getMessage();
        } 
    } 
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
    <?php include "../templates/adminHeader.php";?>
    <h2>Delete users</h2>
    <?php if ($success) echo $success; ?>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email Address</th>
                <th>Age</th>
                <th>Location</th>
                <th>Date</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($result as $row) : ?>
            <tr>
                <td><?php echo test_input($row["userid"]); ?></td>
                <td><?php echo test_input($row["firstname"]); ?></td>
                <td><?php echo test_input($row["lastname"]); ?></td>
                <td><?php echo test_input($row["email"]); ?></td>
                <td><?php echo test_input($row["age"]); ?></td>
                <td><?php echo test_input($row["location"]); ?></td>
                <td><?php echo test_input($row["date"]); ?> </td>
                <td><a href="userDelete.php?userid=<?php echo test_input($row["userid"]); 
                ?>">Delete</a></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    <a href="userAdmin.php">Back to Admin|home</a>
    <?php require "../templates/footer.php"; ?>