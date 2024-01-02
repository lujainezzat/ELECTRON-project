<?php
  session_start(); 

if (!isset($_SESSION['logged_in'])) {
  header('location: login.php');
  exit();
}

  if (isset($_POST["add_to_cart"]))
  {
    if(isset($_SESSION['cart'])) //user added products before 
    {
      $products_array_ids = array_column($_SESSION['cart'],"product_id");
      if (!in_array($_POST['product_id'], $products_array_ids)) //array id column
      {
        $product_id = $_POST['product_id'];
        $product_array = array(
          'product_id' => $_POST['product_id'],
          'product_name' => $_POST['product_name'],
          'product_price' => $_POST['product_price'],
          'product_image' => $_POST['product_image'],
          'product_quantity' => $_POST['product_quantity']
        );
        $_SESSION['cart'][$product_id] = $product_array ;
      }
      else 
      { 
        echo '<script> alert("This product has been already added"); </script>';
      }
    }
    // this is the first product
    else{
      $product_id = $_POST['product_id'];
      $product_array = array(
        'product_id' => $_POST['product_id'],
        'product_name' => $_POST['product_name'],
        'product_price' => $_POST['product_price'],
        'product_image' => $_POST['product_image'],
        'product_quantity' => $_POST['product_quantity']
      );
      $_SESSION['cart'][$product_id] = $product_array ;
    }

    calaculateTotalCart();
  }
elseif(isset($_POST['remove_product'])){
  $product_id = $_POST['product_id'];
  unset($_SESSION['cart'][$product_id ]);   
  calaculateTotalCart();
}

elseif (isset($_POST['edit_quantity'])){
  $product_id = $_POST['product_id'];
  $product_quantity = $_POST['product_quantity'];
  $product_array = $_SESSION['cart'][$product_id];
  $product_array['product_quantity'] = $product_quantity;
  $_SESSION['cart'][$product_id] = $product_array ;
  calaculateTotalCart();
}

  function calaculateTotalCart(){
    
    $total = 0;
    
    foreach ($_SESSION['cart'] as $key => $value)
    {
      $product = $_SESSION['cart'][$key] ;

      $price = $product['product_price'];
      $quantity = $product['product_quantity'];

      $total += $price * $quantity;
    }
    $_SESSION['total'] = $total;
  }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>cart</title>
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

      <!--cart-->
      <section class="cart container my-5 py-5">
        <div class="container mt-5">
            <h2 class="font-weight-bold">Your Cart</h2>
            <hr>
        </div>
        <table class="mt-5 pt-5">
            <tr>
                <th>Product</th>
                <th>Quantity</th>
                <th>Subtotal</th>
            </tr>

            <?php foreach($_SESSION['cart'] as $key => $value){ ?>

            <tr>
                <td>
                    <div class="product-info">
                        <img src="assets/imgs/<?php echo $value['product_image'];?>">
                        <div>
                            <p><?php echo $value['product_name']; ?></p>
                            <small><span>EGP</span> <?php echo $value['product_price']; ?></small>
                            <br>
                            <form method ="POST" action='cart.php'>
                              <input type="hidden" name="product_id" value="<?php echo $value['product_id']; ?>"/>
                              <input type="submit" name="remove_product" class = "remove-btn" value="remove">
                        </div>
                    </div>
                </td>
                <td>
                  <input type="hidden" value="<?php echo $value['product_id']; ?>" name="product_id">
                  <input type="number" value="<?php echo $value['product_quantity']; ?>" name="product_quantity">
                  <input type="submit" class="edit-btn" value="edit" name="edit_quantity">
                    
                    </form>
                </td>
                <td>
                    <span>EGP</span>
                    <span class="product-price"><?php echo $value['product_quantity'] * $value['product_price']; ?></span>
                </td>
            </tr>
            <?php } ?>
        </table>
        <div class="cart-total">
            <table>
                <tr>
                    <td>SubTotal</td>
                    <td><?php echo $_SESSION['total']; ?></td>
                </tr>
                <tr>
                    <td>Shipping fee</td>
                    <td>EGP 40</td>
                </tr>
                <tr>
                    <td>Total</td>
                    <td><?php echo $_SESSION['total'] + 40; ?></td>
                </tr>
            </table>
        </div>
        <div class="checkout-container">
          <form method="post" action="checkout.php">
            <input type="submit" class="btn checkout-btn" value = "Checkout" name="checkout">
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