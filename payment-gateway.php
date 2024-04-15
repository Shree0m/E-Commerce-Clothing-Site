<?php
include 'component/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
   header('location:index.php');
};

require __DIR__ . "/vendor/autoload.php";


\Stripe\Stripe::setApiKey($secret_key);


      $grand_total = 0;
      $cart_items[] = '';
      $select_cart = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
      $select_cart->execute([$user_id]);
      if($select_cart->rowCount() > 0){
        while($fetch_cart = $select_cart->fetch(PDO::FETCH_ASSOC)){


$checkout_session = \Stripe\Checkout\Session::create([
    "mode" => "payment",
    "success_url" => "http://localhost/checkout.php",
    "cancel_url" => "http://localhost/index.php",
    "locale" => "auto",
    "line_items" => [
        [
            "quantity" => $fetch_cart['quantity'],
            "price_data" => [
                "currency" => "inr",
                "unit_amount" => $fetch_cart['price'] * 100,
                "product_data" => [
                    "name" => "Total Amount"
                ]
            ]
        ]
    ]
]);

}}



$select_profile = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
            $select_profile->execute([$user_id]);
            if($select_profile->rowCount() > 0){
               while($fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC)){

$country = "India";
$customer = \Stripe\Customer::create(array(
    'name' =>  $fetch_profile['name'],
    'description' => 'test description',
    'email' => $fetch_profile['email'],
    'source' => $token,
    "address" => ["city" => $fetch_profile['city'], "country" => $country, "line1" => $fetch_profile['address'], "postal_code" => $fetch_profile['pin_code'], "state" => $fetch_profile['state'] ]
));

}}

http_response_code(303);
header("Location: " . $checkout_session->url);