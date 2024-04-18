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
</head>
<body>

<div class="navbar">
    <a href=" ">Home</a>
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

        <div class="action">
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

<div class="content-navbar">
    <div class="left-navbar">
        <img class="NL_logo" src="./assets/images/nuturelife_logo.png" alt="nuturelife_logo">
        <div class="navigations">
            <div class="column">
                <a href="/"><img src="assets/images/icons/home.png" alt=""> Home</a>
            </div>
            <div class="column">
                <a href="#"><img src="assets/images/icons/clinic.png" alt=""> Report Symptoms</a>
            </div>
            <div class="column">
                <a href="#"><img src="assets/images/icons/pregnant.png" alt=""> Reports</a>
            </div>
            <div class="column">
                <a href="#"><img src="assets/images/icons/pregnant.png" alt=""> Calender</a>
            </div>
            <div class="column">
                <a href="#"><img src="assets/images/icons/pregnant.png" alt=""> Nutritions</a>
            </div>
            <div class="column">
                <a href="#"><img src="assets/images/icons/pregnant.png" alt=""> Communication</a>
            </div>
            <div class="column">
                <a href="/fetalkick"><img src="assets/images/icons/pregnant.png" alt=""> Report Fetal kicks</a>
            </div>

        </div>
    </div>
    {{content}}
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