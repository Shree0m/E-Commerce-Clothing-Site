<?php
include 'component/connect.php';
session_start();
$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : '';

include 'component/add_cart.php';
?>

<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
        <link rel="stylesheet" href="css/style.css">
        <script defer src="script.js"></script>

        <title>Modern Threads</title>
    </head>

    <body>

        <?php include "component/header.php" ?>


        <section id="producditails" class="section-p1" >

        <?php
        $pid = $_GET['pid'];
        $select_products = $conn->prepare("SELECT * FROM `products` WHERE id = ?");
        $select_products->execute([$pid]);

        $select_images = $conn->query("SELECT image_name FROM product_images WHERE product_id = $pid LIMIT 3");
        $images = $select_images->fetchAll(PDO::FETCH_ASSOC);

        if($select_products->rowCount() > 0){
            while($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)){
                include 'component/view_single_product.php';
            }
        }else{
            echo '<p class="empty">no products added yet!</p>';
        }
        ?>
        </section> 


        

        <section id="product1" class="section-p1">
        <h2>Featured Products</h2>
        <p>Summer Collection New Modern Design</p>
        <div class="pro-container">
            <?php
            $select_products = $conn->prepare("SELECT * FROM products where sale_percentage <= 0 LIMIT 4");
            $select_products->execute();
            if ($select_products->rowCount() > 0) {
                while ($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)) {
                    include 'component/product_card.php';
                }
            } else {
                echo '<p class="empty">No Products Added Yet!</p>';
            }
            ?>
        </div>
        </section>

        <section id="newsLetter" >
           <div>
            <h2>Sighn Up For newsLetter</h2>
            <h5>Get E-mail updates about our latest shop and <span> special offers</span></h5>
           </div>
            <div class="signUpinput" >
                <input placeholder="Your email address" type="email" name="user" id="signUp">
                <button class="normal" >signUp</button>
            </div>
        </section>
        
        <?php include "component/footer.php" ?>


    </body>

</html>