<?php use app\core\Application; ?>

var_dump(Application::$app->user);

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./assets/styles/styles.css">
</head>
<body>
<div class="headbar">
    <img src="../assets/images/nuturelife_logo.png" alt="nuturelife_logo">

    <div class="largeIcons">
        <img src="../assets/images/Group 188.svg" alt="phone">
        <div class="emrgency">Emergency<br/>+94 71 307 8728</div>
        <img src="../assets/images/Group 177.svg" alt="clock">24x7 Service
    </div>
</div>

<div class="navbar">
    <a href=" ">Home</a>
    <a href="#about">About</a>
    <a href="#services">Services</a>
    <a href="contact">Contact</a>

    <div class="search-container">
        <input type="text" placeholder="Search...">
        <button type="submit">Search</button>
    </div>

    <?php if (Application::isGuest()): ?>

    <a href="#login">Login</a>
    <a href="register">Signup</a>

    <?php else: ?>

    <a href="/logout">Welcome <?php echo Application::$app->user->getDisplayName() ?>
        (Logout)
    </a>

    <?php endif; ?>

</div>

<div class="container">
    <?php if (Application::$app->session->getFlash('success')): ?>
        <div class="alert alert-success">
           <?php echo Application::$app->session->getFlash('success')?>
        </div>
    <?php endif ?>
    {{content}}
</div>


<div class="footer">
    <div class="leftmost">
        <div class="name-title">NUTURELIFE</div>
        <div class="smalltext">SUSTAINING LIFE THROUGH<br>MOTHERHOOD</div>
    </div>
    <div class="important-links">
        <div class="footer-heading">Important Links</div>
        <div class="footer-content">
            <a href="#Appointment"> Resources and Books</a><br/>
            Doctors<br/>
            Services<br/>
            About Us
        </div>
    </div>
    <div class="Contact-us">
        <div class="footer-heading">Contact Us</div>
        <div class="footer-content">
            Call: (+94) 713078918
        </div>
    </div>
</div>

</body>
</html>