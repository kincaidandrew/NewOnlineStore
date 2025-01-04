<?php
function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function checkPaymentDetails($userid)
{
    
    
}

function logOut()
{
    //Initialize the session
    session_start();

    //Unset all session variables
    $_SESSION = array();
    //Destroy the session
    session_destroy();

    header("location: index.php");
    exit;
}

?>