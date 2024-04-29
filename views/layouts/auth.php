<?php use app\core\Application; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NurtureLife</title>
    <link rel="icon" type="image/x-icon" href="./assets/images/icons/favicon.png">
    <link rel="stylesheet" href="./assets/styles/styles.css">
    <link rel="stylesheet" href="./assets/styles/Form.css">

    <script>
        <?php
        $FlashMessage = Application::$app->session->getFlash('success');
        $ErrorFlashMessage = Application::$app->session->getFlash('error');

        if ($FlashMessage) {
            echo "window.onload = function() { showSuccessToast('$FlashMessage', 'success'); };";
        }
        if ($ErrorFlashMessage) {
            echo "window.onload = function() { showErrorToast('$ErrorFlashMessage', 'error'); };";
        }
        ?>
    </script>
    <script src="./assets/scripts/toast.js"></script>
</head>
<body>
<div class="navbar" id="myNavbar">
    <div class="NL_logo_container">
        <img src="./assets/images/nurturelife_logo.png" class="NL_logo">
    </div>
    <a href="/">Home</a>
    <a href="/about">About</a>

    <div class="search-container">
        <input type="text" placeholder=" Search...">
        <button type="submit">Search</button>
    </div>

    <?php if (Application::isGuest()): ?>
        <a href="/login">Login</a>
        <a href="/register">Signup</a>
    <?php else: ?>

        <div class="dropdown">
            <button class="dropbtn"><?php echo Application::$app->user->getRoleName() ?>
                <i class="fa fa-caret-down"></i>
            </button>
            <form id="roleChangeForm" method="POST" action="/changeRole">
                <input type="hidden" name="role_id" id="selectedRoleInput" value="">
            </form>
            <div class="dropdown-content" id="dropdown-content">
                <!-- Roles will be displayed here -->
            </div>
        </div>

        <div class="action" id="actionElement">
            <div class="profile" onclick="menuToggle();">
                <img src="./assets/images/icons/woman.png" />
            </div>
            <div class="menu">
                <h3><?php echo Application::$app->user->getDisplayName() ?></h3>
                <ul>
                    <li>
                        <img src="./assets/images/icons/user.png" /><a href="#">My profile</a>
                    </li>
                    <li>
                        <img src="./assets/images/icons/settings.png" /><a href="#">Setting</a>
                    </li>
                    <li>
                        <img src="./assets/images/icons/log-out.png" /><a href="/logout">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
        <script>
            function menuToggle() {
                const toggleMenu = document.querySelector(".menu");
                toggleMenu.classList.toggle("active");
            }
        </script>
    <?php endif; ?>
    <div class="navbar_emg">
        Emergency Hotline<br>+94 71 977 3265
    </div>

</div>
<div class="wrapper" style="height: fit-content">
    <div class="userHome_content">
        {{content}}
    </div>
</div>

<div class="footer">
    <div class="brand">
        <div class="section_icon">
            <img src="assets/images/nurturelife_logo_text.jpeg" alt="NL_logo_text_icon" />
        </div>
        <div class="section_name"> ©  2024 NurtureLife</div>
    </div>
    <div class="section_privacy"><a href="/policy" target="_blank">Privacy and Policy</a></div>
    <div class="section_contact"><a href="/contact" target="_blank">Contact</a></div>
    <div class="section_docs"><a href="https://drive.google.com/drive/folders/1tgtXQ39kbaM37BUenEuEPqWDaJT-4DAa?usp=sharing" target="_blank">Docs</a></div>
    <div class="section_security"><a href="/policy" target="_blank">Security</a></div>
    <div class="section_about"><a href="/about" target="_blank">About</a></div>
</div>

</body>
</html>