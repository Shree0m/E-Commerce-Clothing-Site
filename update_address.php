<?php

include 'component/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
   header('location:home.php');
};

if(isset($_POST['submit'])){

   $address = $_POST['flat'] .', '.$_POST['building'].', '.$_POST['area'].', '.$_POST['town'] .', '. $_POST['city'] .', '. $_POST['state'] .', '. $_POST['country'] .' - '. $_POST['pin_code'];
   $address = filter_var($address, FILTER_SANITIZE_STRING);

   $update_address = $conn->prepare("UPDATE `users` set address = ? WHERE id = ?");
   $update_address->execute([$address, $user_id]);

   $city = $_POST['city'];
   $city = filter_var($city, FILTER_SANITIZE_STRING);

   $update_city = $conn->prepare("UPDATE `users` set city = ? WHERE id = ?");
   $update_city->execute([$city, $user_id]);

   $state = $_POST['state'];
   $state = filter_var($state, FILTER_SANITIZE_STRING);

   $update_state = $conn->prepare("UPDATE `users` set state = ? WHERE id = ?");
   $update_state->execute([$state, $user_id]);

   $pin_code = $_POST['pin_code'];
   $pin_code = filter_var($pin_code, FILTER_SANITIZE_STRING);

   $update_pin_code = $conn->prepare("UPDATE `users` set pin_code = ? WHERE id = ?");
   $update_pin_code->execute([$pin_code, $user_id]);

   echo 'address saved!';

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
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="css/checkout.css">
        <script defer src="script.js"></script>
        <title>Modern Threads</title>
    </head>

    <body>

    <?php include "component/header.php" ?>


<section id="header" class="about-header" >
            <h2>#Update Address</h2>
            <p>Save your Details to Make us to Reach </p>
</section>

<h2 class="ckt-h2">Address Form</h2>
<div class="row">
  <div class="col-75">
    <div class="container">
      <form action="" method="post">
      
        <div class="row">
          <div class="col-50">
            <h3 class="ckt-h3">Address Datails </h3>
            <input type="text" class="box" placeholder="flat no." required maxlength="50" name="flat">
            <input type="text" class="box" placeholder="building no." required maxlength="50" name="building">
      <input type="text" class="box" placeholder="area name" required maxlength="50" name="area">
      <input type="text" class="box" placeholder="town name" required maxlength="50" name="town">
      <input type="text" class="box" placeholder="city name" required maxlength="50" name="city">
      <input type="text" class="box" placeholder="state name" required maxlength="50" name="state">
      <input type="text" class="box" placeholder="country name" required maxlength="50" name="country">
      <input type="text" class="box" placeholder="pin code" required  name="pin_code">


        <input type="submit" name ="submit" value="Update Address" class="btn2">
      </form>


    </div>
  </div>
</div>
        
    <?php include "component/footer.php" ?>

    </body>

</html>