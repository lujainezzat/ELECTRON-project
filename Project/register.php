<?php
session_start();

include('database/connection.php');

if(isset($_POST['register'])){
  $name = $_POST['name'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $confirmPassword = $_POST['confirmPassword'];

  //if passwords dont match
  if($password !== $confirmPassword){
   header('location: register.php?error=passwords dont match');
  

    //password less than 6 charcters
  }
  else if(strlen($password)  < 6)
  {
      header('location: register.php?error=password must be atleast 6 characters');
  }


    // if there is no error
    else{
        //check whether there is a user with this email or not
        $stmt1 = $conn->prepare("SELECT count(*) FROM users WHERE user_email=?");
        $stmt1->bind_param('s',$email);
        $stmt1->execute();
        $stmt1->bind_result($num_rows);
        $stmt1->store_result();
        $stmt1->fetch();

       //if email is taken
        if($num_rows != 0){
          header('location:register.php?error= user with this email already exists');
        } else{

                //create a new user
                $stmt = $conn->prepare("INSERT INTO users ( user_name,user_email, user_password)
                VALUES (?, ?, ?)");

                $stmt->bind_param('sss', $name, $email, md5($password));
                //account created successfully
                if($stmt->execute()){
                  $user_id = $stmt ->insert_id;
                  $_SESSION['user_id'] = $user_id;
                  $_SESSION['user_email'] = $email;
                  $_SESSION['user_name'] = $name;
                  $_SESSION['logged_in'] = true;
                  header('location: index.php?register=You registered successfully');
                  //account could not be created
                }else{
                    header('location:register.php?error=could not create an account at the moment');
                    }
               }  
       }


}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!--fontawesome link-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/style.css"/>
</head>
<body>
    <!--navbar-->
    <nav class="navbar navbar-expand-lg navbar-light bg-white py-3 fixed-top">
        <div class="container">
            <!--loggo-->
          <h2 class="brand">ELECTRON</h2>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse nav-buttons" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link" href="index.php">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="all-products.php">Shop</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="cart.php">Cart</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="orders.php">Orders</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="contactUs.html">Contact</a>
              </li>
              <?php if (isset($_SESSION['logged_in'])) { ?>
              <li class="nav-item">
                <a class="nav-link" href="index.php?logout=1">Logout</a>
              </li>
              <?php } ?>
            </ul>
          </div>
        </div>
      </nav>

    <!--register-->
      <section class="my-5 py-5">
        <div class="container text-center mt-3 pt-5">
            <h2 class="form-weight-bold">Register</h2>
            <hr class="mx-auto">
        </div>
        <div class="mx-auto container">
            <form id="register-form" method="POST" action="register.php">
              <p style="color: red;"><?php if(isset($_GET['error'])){echo $_GET['error']; }?></p>
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" class="form-control" id="register-name" name="name" placeholder="name" required/>
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="text" class="form-control" id="register-email" name="email" placeholder="email" required/>
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" class="form-control" id="register-password" name="password" placeholder="password" required/>
                </div>
                <div class="form-group">
                    <label>Confirm Password</label>
                    <input type="password" class="form-control" id="register-confirm-password" name="confirmPassword" placeholder="confirmPassword" required/>
                </div>
                <div class="form-group">
                    <input type="submit" class="btn" id="register-btn" name="register" value="register"/>
                </div>
                <div class="form-group">
                    <a id="login-url" href="login.php" class="btn">Do you have an account? Login</a>
                </div>
            </form>
        </div>
      </section>

            <!--footer-->
            <footer class="mt-5 py-5">
                <div class="row container mx-auto pt-5">
                  <div class=" footer-one col-lg-6 col-md-12 col-sm-12">
                    <img class="logo" src="assets/imgs/logo"/> <!--logo image-->
                    <p class="pt-3">We provide the beest products for the most affordable prices</p>
                  </div>
                  <div class=" footer-one col-lg-6 col-md-12 col-sm-12">
                    <h5 class="pb-2">Contact US</h5>
                    <div>
                      <h6 class="text-uppercase">Address</h6>
                      <p>123 street name, city</p>
                    </div>
                    <div>
                      <h6 class="text-uppercase">Phone</h6>
                      <p>0106123455</p>
                    </div>
                    <div>
                      <h6 class="text-uppercase">Email</h6>
                      <p>info@gmail.com</p>
                    </div>
                  </div>
                </div>
                <div class="copyright mt-5">
                  <div class="row container mx-auto">
                    <div class="col-lg-3 col-md-6 col-sm-12 mb-4">
                      <a href="#"><i class="fa fa-facebook"></i></a>
                      <a href="#"><i class="fa fa-instagram"></i></a>
                      <a href="#"><i class="fa fa-twitter"></i></a>
                    </div>
                  </div>
                </div>
              </footer>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>   
</body>
</html>