<?php use app\core\Application; ?>
<?php use app\models\Mother; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=$this->title?></title>
    <link rel="icon" type="image/x-icon" href="./assets/images/icons/favicon.png">
    <link rel="stylesheet" href="./assets/styles/admin.css">

    <link rel="stylesheet" href="./assets/styles/styles.css">
    <link rel="stylesheet" href="./assets/styles/content.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-beta.1/css/select2.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-beta.1/js/select2.min.js"></script>
    <link rel="stylesheet" href="./assets/styles/slidebarStyle.css" />
    <link href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

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

        <script>
            function menuToggle() {
                const toggleMenu = document.querySelector(".menu");
                toggleMenu.classList.toggle("active");
            }
        </script>
    <?php endif; ?>

</div>

<div class="content-navbar">
    <div class="wrapper" style="height: fit-content">
        <div class="sidebar">
            <div class="logo-details">
                <div class="logo_name">NurtureLife</div>
                <i class="bx bx-menu" id="btn"></i>
            </div>
            <ul class="nav-list">
                <br><br>
                <li>
                    <a href="/">
                        <i class="bx bx-grid-alt"></i>
                        <span class="links_name">Dashboard</span>
                    </a>
                    <span class="tooltip">Dashboard</span>
                </li>
                <li>
                    <a href="/MotherSymptoms">
                        <i class="bx bx-capsule"></i>
                        <span class="links_name">Report Symptoms</span>
                    </a>
                    <span class="tooltip">Report Symptoms</span>
                </li>
                <li>
                    <a href="/articles">
                        <i class="bx bx-book-open"></i>
                        <span class="links_name">Articles</span>
                    </a>
                    <span class="tooltip">Articles</span>
                </li>
                <li>
                    <a href="/nutrition">
                        <i class="bx bx-dish"></i>
                        <span class="links_name">Nutrition</span>
                    </a>
                    <span class="tooltip">Nutrition</span>
                </li>
                <li>
                    <a href="/fetalkick">
                        <i class="bx bx-face"></i>
                        <span class="links_name">Report Fetal Kick</span>
                    </a>
                    <span class="tooltip">Report Fetal Kick</span>
                </li>
                <li>
                    <a href="/posts">
                        <i class="bx bx-message-dots"></i>
                        <span class="links_name">Posts</span>
                    </a>
                    <span class="tooltip">Posts</span>
                </li>
                <li>
                    <a href="/posts">
                        <i class="bx bx-phone"></i>
                        <span class="links_name">Contact Midwife</span>
                    </a>
                    <span class="tooltip">Contact Midwife</span>
                </li>
                <li class="profile">
                    <div class="profile-details">
                        <img src="./assets/images/men_user.jpg" alt="profileImg" />
                        <div class="name_job">
                            <div class="name"><?php echo Application::$app->user->getDisplayName() ?></div>
                            <div class="job"><?php echo Application::$app->user->getRoleName() ?></div>
                        </div>
                    </div>
                    <a href="/logout"><i class="bx bx-log-out" id="log_out"></i></a>
                </li>
            </ul>
        </div>
        <div class="content">
            {{content}}
        </div>
    </div>
</div>
<!--footer-->
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

<script src="./assets/scripts/slidebar.js"></script>

<script>
    var DeliveryDate = <?php echo (new Mother())->getDeliveryDate() ?>;
    console.log(DeliveryDate)
    var today = new Date();
    var RemainingTime = new Date(DeliveryDate) - today;
    console.log(RemainingTime)
    const fetalLinks = document.querySelectorAll('a[href="/fetalkick"]');
    fetalLinks.forEach(link => {
        link.addEventListener("click", function(event) {
            // Prevent the default behavior of the link
            event.preventDefault();

            if (RemainingTime < 1000*60*60*24*30*7) {
                // If so, navigate to the link
               window.location.href = link.href;
           } else {
                // If not, display an alert
                const popupFetal = document.getElementById("popupFetal");

                popupFetal.innerHTML = `
               <div class="popup-content">

                    <h3>Fetalkick reporting will be enabled only after the 28th week (7 months) of pregnancy</h3>
                    <span class="close" id="close-popupFetal">&times;</span>
                </div>
                `;
                popupFetal.style.display = "block";
            }
            document.addEventListener("click", function(event) {
                if (event.target && event.target.id === "close-popupFetal") {
                    document.getElementById("popupFetal").style.display = "none";
               }
            });
        });
    });
</script>