<?php
  include("database/get_by_category.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>category</title>
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

      <section id="All-Products" class="my-5 py-5">
        <div class="container text-center mt-5 py-5">
            <h3><?php echo $category ?></h3>
            <hr>
            <p>Here you can see all the products</p>
        </div>
        </section>

        <div class="row mx-auto container-fluid">
          <?php include('database/get_products.php'); ?>
          <?php while ($row = $cat_product->fetch_assoc()){ ?>
            <div class="product text-center col-lg-3 col-md-4 col-sm-12">
              <img class="img-fluid mb-3" src="assets/imgs/<?php echo $row['product_image'];?>"/>
              <h5 class="p-name"><?php echo $row['product_name']?></h5>
              <h4 class="p-price"><?php echo $row['product_price']?> EGP</h4>
              <a href="<?php echo "product_info.php?product_id=".$row ['product_id']; ?>">
              <button class="buy-button">Buy Now</button>
              </a>
            </div>  
          <?php } ?>
        </div>




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