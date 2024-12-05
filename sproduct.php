<?php require "functions.php"; 
    if (isset($_GET['id']) && is_numeric($_GET['id'])) {
        $product = getProductById( $_GET['id']);
    }
    print_r($product);
    $products = getAllProducts();
    if(session_status()==PHP_SESSION_NONE){
        session_start();
    }
    if($_SESSION['status']=='active'){
        header('location:sellerdashboard.php?error=Access Denied');
    }
?>
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-commerce</title>
    <link rel="stylesheet" href="css/main.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css?v=<?php echo time(); ?>">
</head>
<body>
    <section id="header">
    <?php require "navbar.php"; ?>
    </section>

    <form action="<?php echo ($_SERVER['PHP_SELF'])?>" method="post" enctype="multipart/form-data">
    <section id="prodetails" class="section_p1" >
        <div class="single-pro-image">
            <img src="img/products/<?php echo $product['image']?>" width="100%" id="mainimg" alt="<?php echo $product['prodname'] ?>">
            <!-- <div class="small-img-group">
                <div class="small-img-col">
                    <img src="img/products/f1.jpg" width="100%" class="small-img" alt="">
                </div>
                <div class="small-img-col">
                    <img src="img/products/f2.jpg" width="100%" class="small-img" alt="">
                </div>
                <div class="small-img-col">
                    <img src="img/products/f3.jpg" width="100%" class="small-img" alt="">
                </div>
                <div class="small-img-col">
                    <img src="img/products/f4.jpg" width="100%" class="small-img" alt="">
                </div>
            </div> -->
        </div>
        
            
        
        <div class="single-pro-details">
                <h4 name="prodname"><?php echo $product['prodname'] ?></h4>
                <h2 name="price">&dollar;<?php echo $product['price'] ?></h2>
                
                <select name="size">
                    <option value="">Select Size</option>
                    <option value="XXL">XXL</option>
                    <option value="XL">XL</option>
                    <option value="M">M</option>
                    <option value="S">S</option>
                    <option value="XS">XS</option>
                </select>
                <input type="number" width="10px" name="quantity" min="1" max="<?php echo $product['quantity']?>">
                <span>Max Quantity: <?php echo $product['quantity'] ?></span>
                <button class="normal" onclick="submitForm()">Add To Cart</button>
                
                <h4>Product Details</h4>
                <span><?php echo $product['prod_desc'] ?></span>
            </div>
        </section>
    </form>

    <section id="product1" class="section_p1">
        <h2>Featured Products</h2>
        <p>Summer Collection New Morder Design</p>
        <div class="pro-container">

        <?php foreach ($products as $key => $product) { ?>
                <?php if($product['f_stat'] == 1) { ?>
                    <div class="pro" onclick="window.location.href='shop.php'">
                        <img src="img/products/<?php echo $product['image']?>" alt="<?php $product['prodname'] ?>">
                        <div class="des">
                            <h5><?php echo $product['prodname'] ?></h5>
                            <div class="star">
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-half"></i>
                                <i class="bi bi-star"></i>
                            </div>
                            <h4>&dollar;<?php echo $product['price'] ?></h4>
                        </div>
                        <a href="shop.php"><i class="bi bi-cart cart"></i></a>
                    </div>
                <?php } ?>
            <?php } ?>
        </div>
    </section>
    <section id="newsletter" class="section_p1 section_m1">
        <div class="newstext">
            <h4>Sign Up for newsletter</h4>
            <p>Get E-mail updates about our latest shop and <span>special offers.</span></p>
        </div>
        <div class="form">
            <input type="text" placeholder="Your email address">
            <button class="normal">Sign Up</button>
        </div>
    </section>

    <?php require "footer.php"; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/script.js"></script>
</body>
</html>