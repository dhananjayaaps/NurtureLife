<?php use app\core\Application; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
<!--    <link rel="stylesheet" href="./assets/styles/styles.css">-->
    <link rel="stylesheet" href="./assets/styles/admin.css">
</head>
<body>

<div class="navbar">
    <a href=" ">Home</a>
    <a href="#about">About</a>

    <div class="search-container">
        <input type="text" placeholder="Search...">
        <button type="submit">Search</button>
    </div>

    <?php if (Application::isGuest()): ?>
        <a href="/login">Login</a>
        <a href="/register">Signup</a>
    <?php else: ?>
        <a href="/logout">Welcome <?php echo Application::$app->user->getDisplayName() ?>
            (Logout)
        </a>
        <a href="/profile">Profile</a>
    <?php endif; ?>

</div>

<div class="content-navbar">
    <div class="left-navbar">
        <img src="./assets/images/nuturelife_logo.png" alt="nuturelife_logo">
        <div class="navigations">
            <div class="column">
                <a href="/"><img src="assets/images/icons/home.png" alt=""> Home</a>
            </div>
            <div class="column">
                <a href="/clinics"><img src="assets/images/icons/clinic.png" alt=""> Clinics</a>
            </div>
            <div class="column">
                <a href="#"><img src="assets/images/icons/report.png" alt=""> Get Reports</a>
            </div>
            <div class="column">
                <a href="#"><img src="assets/images/icons/doctor.png" alt=""> Doctors</a>
            </div>
            <div class="column">
                <a href="#"><img src="assets/images/icons/nurse.png" alt=""> MidWives</a>
            </div>
            <div class="column">
                <a href="#"><img src="assets/images/icons/pregnant.png" alt=""> Prenatal Mothers</a>
            </div>
            <div class="column">
                <a href="#"><img src="assets/images/icons/care.png" alt=""> Postnatal Mothers</a>
            </div>
            <div class="column">
                <a href="#"><img src="assets/images/icons/user.png" alt=""> Users</a>
            </div>
        </div>
    </div>
    {{content}}
</div>


