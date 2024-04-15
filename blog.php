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


        <section id="header" class="blog-header" >
            <h2>#readmore</h2>
            <p>Read all case studies about our products!</p>
        </section>
 
        <section id="blog">
            <div class="blog-box">
                <div class="blog-image">
                    <img src="img/blog/b1.jpg" alt="">
                </div>
                <div class="blog-details" >
                    <h4>Elegance Redefined</h4>
                    <p>Step into a world of grace and sophistication as we delve into the exquisite realm of female lungare. Our latest fashion blog takes you on a journey through the rich cultural heritage,</p>
                    <a href="#">CONTINUE READING</a>
                </div>
                <h1>10/15</h1>
            </div>
            <div class="blog-box">
                <div class="blog-image">
                    <img src="img/blog/b2.jpg" alt="">
                </div>
                <div class="blog-details" >
                    <h4>Elegance Redefined</h4>
                    <p>Kickstarter man braid godard cloring book. Raclette waistcoat selfies yr wall chatreuse hexagon irony,godard</p>
                    <a href="#">CONTINUE READING</a>
                </div>
                <h1>9/10</h1>
            </div>
            <div class="blog-box">
                <div class="blog-image">
                    <img src="img/blog/b3.jpg" alt="">
                </div>
                <div class="blog-details" >
                    <h4>How to style a quiff</h4>
                    <p>Kickstarter man braid godard cloring book. Raclette waistcoat selfies yr wall chatreuse hexagon irony,godard</p>
                    <a href="#">CONTINUE READING</a>
                </div>
                <h1>9/1</h1>
            </div>
            <div class="blog-box">
                <div class="blog-image">
                    <img src="img/blog/b7.jpg" alt="">
                </div>
                <div class="blog-details" >
                    <h4>Must-Have items</h4>
                    <p>Kickstarter man braid godard cloring book. Raclette waistcoat selfies yr wall chatreuse hexagon irony,godard</p>
                    <a href="#">CONTINUE READING</a>
                </div>
                <h1>8/20</h1>
            </div>
            <div class="blog-box">
                <div class="blog-image">
                    <img src="img/blog/b8.webp" alt="">
                </div>
                <div class="blog-details" >
                    <h4>Runway-Insired Trends</h4>
                    <p>Kickstarter man braid godard cloring book. Raclette waistcoat selfies yr wall chatreuse hexagon irony,godard</p>
                    <a href="#">CONTINUE READING</a>
                </div>
                <h1>8/12</h1>
            </div>
        </section>

        <section id="paginatio" class="section-p1" >
            <a href="#">1</a>
            <a href="#">2</a>
            <a href="#"><span class="material-symbols-outlined">arrow_forward</span></a>
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