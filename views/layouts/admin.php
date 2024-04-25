<?php use app\core\Application; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=$this->title?></title>
    <link rel="icon" type="image/x-icon" href="./assets/images/icons/favicon.png">
    <link rel="stylesheet" href="./assets/styles/styles.css">
    <link rel="stylesheet" href="./assets/styles/admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-beta.1/css/select2.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-beta.1/js/select2.min.js"></script>

</head>
<body>

<div class="navbar" id="myNavbar">
    <div class="NL_logo_container">
        <img src="./assets/images/nurturelife_logo.png" class="NL_logo">
    </div>
    <a href="/">Home</a>
    <a href="/about">About</a>

    <div class="search-container">
        <input type="text" placeholder="Search...">
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
                <img src="./assets/images/men_user.jpg" />
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

<div class="content-navbar">
    <div class="wrapper">
        <div class="left-navbar">
            <div class="navigations">
                <div class="column">
                    <a href="/"><img src="assets/images/icons/home.png" alt="">Home</a>
                </div>
                <div class="column">
                    <a href="/clinics"><img src="assets/images/icons/clinic.png" alt="">Clinics</a>
                </div>
                <div class="column">
                    <a href="/reports"><img src="assets/images/icons/report.png" alt="">Reports</a>
                </div>
                <div class="column">
                    <a href="/doctors"><img src="assets/images/icons/doctor.png" alt="">Doctors</a>
                </div>
                <div class="column">
                    <a href="/midwife"><img src="assets/images/icons/nurse.png" alt="">MidWives</a>
                </div>
                <div class="column">
                    <a href="/preMother"><img src="assets/images/icons/pregnant.png" alt="">Prenatal Mothers</a>
                </div>
                <div class="column">
                    <a href="/postMother"><img src="assets/images/icons/care.png" alt="">Postnatal Mothers</a>
                </div>
                <div class="column">
                    <a href="/users"><img src="assets/images/icons/user.png" alt="">Users</a>
                </div>
            </div>
        </div>

        <div class="content">
            {{content}}
        </div>
    </div>
</div>
<!--footer-->
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
        <div class="follow-us">follow us on</div>
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
        <div class="contact-us"><a href="/contact" style="color: white">Contact us</a></div>
        <div class="tel-no">Call Us : 077 123 4678</div>
        <div class="email">Email : admin.nurturelife@gmail.com</div>
    </div>
</div>
</body>
</html>

<script>
    function myFunction() {
        document.getElementById("myDropdown").classList.toggle("show");
    }

    window.onclick = function(event) {
        if (!event.target.matches('.dropbtn')) {
            var dropdowns = document.getElementsByClassName("dropdown-content");
            var i;
            for (i = 0; i < dropdowns.length; i++) {
                var openDropdown = dropdowns[i];
                if (openDropdown.classList.contains('show')) {
                    openDropdown.classList.remove('show');
                }
            }
        }
    }
</script>

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
</script>