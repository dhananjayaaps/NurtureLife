<?php use app\core\Application; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=$this->title?></title>
    <link rel="icon" type="image/x-icon" href="./assets/images/icons/favicon.png">
    <link rel="stylesheet" href="./assets/styles/styles.css">
    <link rel="stylesheet" href="./assets/styles/volunteer.css">
</head>
<body>

<div class="navbar" id="myNavbar">
    <div class="NL_logo_container">
        <a href="/"><img src="./assets/images/nurturelife_logo.png" class="NL_logo" alt="NL_logo"></a>
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
            <button class="dropbtn"><?php echo Application::$app->user->getRoleName() ?> View
                <i class="fa fa-caret-down"></i>
            </button>
            <form id="roleChangeForm" method="POST" action="/changeRole">
                <input type="hidden" name="role_id" id="selectedRoleInput" value="">
            </form>
            <div class="dropdown-content" id="dropdown-content">
                <!-- Roles will be displayed here -->
            </div>
        </div>

        <div class="navbar_emg">
            <p>Emergency Hotline<br>+94 71 977 3265</p>
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

</div>

<div class="volunteer_wrapper">
    <div class="volunteer_content">
        {{content}}
    </div>
</div>

<div class="footer">
    <div class="footer-left">
        <div class="footer-left-title">
            <div class="brand-name">NurtureLife</div>
            <div class="year">&#183 &#160 2024</div>
        </div>
        <div class="footer-left-text">
            SUSTAINING LIFE THROUGH EMPOWERING MOTHERHOOD
        </div>
        <div class="policy">
            <a href="/policy">Privacy and Policy</a>
        </div>
    </div>

    <div class="footer-center">
        <div class="message">Made in 🇱🇰 with 💕</div>
        <div class="follow-us">FOLLOW US ON</div>
        <div class="social-media-icons">
            <div class="SM-icon-container">
                <img class="SM-icon" src="./assets/images/fb-logo.png" />
            </div>
            <div class="SM-icon-container">
                <img class="SM-icon" src="./assets/images/insta-logo.png" />
            </div>
            <div class="SM-icon-container">
                <img class="SM-icon" src="./assets/images/twitter-logo.png" />
            </div>
        </div>
    </div>

    <div class="footer-right">
        <div class="contact-us">Contact Us,</div>
        <div class="tel-no">Call Us : 077 123 4678</div>
        <div class="email">Email : admin.nurturelife@gmail.com</div>
    </div>
</div>


</body>
<script>
    const userRoles = <?php echo Application::$app->userRoles->getRoles()?>;
    const rolesNames = ["Normal User", "Volunteer", "Admin", "Doctor", "Prenatal mother", "Postnatal Mother", "Midwife"];

    const userRolesList = document.getElementById('dropdown-content');
    const roleChangeForm = document.getElementById('roleChangeForm');
    const selectedRoleInput = document.getElementById('selectedRoleInput');

    userRoles.forEach((role) => {
        const anchor = document.createElement('a');
        anchor.textContent = rolesNames[role];
        anchor.setAttribute('data-role', role);
        userRolesList.appendChild(anchor);

        anchor.addEventListener('click', (event) => {
            event.preventDefault();
            const selectedRole = event.target.getAttribute('data-role');
            console.log("Role is", selectedRole);

            selectedRoleInput.value = selectedRole;

            roleChangeForm.submit();
        });
    });
    console.log(userRoles);
    console.log(rolesNames);

</script>
</html>
