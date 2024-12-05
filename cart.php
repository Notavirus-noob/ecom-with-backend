
<?php 
require 'functions.php'; 
if(!session_status()==PHP_SESSION_NONE){
    session_start();
    if($_SESSION['status']){
        header('location:sellerdashboard.php?error=Access Denied');
    }
}
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

    <section id="page-header" class="about-header">
        <h2>#Let's talk</h2>
        <p>LEAVE A MESSAGE,We love to hear from you!</p>
    </section>
    <?php if (!isset($user['username'])): ?>
        <h2 class="text-center">Welcome Guest. <a href="user_signuplogin.php">Please login</a></h2>
    <?php elseif (isset($user)): ?>

            <h2 class="text-center">Welcome <?php echo htmlspecialchars($user['username']) ; ?>.</h2>
    <?php endif; ?>

    <section id="cart" class="section_p1">
        <table  width="100%">
            <thead>
                <tr>
                    <td>Remove</td>
                    <td>Image</td>
                    <td>Product</td>
                    <td>Price</td>
                    <td>Quantity</td>
                    <td>SubTotal</td>
                </tr>
            </thead>
            <tbody>
                <?php $cartsubtotal=0; ?>
                <?php if (isset($users)): ?>
                    <?php foreach ($users as $index => $user) { ?>
                        <tr>
                            <td><a href="del_connection.php?id=<?php echo $user['id'] ?>"><i class="bi bi-x-circle"></i></a></td>
                            <td><img src="<?php echo $user['image'] ?>" alt="<?php $user['prodname'] ?>"></td>
                            <td><?php echo $user['prodname'] ?></td>
                            <td><?php echo $user['price'] ?></td>
                            <td><?php echo $user['quantity'] ?></td>
                            <td><?php echo $subtotal=($user['price']*$user['quantity']) ?></td>
                            <?php $cartsubtotal+=$subtotal?>
                        </tr>
                    <?php } ?>
                <?php endif; ?>
            </tbody>
        </table>
    </section>

    <section id="cart-add" class="section_p1">
        <div id="coupon">
            <h3>Apply Coupon</h3>
            <div>
                <input type="text" placeholder="Enter your Coupon">
                <button class="normal">Apply</button>
            </div>
        </div>
        <div id="subtotal">
            <h3>Cart Total</h3>
            <table>
                <tr>
                    <td>Cart SubTotal</td>
                    <td><strong>Rs: <?php echo $cartsubtotal ?></strong></td>
                </tr>
                <tr>
                    <td>Shipping</td>
                    <td>Free</td>
                </tr>
                <tr>
                    <td><strong>Total</strong></td>
                    <td><strong>Rs: <?php echo $cartsubtotal ?></strong></td>
                </tr>
            </table>
            <button class="normal">Procced to Checkout</button>
        </div>
    </section>
    <?php require "footer.php"; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/script.js"></script>
</body>
</html>