<?php
include 'component/connect.php';
session_start();
$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : '';

include 'component/add_cart.php';

if(isset($_POST['send'])){

   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $email = $_POST['email'];
   $email = filter_var($email, FILTER_SANITIZE_STRING);
   $number = $_POST['number'];
   $number = filter_var($number, FILTER_SANITIZE_STRING);
   $msg = $_POST['msg'];
   $msg = filter_var($msg, FILTER_SANITIZE_STRING);

   $select_message = $conn->prepare("SELECT * FROM `messages` WHERE name = ? AND email = ? AND number = ? AND message = ?");
   $select_message->execute([$name, $email, $number, $msg]);

   if($select_message->rowCount() > 0){
      $message[] = 'already sent message!';
   }else{

      $insert_message = $conn->prepare("INSERT INTO `messages`(user_id, name, email, number, message) VALUES(?,?,?,?,?)");
      $insert_message->execute([$user_id, $name, $email, $number, $msg]);

      $message[] = 'sent message successfully!';

   }

}

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

        <section id="header" class="about-header" >
            <h2>Let's talks</h2>
            <p>LEAVE A MESSAGE, We love to hear from you!</p>
        </section>

        <section id="contact-details" class="section-p1" >
            <div class="details">
                <span>GET IN TOUCH</span>
                <h2>Visit one of our agency location or contact us today.</h2>
                <h3>Head office</h3>
                <div>
                    <li>
                        <i class="fa-solid fa-location-dot"></i>
                        <p>Alkapuri, Vadodara - Gujarat, India</p>
                    </li>
                    <li>
                        <i class="fa-regular fa-envelope"></i>
                        <p>Contact@example.com</p>
                    </li>
                    <li>
                        <i class="fa-solid fa-phone"></i>
                        <p>+91 111-111-1111 , +91 222-222-2222</p>
                    </li>
                    <li>
                        <i class="fa-solid fa-clock"></i>
                        <p>Monday to Saturday: 10:00 A.M. to 6:00 P.M.</p>
                    </li>
                </div>
            </div>
            <div class="google-map">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d10439.728978023619!2d73.16829196412611!3d22.315780113913227!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x395fc8b0d1d96b7b%3A0x58a04bbe95a81681!2sAlkapuri%2C%20Vadodara%2C%20Gujarat!5e0!3m2!1sen!2sin!4v1709635644354!5m2!1sen!2sin" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </section>

        <section id="form-details" >
            <form action="" method="post">
                <span>LEAVE A MESSAGE</span>
                <h2>We love to hear from you</h2>
                <input type="text" name="name" placeholder="Your name" >
                <input type="text" name="email" placeholder="Your email" >
                <input type="text" name="number" placeholder="Your number" >
                <textarea name="msg" id="" cols="30" rows="10" placeholder="Your message" ></textarea>
                <button type="submit" name="send" class="normal" >submit</button>
            </form>
            <div class="people">
                <div>
                    <img src="img/people/1.png" alt="">
                    <p><span>Admin 1</span>Senior Marketing Manager <br> Phone : + 91 000-123-4567 <br> Email: contact@example.com</p>
                </div>
                <div>
                    <img src="img/people/2.png" alt="">
                    <p><span>Admin 2</span>Senior Marketing Manager <br> Phone : + 91 000-123-4567 <br> Email: contact@example.com</p>
                </div>
                <div>
                    <img src="img/people/3.png" alt="">
                    <p><span>Admin 3</span>Senior Marketing Manager <br> Phone : + 91 000-123-4567 <br> Email: contact@example.com</p>
                </div>
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