<nav id="nav" >
            <a href="index.php"><img id="logo" src="img/logo.png" alt="Logo"></a>
            <div id="slideMenu" >
                <ul id="navUl" >

                    <?php
                        if(isset($_POST['search'])){
                            $Name = $_POST['search'];
                            $Query = "SELECT Name FROM products WHERE Name LIKE '%$Name%' LIMIT 5";
                            $ExecQuery = MySQLi_query($con, $Query);
                        }
                    ?>

                    <div class="atag search">
                    <input type="text2" name="search" placeholder="Search" class="inputsearch"/>
                    <button class="btn"><i class="fas fa-search"></i></button>
                    </div>

                    <li class="navLi" id="home" ><a  class="active aTag"  href="index.php">Home</a></li>
                    <li class="navLi" id="shop" ><a class="aTag"  href="shop.php">Shop</a></li>
                    <li class="navLi" id="blognav" ><a  class="aTag" href="blog.php">Blog</a></li>
                    <li class="navLi" id="about" ><a  class="aTag" href="about.php">About</a></li>
                    <li class="navLi" id="contact" ><a  class="aTag" href="contact.php">Contact</a></li>

                    
                    <img src="img/login.png" class="user-pic" onclick="toggleMenu()">

                    <div class="sub-menu-wrap" id="subMenu">
                    <div class="sub-menu">

                    <?php
                    $select_profile = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
                    $select_profile->execute([$user_id]);
                    if($select_profile->rowCount() > 0){
                    $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
                    ?>
                   
                    <div class="user-info">
                        <img src="./img/user-login.png">
                        <h3><?= $fetch_profile['name']; ?></h3>
                    </div>
                    <hr>

                    <a href="profile.php" class="sub-menu-link">
                        <img src="./img/edit-profile.png">
                        <p>Edit Profile</p>
                        <span>></span>
                    </a>

                    <a href="component/user_logout.php" class="sub-menu-link" onclick="return confirm('logout from this website?');">
                        <img src="./img/logout.png">
                        <p>Logout</p>
                        <span>></span>
                    </a>

                    <?php
                    }else{
                    ?>

                    <div class="user-info">
                        <h3>Plase Login First!</h3>
                    </div>
                    <hr>
                    <a href="login.php" class="sub-menu-link">
                    <img src="./img/please-login.png">
                        <p>Login</p>
                        <span>></span>
                    </a>
                    <?php
                    }
                    ?>

                    </div>
                    </div>
                    
                    
                    <li class="navLi" id=""  >
                    
                    <?php
                    $count_cart_items = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
                    $count_cart_items->execute([$user_id]);
                    $total_cart_items = $count_cart_items->rowCount();
                    ?>
                    
                    <a class="mTag"  href="cart.php"><i class="material-symbols-outlined">
                        shopping_bag
                        </i><span>(<?= $total_cart_items; ?>)</span></a></li>  
  
                    <span id="close" class="material-symbols-outlined">close</span>
                    

                </ul>
            </div>
            <section class="mobile">
                 

                <a class="atag"  href="cart.php"><span class="material-symbols-outlined">
                    shopping_bag
                    </span></a>            

                <span id="hamMenu" class="material-symbols-outlined">menu</span>
                
            </section>


    <script>
    const search= document.querySelector('.search');
    const btn= document.querySelector('.btn');
    const input= document.querySelector('.inputsearch');
    btn.addEventListener('click',()=> {
    search.classList.toggle('active');
    input.focus();
    });

    let subMenu = document.getElementById("subMenu");

    function toggleMenu(){
        subMenu.classList.toggle("open-menu")
    }
    </script>
    
</nav>