<?php 
session_start();
// if($_SESSION['Active'] == false){ /* Redirects user to Login.php if not logged in. Remember, we set $_SESSION['Active'] == true in login.php*/
//     header("location:login.php");
//     exit;
// }
/*the code inside these php tags (i.e. the 5 lines of code above) are required for every page you wish to be accessible only after login*/
?>

<!DOCTYPE html>
<html>
<head>
<title>ARK Online</title>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="format-detection" content="telephone=no">
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="author" content="TemplatesJungle">
  <meta name="keywords" content="ecommerce,Christmas,store">
  <meta name="description" content="Bootstrap 5 Fashion Store HTML CSS Template">  
  <!-- <link rel="stylesheet" type="text/css" href="../css/vendor.css"> -->
  <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> -->
  <!-- <link rel="stylesheet" type="text/css" href="../css/form-styling.css"> -->
  <!-- <link rel = "stylesheet" href="../css/navbar-style.css"> -->
  <!-- <link rel = "stylesheet" href="../css/flex-Header.css"> -->
  <!-- <link rel = "stylesheet" href = "../css/navbar.css"> -->
  <!-- <link rel="stylesheet" type="text/css" href="../css/style.css"> -->
  <link rel="stylesheet" type="text/css" href="../css/shop.css">
  <!-- shop.css is an important one for product display -->
  <!-- <link rel="stylesheet" type="text/css" href="../css/stylesheet.css"> -->
  <!-- <link rel="stylesheet" type="text/css" href="../css/checkout.css"> -->
  
    </head>

    <body>
    
    <div class="container">
          
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
          <a class="navbar-brand" href="#">ARK Online RC Cars</a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
  
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
              <li class="nav-item active">
                <a class="nav-link" href="index.php">Shop</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="cart.php">Cart</a>
              </li></ul>
          <!-- <form class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
          </form> -->
        </div>
      </nav>

      
  <main>