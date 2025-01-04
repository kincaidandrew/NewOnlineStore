

    <?php  

     
      
      if(!isset($_SESSION['UserId']))
      {
       // header("Location: login.php");
       //session_start();
        $_SESSION["Active"] = false;
        $_SESSION["UserId"] = -1;
        $_SESSION["Username"] = 'Guest'; 
        $_SESSION["IsAdmin"] = 0;
        $_SESSION["cart"] = [];
        $_SESSION["orderTotal"]=0;
      }
      else
      {

      }
     
      
      ?>



<!DOCTYPE html>
<html lang="en">

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
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="../css/shop.css">
  <!-- shop.css is an important one for product display --> 
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
              <a class="nav-link" href="index.php">View Shop</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="cart.php">View Cart</a>
            </li>            
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Administration
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                
                <?php echo (($_SESSION && ($_SESSION['IsAdmin'] == 1 && $_SESSION['Username'] != '' && $_SESSION['UserId'] != -1)) 
                ? 
                  '<a class="dropdown-item" href="userAdmin.php">Users</a>                
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item" href="userAdd.php">Add New User</a>                
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item" href="userEdit.php">Edit User</a>                
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item" href="userDelete.php">Delete User</a>                
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item" href="../public/logout.php">Logout</a>' 
                  :                
                  '<a class="dropdown-item" href="../public/login.php">Log in</a>
                  <div class="dropdown-divider"></div>  
                  <a class="dropdown-item" href="../public/register.php">Register</a>
                  <div class="dropdown-divider"></div>'
                  );?>              
                </div>
           </li>
            <!-- <li class="nav-item">
              <a class="nav-link disabled" href="#">Disabled</a>
            </li> -->           
            <?php echo (($_SESSION && $_SESSION['Username'] != '' ) ? "Currently logged in as {$_SESSION['Username']}.": 'Please log in or register to purchase items' );?> 
          </ul>
          <!-- <form class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
          </form> -->
        </div>
      </nav>

      
  <main>

  

