<?php

include 'component/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
   header('location:index.php');
};


// Fetch coupon details from database
function getCouponDetails($coupon_code, $conn) {
    $select_coupon = $conn->prepare("SELECT * FROM coupons WHERE coupon_code = ?");
    $select_coupon->execute([$coupon_code]);
    return $select_coupon->fetch(PDO::FETCH_ASSOC);
}

// Apply coupon
function applyCoupon($entered_coupon, $conn) {
    $coupon_details = getCouponDetails($entered_coupon, $conn);
    if ($coupon_details) {
        $_SESSION['coupon_applied'] = true;
        $_SESSION['coupon_code'] = $coupon_details['coupon_code'];
        $_SESSION['discount_amount'] = $coupon_details['discount_amount'];
        return true;
    }
    return false;
}

// Check if coupon form is submitted
if (isset($_POST['apply_coupon'])) {
    $entered_coupon = $_POST['coupon_code'];
    if (applyCoupon($entered_coupon, $conn)) {
         echo "<script> alert('Coupon applied successfully!') </script>";
    } else {
         echo "<script> alert('Invalid coupon code!') </script>";
    }
}

// Normal Code
if(isset($_POST['delete'])){
   $cart_id = $_POST['cart_id'];
   $delete_cart_item = $conn->prepare("DELETE FROM `cart` WHERE id = ?");
   $delete_cart_item->execute([$cart_id]);
   $message[] = 'cart item deleted!';
}

if(isset($_POST['delete_all'])){
   $delete_cart_item = $conn->prepare("DELETE FROM `cart` WHERE user_id = ?");
   $delete_cart_item->execute([$user_id]);
   // header('location:cart.php');
   $message[] = 'deleted all from cart!';
}

if(isset($_POST['update_qty'])){
   $cart_id = $_POST['cart_id'];
   $qty = $_POST['qty'];
   $qty = filter_var($qty, FILTER_SANITIZE_STRING);
   $update_qty = $conn->prepare("UPDATE `cart` SET quantity = ? WHERE id = ?");
   $update_qty->execute([$qty, $cart_id]);
   $message[] = 'cart quantity updated';
}

$grand_total = 0;

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

    <section id="cart" class="section-p1" >

        <table width="100%">
            <thead>
                <tr>
                    <td>Remove</td>
                    <td>Image</td>
                    <td>Product</td>
                    <td>Price</td>
                    <td>Quantity</td>
                    <td>Subtotal</td>
                </tr>
            </thead>
            <tbody>

            <?php
            $grand_total = 0;
            $select_cart = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
            $select_cart->execute([$user_id]);
            if($select_cart->rowCount() > 0){
                while($fetch_cart = $select_cart->fetch(PDO::FETCH_ASSOC)){
            ?>

                <form action="" method="post">
                    <input type="hidden" name="cart_id" value="<?= $fetch_cart['id']; ?>">
                    <tr>
                        <td><button type="submit" id="button" name="delete" onclick="return confirm('delete this item?');"><i class="fa-solid fa-trash"></i></button></td>
                        <td><img src="uploaded_img/<?= $fetch_cart['image']; ?>" alt=""></td>
                        <td><?= $fetch_cart['name']; ?></td>
                        <td>&#x20B9;<?= $fetch_cart['price']; ?></td>
                        <td><input type="number" value="<?= $fetch_cart['quantity']; ?>"></td>
                        <td>&#x20B9;<?= $sub_total = ($fetch_cart['price'] * $fetch_cart['quantity']); ?></td>
                    </tr>
                </form>
                <?php
                    $grand_total += $sub_total;
                }
            } else {
                echo '<p class="empty" align="center">Your cart is empty</p>';
            }
            ?>

            </tbody>
        </table>
    </section>

    <section id="cart-add" class="section-p1" >
        <div id="coupon">
            <h3>Apply Coupon</h3>
            <div>
                <form action="" method="post">
                    <input type="text" name="coupon_code" placeholder="Enter Your Coupon">
                    <button type="submit" name="apply_coupon" class="normal">Apply</button>
                </form>
            </div>
        </div>

        <div id="subtotal">
            <h3>Cart Totals</h3>
            <table>
                <tr>
                    <td>Cart Subtotal</td>
                    <td>&#x20B9;<?= $grand_total; ?></td>
                </tr>
                <tr>
                    <td>Shipping</td>
                    <td>Free</td>
                </tr>
                <tr>
                    <?php
                        // Apply coupon discount if applicable
                        if (isset($_SESSION['coupon_applied']) && $_SESSION['coupon_applied'] === true) {
                            $coupon_total = ($grand_total / 100) * $_SESSION['discount_amount'];
                            $grand_total -= $coupon_total;
                        }
                    ?>
                    <td><strong>Total</strong></td>
                    <td><strong>&#x20B9;<?= $grand_total ?></strong></td>
                </tr>
            </table>
            <button class="normal"><a href="checkout.php">Process to Checkout</a></button>
        </div>
    </section>

    <?php include "component/footer.php" ?>

</body>

</html>
