<?php

include '../component/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
    header('location:admin_login.php');
    exit; // Add an exit statement to stop further execution
}

if (isset($_POST['add_product'])) {
    $name = $_POST['name'];
    $name = filter_var($name, FILTER_SANITIZE_STRING);
    $price = $_POST['price'];
    $price = filter_var($price, FILTER_SANITIZE_STRING);
    $sale_percentage = $_POST['sale_percentage'];
    $sale_percentage = filter_var($sale_percentage, FILTER_SANITIZE_STRING);
    $brand = $_POST['brand'];
    $brand = filter_var($brand, FILTER_SANITIZE_STRING);
    $category = $_POST['category'];
    $category = filter_var($category, FILTER_SANITIZE_STRING);
    $gender = $_POST['gender'];
    $gender = filter_var($gender, FILTER_SANITIZE_STRING);
    $season = $_POST['season'];
    $season = filter_var($season, FILTER_SANITIZE_STRING);
    $product_detail = $_POST['product_detail'];
    $product_detail = filter_var($product_detail, FILTER_SANITIZE_STRING);

    // Check if a file was uploaded
    if (isset($_FILES['image'])) {
      $image_files = $_FILES['image'];
      $message = array(); // Array to store messages for each file
  
      // Check if at least one image is uploaded
      if (!empty($image_files['tmp_name'][0])) {
          // Upload the main image to the products table
          $image_name = $image_files['name'][0];
          $image_size = $image_files['size'][0];
          $image_tmp_name = $image_files['tmp_name'][0];
          $image_folder = '../uploaded_img/' . $image_name;
  
          // Move the uploaded file to the destination folder
          if (move_uploaded_file($image_tmp_name, $image_folder)) {
              // Insert product information into the database
              $insert_product = $conn->prepare("INSERT INTO `products` (name, brand, category, gender, season, product_detail, price, sale_percentage, image) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
              $insert_product->execute([$name, $brand, $category, $gender, $season, $product_detail, $price, $sale_percentage, $image_name]);
              $product_id = $conn->lastInsertId(); // Get the ID of the inserted product
  
              $message[] = "Main image uploaded successfully!";
          } else {
              $message[] = "Failed to upload main image.";
          }
      } else {
          $message[] = "Main image was not uploaded.";
      }
  
      // Upload additional images to the product_images table
      for ($i = 1; $i < min(count($image_files['tmp_name']), 4); $i++) {
          $image_name = $image_files['name'][$i];
          $image_size = $image_files['size'][$i];
          $image_tmp_name = $image_files['tmp_name'][$i];
          $image_folder = '../uploaded_img/' . $image_name;
  
          // Move the uploaded file to the destination folder
          if (move_uploaded_file($image_tmp_name, $image_folder)) {
              // Insert image information into the product_images table
              $insert_image = $conn->prepare("INSERT INTO `product_images` (product_id, image_name) VALUES (?, ?)");
              $insert_image->execute([$product_id, $image_name]);
              $message[] = "Additional image uploaded successfully!";
          } else {
              $message[] = "Failed to upload additional image.";
          }
      }
  
      // Output messages for each file
      foreach ($message as $msg) {
          echo $msg . "<br>";
      }
  } else {
      echo "No files were uploaded or an error occurred.";
  }
}
  


if(isset($_GET['delete'])){

   $delete_id = $_GET['delete'];
   $delete_product_image = $conn->prepare("SELECT * FROM `products` WHERE id = ?");
   $delete_product_image->execute([$delete_id]);
   $fetch_delete_image = $delete_product_image->fetch(PDO::FETCH_ASSOC);
   unlink('../uploaded_img/'.$fetch_delete_image['image']);
   $delete_product = $conn->prepare("DELETE FROM `products` WHERE id = ?");
   $delete_product->execute([$delete_id]);
   $delete_cart = $conn->prepare("DELETE FROM `cart` WHERE pid = ?");
   $delete_cart->execute([$delete_id]);
   header('location:products.php');

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>products</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../css/admin_style.css">

</head>
<body>

<?php include '../component/admin_header.php' ?>

<!-- add products section starts  -->

<section class="add-products">

   <form action="" method="POST" enctype="multipart/form-data">
      <h3>add product</h3>
      <input type="text" required placeholder="enter product name" name="name" maxlength="100" class="box">
      <input type="number" min="0" max="9999999999" required placeholder="enter product price" name="price" onkeypress="if(this.value.length == 10) return false;" class="box">
      <input type="number" required placeholder="enter sale percenatage" name="sale_percentage"  class="box">

      <select name="brand" class="box" required>
         <option value="" disabled selected>select brand --</option>
         <option value="Modern Thread">Modern Thread</option>
      </select>

      <select name="category" class="box" required>
         <option value="" disabled selected>select category --</option>
         <option value="T-Shirt">T-Shirt</option>
         <option value="Shirt">Shirt</option>
         <option value="Jeans & Pants">Jeans & Pants</option>
         <option value="Hoodie">Hoodie</option>
         <option value="Sweatshirt">Sweatshirt</option>
         <option value="Casual Jackets">Casual Jackets</option>
         <option value="Suits & Blazers">Suits & Blazers</option>
      </select>

      <select name="gender" class="box" required>
         <option value="" disabled selected>select gender --</option>
         <option value="Men">Men</option>
         <option value="Women">Women</option>
      </select>

      <select name="season" class="box" required>
         <option value="" disabled selected>select season --</option>
         <option value="Summer">Summer</option>
         <option value="Winter">Winter</option>
      </select>

      <textarea id="textarea" name="product_detail" rows="5" cols="55" placeholder="enter product details" class="box"></textarea>

      <input type="file" name="image[]" multiple class="box" accept="image/jpg, image/jpeg, image/png, image/webp" required>
      <input type="submit" value="add product" name="add_product" class="btn">
   </form>

</section>

<!-- add products section ends -->

<!-- show products section starts  -->

<section class="show-products" style="padding-top: 0;">

   <div class="box-container">

   <?php
      $show_products = $conn->prepare("SELECT * FROM `products`");
      $show_products->execute();
      if($show_products->rowCount() > 0){
         while($fetch_products = $show_products->fetch(PDO::FETCH_ASSOC)){  
   ?>
   <div class="box">
      <img src="../uploaded_img/<?= $fetch_products['image']; ?>" alt="">
      <div class="flex">
         <div class="price"><span>Rs.</span><?= $fetch_products['price']; ?><span>/-</span></div>
         <div class="category"><?= $fetch_products['category']; ?></div>
      </div>
      <div class="name"><?= $fetch_products['name']; ?></div>
      <div class="flex-btn">
         <a href="update_product.php?update=<?= $fetch_products['id']; ?>" class="option-btn">update</a>
         <a href="products.php?delete=<?= $fetch_products['id']; ?>" class="delete-btn" onclick="return confirm('delete this product?');">delete</a>
      </div>
   </div>
   <?php
         }
      }else{
         echo '<p class="empty">no products added yet!</p>';
      }
   ?>

   </div>

</section>

<!-- show products section ends -->










<!-- custom js file link  -->
<script src="../js/admin_script.js"></script>

</body>
</html>