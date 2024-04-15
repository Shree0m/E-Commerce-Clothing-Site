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

    <section id="mainBanner">
        <h4>Trade-in-offer</h4>
        <h2>Super value deals</h2>
        <h1>On all products</h1>
        <p>Save more with coupons & up to 70% off!</p>
        <button type="button">Shop Now</button>
    </section>

    <section id="groupOfFeatures" class="section-p1">
        <div class="feature"> <img src="img/features/f1.png" alt=""> <h6>Free Shipping</h6> </div>
        <div class="feature"> <img src="img/features/f2.png" alt=""> <h6>Online Order</h6> </div>
        <div class="feature"> <img src="img/features/f3.png" alt=""> <h6>Save Money</h6> </div>
        <div class="feature"> <img src="img/features/f4.png" alt=""> <h6>Promotions</h6> </div>
        <div class="feature"> <img src="img/features/f5.png" alt=""> <h6>Happy Sellers</h6> </div>
        <div class="feature"> <img src="img/features/f6.png" alt=""> <h6>24/7 Support</h6> </div>
    </section>

    <section id="product1" class="section-p1">
        <h2>Featured Products</h2>
        <p>Summer Collection New Modern Design</p>
        <div class="pro-container">
            <?php
            $select_products = $conn->prepare("SELECT * FROM products where sale_percentage <= 0 LIMIT 8");
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

    <section id="banner" class="section-m1">
        <h5>Repar Services</h5>
        <h2>Up to <span id="red">70% off</span>- All T-Shirt & Accessories</h2>
        <button class="normal"  onclick="location='shop.php' ">Explore More</button>
    </section>

    <section id="product1" class="section-p1">
        <h2>New Arrivals</h2>
        <p>Summer Collection New Modern Design</p>
        <div class="pro-container">
            <?php
            $select_products = $conn->prepare("SELECT * FROM products where sale_percentage <= 0 ORDER BY id DESC LIMIT 8");
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

    <section id="sm-banner">
        <div class="banner-box" onclick="location='shop.php' ">
            <h5>Crazy deals</h5>
            <h2>Best Deals Awaits You</h2>
            <h5>The best classic dress is on sale at Modern Thread</h5>
            <button class="normal">Learn more</button>
        </div>
        <div id="banner2" class="banner-box" onclick="location='winter-collection.php' ">
            <h5>Winter Collection</h5>
            <h2>Upcoming season</h2>
            <h5>The best classic dress is on sale at Modern Thread</h5>
            <button class="normal">Collection</button>
        </div>
    </section>

    <section id="Text-banner">
        <div id="Text-banner1" class="banner-box" onclick="location='seasonal-sale.php' ">
            <h2>SEASONAL SALE</h2>
            <h5>Summer Collection Upto -50% OFF</h5>
        </div>
        <div id="Text-banner2" class="banner-box" onclick="location='winter-collection.php' ">
            <h2>NEW COLLECTION</h2>
            <h5>Winter Season</h5>
        </div>
        <div id="Text-banner3" class="banner-box" onclick="location='t-shirt.php' ">
            <h2>T-SHIRTS</h2>
            <h5>New Trendy</h5>
        </div>
    </section>

    <section id="newsLetter">
        <div>
            <h2>Sign Up For Newsletter</h2>
            <h5>Get E-mail updates about our latest shop and <span> special offers</span></h5>
        </div>
        <div class="signUpinput">
            <input placeholder="Your email address" type="email" name="user" id="signUp">
            <button class="normal">Sign Up</button>
        </div>
    </section>

    <?php include "component/footer.php" ?>
    
</body>
</html>
