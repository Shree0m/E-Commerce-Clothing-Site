<div class="pro" onclick="location='sproduct_sale.php?pid=<?= $fetch_products['id']; ?>' ">
                    <form action="" method="post" class="box">
                        <input type="hidden" name="pid" value="<?= $fetch_products['id']; ?>">
                        <input type="hidden" name="name" value="<?= $fetch_products['name']; ?>">
                        <input type="hidden" name="price" value="<?= $fetch_products['price']; ?>">
                        <input type="hidden" name="image" value="<?= $fetch_products['image']; ?>">

                        <img src="uploaded_img/<?= $fetch_products['image']; ?>" alt="">
                        <div class="discription">
                            <span id="brandGrid" ><?= $fetch_products['brand']; ?></span>
                            <h5 id="T-styleGrid" ><?= $fetch_products['name']; ?></h5>
                            <div id="starsforgrid" class="starts">
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                            </div>

                            <?php
                            $sale_price = ($fetch_products['price'] / 100) * $fetch_products['sale_percentage'];
                            $final_price = $fetch_products['price'] - $sale_price;
                            ?>

                            <h5 id="priceGrid" class="price">&#x20B9;<?= $final_price ?> 
                            <div id="" class="sale-price"><del>&#x20B9;<?= $fetch_products['price']; ?></del></div> <span id="sale-percent">&nbsp;(<?= $fetch_products['sale_percentage']?>% off)</span></h5>
                            <span type="submit" id="cartGrid" class="productCart" name="add_to_cart"><i id="cart" class="fa-solid fa-cart-shopping"></i></a></button>
                        </div>
                    </form>             
</div>