<?php

include '../component/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
};

if(isset($_POST['update'])){

   $pid = $_POST['pid'];
   $pid = filter_var($pid, FILTER_SANITIZE_STRING);
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

   $update_product = $conn->prepare("UPDATE `products` SET name = ?, brand = ?, category = ?, gender = ?, season = ?, product_detail = ?, price = ?, sale_percentage = ? WHERE id = ?");
   $update_product->execute([$name, $brand, $category, $gender, $season, $product_detail, $price, $sale_percentage, $pid]);

   $message[] = 'product updated!';


   
   // Check if a new main image is uploaded
 // Process main image
if (!empty($_FILES['image']['tmp_name'][0])) {
   $image_name = $_FILES['image']['name'][0];
   $image_size = $_FILES['image']['size'][0];
   $image_tmp_name = $_FILES['image']['tmp_name'][0];
   $image_folder = '../uploaded_img/' . $image_name;

   // Check image size
   if ($image_size > 2000000) {
       $message[] = 'Main image size is too large!';
   } else {
       // Move the uploaded file to the destination folder
       if (move_uploaded_file($image_tmp_name, $image_folder)) {
           // Remove old main image (if exists)
           $old_main_image = $conn->query("SELECT image FROM products WHERE id = $pid")->fetchColumn();
           if ($old_main_image && file_exists("../uploaded_img/$old_main_image")) {
               unlink("../uploaded_img/$old_main_image");
           }
           // Update main image in database
           $update_image = $conn->prepare("UPDATE `products` SET image = ? WHERE id = ?");
           $update_image->execute([$image_name, $pid]);
           $message[] = 'Main image updated successfully!';
       } else {
           $message[] = 'Failed to update main image.';
       }
   }
} else {
   $message[] = 'Main image was not updated.';
}

// Process additional images
if (!empty($_FILES['additional_images']['tmp_name'][0])) {
   $additional_images = $_FILES['additional_images'];
   $message = array(); // Array to store messages for each file

   // Retrieve old additional image names from the database
   $old_additional_images = $conn->query("SELECT image_name FROM product_images WHERE product_id = $pid")->fetchAll(PDO::FETCH_COLUMN);

   // Iterate over additional images
   for ($i = 0; $i < min(count($additional_images['tmp_name']), 3); $i++) {
       $image_name = $additional_images['name'][$i];
       $image_size = $additional_images['size'][$i];
       $image_tmp_name = $additional_images['tmp_name'][$i];
       $image_folder = '../uploaded_img/' . $image_name;

       // Check image size
       if ($image_size > 2000000) {
           $message[] = "Additional image $i size is too large!";
       } else {
           // Move the uploaded file to the destination folder
           if (move_uploaded_file($image_tmp_name, $image_folder)) {
               // Remove old additional image (if exists)
               if (in_array($image_name, $old_additional_images)) {
                   $conn->prepare("DELETE FROM `product_images` WHERE product_id = ? AND image_name = ?")->execute([$pid, $image_name]);
                   if (file_exists("../uploaded_img/$image_name")) {
                       unlink("../uploaded_img/$image_name");
                   }
               }
               // Insert or update additional image in database
               $update_image = $conn->prepare("INSERT INTO `product_images` (product_id, image_name) VALUES (?, ?) ON DUPLICATE KEY UPDATE image_name = ?");
               $update_image->execute([$pid, $image_name, $image_name]);
               $message[] = "Additional image $i updated successfully!";
           } else {
               $message[] = "Failed to update additional image $i.";
           }
       }
   }
} else {
   $message[] = 'No additional images were updated.';
}

// Output messages for each file
foreach ($message as $msg) {
   echo $msg . "<br>";
}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>update product</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../css/admin_style.css">

</head>
<body>

<?php include '../component/admin_header.php' ?>

<!-- update product section starts  -->

<section class="update-product">

   <h1 class="heading">update product</h1>

   <?php
      $update_id = $_GET['update'];
      $show_products = $conn->prepare("SELECT * FROM `products` WHERE id = ?");
      $show_products->execute([$update_id]);
      if($show_products->rowCount() > 0){
         while($fetch_products = $show_products->fetch(PDO::FETCH_ASSOC)){  
   ?>
   <form action="" method="POST" enctype="multipart/form-data">
      <input type="hidden" name="pid" value="<?= $fetch_products['id']; ?>">
      <input type="hidden" name="old_image" value="<?= $fetch_products['image']; ?>">
      <img src="../uploaded_img/<?= $fetch_products['image']; ?>" alt="">
      <span>update name</span>
      <input type="text" required placeholder="enter product name" name="name" maxlength="100" class="box" value="<?= $fetch_products['name']; ?>">
      <span>update price</span>
      <input type="number" min="0" max="9999999999" required placeholder="enter product price" name="price" onkeypress="if(this.value.length == 10) return false;" class="box" value="<?= $fetch_products['price']; ?>">
      <span>update sale price</span>
      <input type="number" required placeholder="enter sale price" name="sale_percentage"  class="box" value="<?= $fetch_products['sale_percentage']; ?>">

      <span>update brand</span>
      <select name="brand" class="box" required>
      <option selected value="<?= $fetch_products['brand']; ?>"><?= $fetch_products['brand']; ?></option>
         <option value="Modern Thread">Modern Thread</option>
      </select>

      <span>update category</span>
      <select name="category" class="box" required>
         <option selected value="<?= $fetch_products['category']; ?>"><?= $fetch_products['category']; ?></option>
         <option value="T-Shirt">T-Shirt</option>
         <option value="Shirt">Shirt</option>
         <option value="Jeans">Jeans</option>
         <option value="Sweatshirt">Sweatshirt</option>
         <option value="Casual Jackets">Casual Jackets</option>
         <option value="Suits & Blazers">Suits & Blazers</option>
      </select>
      
      <span>update gender</span>
      <select name="gender" class="box" required>
      <option selected value="<?= $fetch_products['gender']; ?>"><?= $fetch_products['gender']; ?></option>
         <option value="Men">Men</option>
         <option value="Women">Women</option>
      </select>

      <span>update season</span>
      <select name="season" class="box" required>
      <option selected value="<?= $fetch_products['season']; ?>"><?= $fetch_products['season']; ?></option>
         <option value="Summer">Summer</option>
         <option value="Winter">Winter</option>
      </select>

      <span>update product detail</span>
      <textarea id="textarea" name="product_detail" rows="5" cols="55" placeholder="enter product details" class="box" value="<?= $fetch_products['product_detail']; ?>"></textarea>


      <span>update main image</span>
      <input type="file" name="image" class="box" accept="image/jpg, image/jpeg, image/png, image/webp">
      <span>update Additional images</span>
      <input type="file" name="additional_images[]" multiple class="box" accept="image/jpg, image/jpeg, image/png, image/webp">
      <div class="flex-btn">
         <input type="submit" value="update" class="btn" name="update">
         <a href="products.php" class="option-btn">go back</a>
      </div>
   </form>
   <?php
         }
      }else{
         echo '<p class="empty">no products added yet!</p>';
      }
   ?>

</section>

<!-- update product section ends -->










<!-- custom js file link  -->
<script src="../js/admin_script.js"></script>

</body>
</html>