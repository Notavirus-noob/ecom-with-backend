
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
    <section id="contact-details" class="section_p1">
        <div class="details">
            <span>GET IN TOUCH</span>
            <h2>Visit one of our agency locations or contact us today.</h2>
            <h3>Head Office</h3>
            <div>
                <li>
                    <i class="bi bi-map"></i>
                <p>New Road BishalBazar Kathmandu Nepal</p>
            </li>
            <li>
                <i class="bi bi-envelope-at"></i>
                <p>carafashion@gmail.com</p>
            </li>
            <li>
                <i class="bi bi-telephone-fill"></i>
                <p>01-4330000  +977-9800000000</p>
            </li>
            <li>
                <i class="bi bi-clock"></i>
                <p>8:00am to 7:00pm, all week</p>
            </li>
            </div>
        </div>
        <div class="map">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d14129.702378262235!2d85.30958260957782!3d27.704142942597038!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39eb1855ed14f2ef%3A0x4f0c32c8749bbfc6!2sBishal%20Bazar%2C%20Kathmandu%2044600!5e0!3m2!1sen!2snp!4v1712392866711!5m2!1sen!2snp" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe> 
        </div>
    </section>
    
    <section id="form-details">
        <form action="">
            <span>LEAVE A MESSAGE</span>
            <h2>We love to hear from you</h2>
            <input type="text" placeholder="Name">
            <input type="email" placeholder="Email">
            <input type="text" placeholder="Subject">
            <textarea name="message" id="" cols="30" rows="10" placeholder="Your Message"></textarea>
            <button class="normal">Submit</button>
        </form>
        <div class="people">
            <div>
                <img src="img/people/1.png" alt="">
                <p><span>John Doe</span> Senior Marketing Manager <br> Phone: +977 985000000 <br>Email: JonhDoe@gmail.com</p>
            </div>
            <div>
                <img src="img/people/2.png" alt="">
                <p><span>William Smith</span> Senior Marketing Manager <br> Phone: +977 985000000 <br>Email: WilliamSmith@gmail.com</p>
            </div>
            <div>
                <img src="img/people/3.png" alt="">
                <p><span>Ema Stone</span> Senior Marketing Manager <br> Phone: +977 985000000 <br>Email: EmaStone@gmail.com</p>
            </div>
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