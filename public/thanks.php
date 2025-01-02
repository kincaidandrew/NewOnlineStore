
    <?php 
    //Start the session
    session_start();

    include '../templates/header.php';

    

    //retrieve the customer name from the session variable
    if (isset($_SESSION['firstname'])) {
        $user = $_SESSION['firstname'];
        $customerName = $user['firstname'];
    } else {
        $customerName = "Valued Customer";
    }

    //Display the thank you message
    echo "<h1>Thank You, $customerName!</h1>";
    echo "<p>Your order has been received and will be delivered soon.</p>";
    ?>


<?php require_once "../templates/footer.php";?>