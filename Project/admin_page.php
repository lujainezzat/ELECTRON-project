<?php

include ('database/connection.php');

if(isset($_POST['add_product'])){

   $product_name = $_POST['product_name'];
   $product_price = $_POST['product_price'];
   $product_image = $_FILES['product_image']['name'];
   $product_category = $_POST['product_category'];
   $product_description = $_POST['product_description'];
   $product_image_tmp_name = $_FILES['product_image']['tmp_name'];
   $product_image_folder = 'assets/imgs/'.$product_image;

   if(empty($product_name) || empty($product_price) || empty($product_image)){
      $message = 'please fill out all';
   }else{
      $insert = "INSERT INTO products(product_name , product_category , product_description , product_image , product_price) VALUES('$product_name', '$product_category', '$product_description' , '$product_image' , '$product_price')";
      if(mysqli_query($conn,$insert)){
         move_uploaded_file($product_image_tmp_name, $product_image_folder);
         $message = 'new product added successfully';
      }else{
         $message = 'could not add the product';
      }
   }

};

if(isset($_GET['delete'])){
   $id = $_GET['delete'];
   mysqli_query($conn, "DELETE FROM products WHERE product_id = $id");
   header('location:admin_page.php');
};

?>


<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>admin page</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

   <link rel="stylesheet" href="adminstyle.css">

</head>
<body>

<?php

if(isset($message)){
      echo "'<script> alert('.$message.'); </script>'";
   }

?>
   
<div class="container">

   <div class="admin-product-form-container">

      <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST" enctype="multipart/form-data">
         <h3>add a new product</h3>
         <input type="text"   placeholder="enter product name"    name="product_name"  class="box">
         <input type="number" placeholder="enter product price"   name="product_price" class="box">
         <input type="text"   placeholder="enter product category"name="product_category" class="box">
         <input type="text"   placeholder="enter product description"name="product_description" class="box">
         <input type="file"   accept="image/png, image/jpeg, image/jpg" name="product_image" class="box">
         <input type="submit" class="btn" name="add_product" value="add product">
      </form>

   </div>

   <?php

   $select = mysqli_query($conn, "SELECT * FROM products");
   
   ?>
   <div class="product-display">
      <table class="product-display-table">
         <thead>
         <tr>
            <th>product image</th>
            <th>product name</th>
            <th>product price</th>
            <th>product category</th>
            <th>product description</th>
            <th>action</th>
         </tr>
         </thead>
         <?php while($row = mysqli_fetch_assoc($select)){ ?>
         <tr>
            <td><img src="assets/imgs/<?php echo $row['product_image']; ?>" height="100" alt=""></td>
            <td><?php echo $row['product_name']; ?></td>
            <td><?php echo $row['product_price']; ?> EGP</td>
            <td><?php echo $row['product_category']; ?></td>
            <td><?php echo $row['product_description']; ?></td>
            <td>
               <a href="admin_update.php?edit=<?php echo $row['product_id']; ?>" class="btn"> <i class="fas fa-edit"></i> edit </a>
               <a href="admin_page.php?delete=<?php echo $row['product_id']; ?>" class="btn"> <i class="fas fa-trash"></i> delete </a>
            </td>
         </tr>
      <?php } ?>
      </table>
   </div>

</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>   

</body>
</html>