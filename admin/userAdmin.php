<?php session_start()?>
<?php include "../templates/adminHeader.php";?>

  <div class="main_area">
    <section id="billboard" class="bg-light py-5">
      <div class="container">
        <div class="row justify-content-center">
          <h1 class="section-title text-center mt-4" data-aos="fade-up">ARK Online Administration</h1>
          <!-- <div class="col-md-6 text-center" data-aos="fade-up" data-aos-delay="300"> -->
          <h1>Status: You are logged in  <?php echo $_SESSION['Username'];?> </h1>
              <p class="lead">This is where we will put the logout button</p>
              <h2>Update users</h2>
              
              <table class="table table-striped">
                <thead>
                      <tr>
                          <th>#</th>
                          <th>First Name</th>
                          <th>Last Name</th>
                          <th>E-Mail</th>
                          <th>Age</th>
                          <th>Location</th>
                          <th>Username</th>
                          <th>IsAdmin</th>
                          <th>CreatedDate</th>
                          <th>Edit</th>
                      </tr>
                  </th>
                  
                  <h4><tbody>           
                    <?php require('userEdit.php') ?>
                  </tbody>

                </table></h4>
                        

              <a href="userAdmin.php">Back to admin|home</a>
          </div>
        
          
      </div>
    </section>
    </div>                  
         
    <?php include "../templates/footer.php";?>