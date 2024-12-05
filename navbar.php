<?php
$current_page = basename($_SERVER['PHP_SELF']);
 require_once 'functions.php';
 $user=startSession();
?>
<a href="index.php"><img src="img/logo.png" class="logo" alt="company logo"></a>
<div>
    <ul id="navbar">
        <li><a href="index.php" class="<?php echo $current_page == 'index.php' ? 'active' : ''; ?>">Home</a></li>
        <li><a href="shop.php" class="<?php echo $current_page == 'shop.php' ? 'active' : ''; ?>">Shop</a></li>
        <?php if (!isset($user['status'])): ?>
        <li><a href="blog.php" class="<?php echo $current_page == 'blog.php' ? 'active' : ''; ?>">Blog</a></li>
        <li><a href="about.php" class="<?php echo $current_page == 'about.php' ? 'active' : ''; ?>">About</a></li>
        <?php if (!isset($user['id'])): ?>
        <li><a href="seller_signuplogin.php" class="<?php echo $current_page == 'seller_signuplogin.php' ? 'active' : ''; ?>">Are you a seller?</a></li>
        <?php endif; ?>
        <li><a href="contact.php" class="<?php echo $current_page == 'contact.php' ? 'active' : ''; ?>">Contact us</a></li>
        <li id="lg-bag"><a href="cart.php" class="<?php echo $current_page == 'cart.php' ? 'active' : ''; ?>"><i class="bi bi-bag-fill"></i></a></li>
        <?php else : ?>
            <li><a href="sellerview.php" class="<?php echo $current_page == 'sellerview.php' ? 'active' : ''; ?>">View</a></li>
        <li><a href="sellerdashboard.php" class="<?php echo $current_page == 'sellerdashboard.php' ? 'active' : ''; ?>">dashboard</a></li>
        <?php endif; ?>
        <!-- required by all the users; -->
        <li id="lg-person">
            <?php if (isset($_SESSION['user_id'])): ?>
            <a href="logout.php" class="<?php echo $current_page == 'logout.php' ? 'active' : ''; ?>"><i class="bi bi-person-dash-fill"></i></a></li>
            <?php else : ?>
            <a href="user_signuplogin.php" class="<?php echo $current_page == 'user_signuplogin.php' ? 'active' : ''; ?>"><i class="bi bi-person"></i></a></li>
            <?php endif; ?>
        <a href="#" id="close"> <i class="bi bi-x"></i></a>
    </ul>              
</div>
<div id="mobile">
    <i class="bi bi-bag"></i>
    <i id="bar" class="bi bi-list"></i>
</div>