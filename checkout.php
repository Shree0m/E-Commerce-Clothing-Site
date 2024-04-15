<?php

include 'component/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
   header('location:index.php');
};


if(isset($_POST['submit'])){

   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $number = $_POST['number'];
   $number = filter_var($number, FILTER_SANITIZE_STRING);
   $email = $_POST['email'];
   $email = filter_var($email, FILTER_SANITIZE_STRING);
   $method = $_POST['method'];
   $method = filter_var($method, FILTER_SANITIZE_STRING);
   $address = $_POST['address'];
   $address = filter_var($address, FILTER_SANITIZE_STRING);
   $total_products = $_POST['total_products'];
   $total_price = $_POST['total_price'];


   $check_cart = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
   $check_cart->execute([$user_id]);

   if($check_cart->rowCount() > 0){

      if($address == ''){
         $message[] = 'please add your address!';
      }else{
         
         $insert_order = $conn->prepare("INSERT INTO `orders`(user_id, name, number, email, method, address, total_products, total_price) VALUES(?,?,?,?,?,?,?,?)");
         $insert_order->execute([$user_id, $name, $number, $email, $method, $address, $total_products, $total_price]);

         $delete_cart = $conn->prepare("DELETE FROM `cart` WHERE user_id = ?");
         $delete_cart->execute([$user_id]);

        //  $message[] = 'order placed successfully!';
         echo "<script> alert('order placed successfully!'); </script>";
      }
      
   }else{
      // $message[] = 'your cart is empty';
      echo "<script> alert('your cart is empty'); </script>";
   }
}
?>

<!--------------------------------------------------------------------- HTML START----------------------------------------------------------------------------------->

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
            <h2>Checkout</h2>
            <p>Save your Details to Make us to Reach </p>
        </section>

<h2 class="ckt-h2">Checkout Form</h2>
<div class="row">
  <div class="col-75">
    <div class="container">
      <form action="" method="post">

      <?php
            $select_profile = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
            $select_profile->execute([$user_id]);
            if($select_profile->rowCount() > 0){
               $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
         ?>

        <input type="hidden" name="name" value="<?= $fetch_profile['name'] ?>">
        <input type="hidden" name="number" value="<?= $fetch_profile['number'] ?>">
        <input type="hidden" name="email" value="<?= $fetch_profile['email'] ?>">
        <input type="hidden" name="email" value="<?= $fetch_profile['address'] ?>">

      
<!--------------------------------------------------------------- Billing Address Start ------------------------------------------------------------------------>

        <div class="row">
          <div class="col-50">
            <h3 class="ckt-h3">Billing Address</h3>
            <label for="fname"><i class="fa fa-user"></i> Full Name</label>
            <input type="text" id="fname" name="firstname" value="<?= $fetch_profile['name'] ?>">
            <label for="email"><i class="fa fa-envelope"></i> Email</label>
            <input type="text" id="email" name="email" value="<?= $fetch_profile['email'] ?>">
            <label for="adr"><i class="fa fa-address-card-o"></i> Address</label>
            <input type="text" id="adr" name="address" value="<?= $fetch_profile['address'] ?>">
            <label for="city"><i class="fa fa-institution"></i> City</label>
            <input type="text" id="city" name="city" value="<?= $fetch_profile['city'] ?>">


            <div class="row">
              <div class="col-50">
                <label for="state">State</label>
                <input type="text" id="state" name="state" value="<?= $fetch_profile['state'] ?>">
              </div>
              <div class="col-50">
                <label for="zip">Zip</label>
                <input type="text" id="zip" name="zip" placeholder="000001" value="<?= $fetch_profile['pin_code'] ?>">
              </div>
            </div>

            <?php } else { ?>
            <label>Data Not Found</label>
            <?php } ?>

            <input type="button" name="button" value="Update Address" class="btn2" onclick="location='update_address.php'">
          </div>



          <div class="col-50">
            <h3 class="ckt-h3">Payment</h3>
            <label for="fname">Accepted Cards</label>
            <div class="icon-container">
              <i class="fa fa-cc-visa" style="color:navy;"></i>
              <i class="fa fa-cc-amex" style="color:blue;"></i>
              <i class="fa fa-cc-mastercard" style="color:red;"></i>
              <i class="fa fa-cc-discover" style="color:orange;"></i>
            </div>


