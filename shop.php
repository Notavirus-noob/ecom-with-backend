<?php
require 'functions.php';
$products = getAllProducts();
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

    <section id="page-header">
        <h2>#stayhome</h2>
        <p>Save more with counpons, prom-code and up to 70% off! </p>
    </section>

    <section id="product1" class="section_p1">
        <div class="pro-container">
        <?php foreach ($products as $key => $product) { ?>
                    <div class="pro" onclick="window.location.href='sproduct.php?id=<?php echo $product['prod_id'] ?>'">
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
                        <a href="sproduct.php?id=<?php echo $product['prod_id'] ?>"><i class="bi bi-cart cart"></i></a>
                    </div>
                <?php } ?>
        </div>
    </section>

    <section id="pagination" class="section_p1">
        <a href="#">1</a>
        <a href="#">2</a>
        <a href="#">3</a>
        <a href="#"><i class="bi bi-arrow-right"></i></a>
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