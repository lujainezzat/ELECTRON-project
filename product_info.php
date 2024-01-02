<?php

include('database/connection.php');

if (isset($_GET["product_id"])){
$product_id = $_GET["product_id"];
$statement = $conn->prepare("SELECT * FROM products Where product_id = ? ");
$statement->bind_param("i", $product_id);
$statement->execute();
$product = $statement->get_result(); 
}

else {
  header('location: index.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!--fontawesome link-->
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/style.css"/>
</head>
<body>

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

      <section class="container product-info my-5 pt-5">
        <div class="row mt-5">
        <?php while ($row = $product->fetch_assoc()){ ?>
        <div class="col-lg-5 col-md-6 col-12">  
            <img class="img-fluid w=100 pb=1" src="assets/imgs/<?php echo $row['product_image'] ?>">
        </div>
        <div class = "col-lg-6 col-md-12 col-12">
            <h6> <span style = "font-size: 20px"> <?php echo $row['product_category']?></span> / <span style = "font-size: 30px"> <?php echo $row['product_name']?></span> </h3>
            <h2 class="mt-3 mb-4"> <?php echo $row['product_price'] ?> <span class = "smaller"> EGP </span> </h2>
            <form method="post" action="cart.php">
              <input type="hidden"  name = "product_id"    value = "<?php echo $row['product_id'] ?>">
              <input type="hidden"  name = "product_image" value = "<?php echo $row['product_image'] ?>">
              <input type="hidden"  name = "product_name"  value = "<?php echo $row['product_name'] ?>">
              <input type="hidden"  name = "product_price" value = "<?php echo $row['product_price'] ?>">
              <input type = "number" name="product_quantity" value = "1">
              <button type="submit" name = "add_to_cart" > Add To Cart </button>
            </form>
            <h4 class="mt-5 mb-2" > product details </h4>
            <span class = "desc"> <?php echo $row['product_description']?> </span>
        </div>

        <?php } ?>
        </div>
    </section>;


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