<!----------------------------------------------------------- Billing Address Ends ------------------------------------------------------------------------>




<!----------------------------------------------------------- Payment-Methods Start ---------------------------------------------------------------------------->

        <script>
        function name_click() {
            var selectedValue = document.getElementById("selectVal").value;
            if (selectedValue == "credit card") {
                document.getElementById("creditCardForm").style.display = "block";
            } else {
                document.getElementById("creditCardForm").style.display = "none";
            }
        }
    </script>

            <select name="method" id="selectVal" onchange="name_click()" required>
            <option value="" disabled selected>select payment method --</option>
            <option value="cash on delivery">Cash On Delivery</option>
            <option value="credit card">Credit Card</option>
            <!-- <option value="upi">UPI</option> -->
            </select>

  <div id="creditCardForm" style="display: none;">


    <!-- <label for="cname">Name on Card</label>
    <input type="text" id="cname" name="cardname" placeholder="Card Name">
    <label for="ccnum">Credit card number</label>
    <input type="text" id="ccnum" name="cardnumber" placeholder="1111-2222-3333-4444">
    <label for="expmonth">Exp Month</label>
    <input type="text" id="expmonth" name="expmonth" placeholder="September">
    <div class="row">
        <div class="col-50">
            <label for="expyear">Exp Year</label>
            <input type="text" id="expyear" name="expyear" placeholder="2018">
        </div>
        <div class="col-50">
            <label for="cvv">CVV</label>
            <input type="text" id="cvv" name="cvv" placeholder="352">
        </div> -->

    <input type="button" value="Click to Pay via Card" class="btn2" onclick="location='payment-gateway.php'">
    

    </div>
  </div>
<!------------------------------------------------------------ Payment-Methods Ends-------------------------------------------------------------------------- -->


<!-------------------------------------------------------------- Cart-Items Start ------------------------------------------------------------------------------>

    <div class="container">
      <h4>Cart <span class="price" style="color:black"><i class="fa fa-shopping-cart"></i> <b><?= $total_cart_items; ?></b></span></h4>

      <?php
      $grand_total = 0;
      $cart_items[] = '';
      $select_cart = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
      $select_cart->execute([$user_id]);
      if($select_cart->rowCount() > 0){
        while($fetch_cart = $select_cart->fetch(PDO::FETCH_ASSOC)){
        $cart_items[] = $fetch_cart['name'].' ('.$fetch_cart['price'].' x '. $fetch_cart['quantity'].') - ';
        $total_products = implode($cart_items);
        $grand_total += ($fetch_cart['price'] * $fetch_cart['quantity']);


        $total_cart_items = $select_cart->rowCount();
      ?>

      <p class="cart-item"><?= $fetch_cart['name']; ?> x <?= $fetch_cart['quantity']; ?> <span class="price">&#x20B9;<?= $fetch_cart['price']; ?></span></p>

      <?php
      }
      }else{
      echo '<p class="empty">your cart is empty!</p>';
      }
      ?>

      <hr>
      
      <?php
      // Apply coupon discount if applicable
      if (isset($_SESSION['coupon_applied']) && $_SESSION['coupon_applied'] === true) {
          $coupon_total = ($grand_total / 100) * $_SESSION['discount_amount'];
          $grand_total -= $coupon_total;
      }
      ?>
      
      <p>Total <span class="price" style="color:black"><b>&#x20B9;<?= $grand_total; ?></b></span></p>
    </div>
  </div>

        <input type="hidden" name="total_price" value="<?= $grand_total; ?>">
        <input type="hidden" name="total_products" value="<?= $total_products; ?>">

<!----------------------------------------------------------------Cart-Items Ends ------------------------------------------------------------------------>





<!----------------------------------------------------- Sending Data to Stripe Card Start -------------------------------------------------------------------->



<!------------------------------------------------------- Sending Data to Stripe Card End-------------------------------------------------------------------->




<label>
<input type="checkbox" checked="checked" name="sameadr"> Shipping address same as billing
</label>
<input type="submit" name="submit" value="Proceed Order" class="btn2">
</form>
</div>



        
    <?php include "component/footer.php" ?>

  </body>

</html>