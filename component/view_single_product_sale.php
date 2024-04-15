<form action="" method="post" class="single_product">
            <div class="single-pro-image" >
                <img src="uploaded_img/<?= $fetch_products['image']; ?>" alt="" width="100%" id="mainImg">
                
                <div class="small-img-grp" >
                   <div class="small-img-col">
                       <img src="uploaded_img/<?= $fetch_products['image']; ?>" alt="" width="100%" class="small-img" >
                   </div>

                   <?php foreach ($images as $image): ?>
                   <div class="small-img-col">
                       <img src="uploaded_img/<?= $image['image_name']; ?>" alt="" width="100%" class="small-img" >
                   </div>
                   <?php endforeach; ?>
                                  
                </div>

            </div>

            <?php
            $sale_price = ($fetch_products['price'] / 100) * $fetch_products['sale_percentage'];
            $final_price = $fetch_products['price'] - $sale_price;
            ?>

            <input type="hidden" name="pid" value="<?= $fetch_products['id']; ?>">  
            <input type="hidden" name="name" value="<?= $fetch_products['name']; ?>">
            <input type="hidden" name="price" value="<?= $final_price ?>">
            <input type="hidden" name="image" value="<?= $fetch_products['image']; ?>">
            
             <div class="single-pro-details">
                <h6>Home / <?= $fetch_products['category']; ?></h6>
                <h4><?= $fetch_products['name']; ?></h4>

                

                <h2>&#x20B9;<?= $final_price ?>
                <div id="" class="sale-price"><del>&#x20B9;<?= $fetch_products['price']; ?></del></div> <span id="sale-percent">&nbsp;(<?= $fetch_products['sale_percentage']?>% off)</span></h2>

                <select name="size">
                    <option value="">Select Size</option>
                    <option value="Small">Small</option>
                    <option value="Medium">Medium</option>
                    <option value="Large">Large</option>
                    <option value="X-Large">X-Large</option>
                    <option value="XX-Large">XX-Large</option>
                </select>
                </br>
                <input type="number" name="quantity" value="1" >
                <button type="submit" class="normal" name="add_to_cart" >Add to cart</button>
                <h4>Product Details</h4>
                <span><?= $fetch_products['product_detail']; ?></span>
             </div>
</form>