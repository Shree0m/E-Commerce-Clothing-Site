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
    <title>Modern Threads - About Us</title>
    <style>
        #company-info {
            margin-top: 20px;
            padding: 10px;
            background-image: url('./img/about-us-banner.jpg');
        }
        #company-info h2 {
            margin-top: 40px;
            margin-bottom: 20px;
            font-size: 24px;
            color: #ffffff;
            text-align: center;
        }

        #company-info p {
            font-size: 16px;
            line-height: 1.6;
            margin-bottom: 20px;
            color: #ffffff;
            text-align: center;
        }

        #groupOfFeatures {
            margin: 5px;
            border: 1px solid black;
        }
        </style>
</head>

<body>

    <?php include "component/header.php" ?>

    <section id="header" class="about-header">
        <h2>#KnowUs</h2>
        <p>Welcome to Modern Threads - Your ultimate destination for fashion enthusiasts. Here's a glimpse into who we are and what we stand for.</p>
    </section>

    

    <section id="company-info">
        <div class="container">
            <h2>Our Story</h2>
            <p>Modern Threads started with a simple idea - to provide trendy and affordable fashion to everyone, regardless of their location or budget. Founded in [year], we've grown into a global brand, serving millions of customers worldwide.</p>
            <h2>Our Mission</h2>
            <p>Our mission is to empower individuals to express themselves through fashion. We believe that everyone deserves to look and feel their best, and we strive to make that possible through our diverse range of clothing and accessories.</p>
            <h2>Why Choose Us?</h2>
            <p>At Modern Threads, we're more than just a clothing store. Here's why customers love us:</p>
        </div>
    </section>

    <section id="groupOfFeatures" class="section-p1">
        <div class="feature"> <img src="img/features/f1.png" alt=""> <h6>Free Shipping</h6> </div>
        <div class="feature"> <img src="img/features/f2.png" alt=""> <h6>Online Order</h6> </div>
        <div class="feature"> <img src="img/features/f3.png" alt=""> <h6>Save Money</h6> </div>
        <div class="feature"> <img src="img/features/f4.png" alt=""> <h6>Promotions</h6> </div>
        <div class="feature"> <img src="img/features/f5.png" alt=""> <h6>Happy Sellers</h6> </div>
        <div class="feature"> <img src="img/features/f6.png" alt=""> <h6>24/7 Support</h6> </div>
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
