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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200">
    <link rel="stylesheet" href="css/style.css">
    <script defer src="script.js"></script>
    <title>Modern Threads</title>
</head>
<body>
    <?php include "component/header.php" ?>

    <section id="header">
        <h2>#Stay Home</h2>
        <p>Save more with coupons & up to 70% off!</p>
    </section>

    <section id="product1" class="section-p1">
        <h2>Featured Products</h2>
        <p>Summer Collection New Modern Design</p>
        <div class="pro-container">
            <?php
            $total_records_per_page = 12;

            if (isset($_GET['page_no']) && $_GET['page_no'] != "") {
                $page_no = $_GET['page_no'];
            } else {
                $page_no = 1;
            }

            $offset = ($page_no - 1) * $total_records_per_page;

            $select_products = $conn->prepare("SELECT * FROM products LIMIT :offset, :total_records_per_page");
            $select_products->bindParam(':offset', $offset, PDO::PARAM_INT);
            $select_products->bindParam(':total_records_per_page', $total_records_per_page, PDO::PARAM_INT);
            $select_products->execute();

            if ($select_products->rowCount() > 0) {
                while ($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)) {
                    include 'component/product_card_sale.php';
                }
            } else {
                echo '<p class="empty">No Products Added Yet!</p>';
            }
            ?>
        </div>
    </section>

    <section id="paginatio" class="section-p1">
        <?php
        $total_records_query = $conn->query("SELECT COUNT(*) As total_records FROM products");
        $total_records = $total_records_query->fetch(PDO::FETCH_ASSOC)['total_records'];
        $total_no_of_pages = ceil($total_records / $total_records_per_page);
        
        if ($total_no_of_pages <= 10) {
            for ($counter = 1; $counter <= $total_no_of_pages; $counter++) {
                if ($counter == $page_no) {
                ?>
                    <a><?=$counter?></a>
                <?php
                } else {
                ?>
                    <a href='?page_no=<?=$counter?>'><?=$counter?></a>
                <?php
                }
            }
        }
        ?>
           
                    <a href="?page_no=<?=$total_no_of_pages?>"><span class="material-symbols-outlined">arrow_forward</span></a>

    </section>

    <section id="newsLetter">
        <div>
            <h2>Sign Up For Newsletter</h2>
            <h5>Get E-mail updates about our latest shop and <span>special offers</span></h5>
        </div>
        <div class="signUpinput">
            <input placeholder="Your email address" type="email" name="user" id="signUp">
            <button class="normal">Sign Up</button>
        </div>
    </section>

    <?php include "component/footer.php" ?>
</body>
</html>
