<?php use app\core\Application; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NurtureLife</title>
    <link rel="stylesheet" href="./assets/styles/styles.css">
    <link rel="stylesheet" href="./assets/styles/admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dat-gui/0.7.7/dat.gui.min.js"></script>
</head>
<body>

<!--<div class="headBar">-->
<!--    <img src="../assets/images/nuturelife_logo.png" alt="nuturelife_logo">-->
<!--    <div class="largeIcons">-->
<!--        <img src="../assets/images/Group 188.svg" alt="phone">-->
<!--        <div class="emrgency">Emergency<br/>+94 71 123 4567</div>-->
<!--        <img src="../assets/images/Group 177.svg" alt="clock">24x7 Service-->
<!--    </div>-->
<!--</div>-->

<div class="navbar" id="myNavbar">
    <img class="NL_logo" src="../assets/images/nuturelife_logo.png" alt="nuturelife_logo">
    <a href="/">Home</a>
    <a href="#about">About</a>

    <div class="search-container">
        <div>
            <input class="search-input" type="text" placeholder="Search">
        </div>
        <div>
            <button class="search-button" type="submit">Search</button>
        </div>
    </div>

    <?php if (Application::isGuest()): ?>
        <a href="/login">Login</a>
        <a href="/register">Signup</a>
    <?php else: ?>

        <div class="dropdown">
            <button class="dropButton"><?php echo Application::$app->user->getRoleName() ?> View
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


    {{content}}
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

<!--<div id="container">-->
<!--    <canvas id="lines-demo"></canvas>-->
<!--</div>-->

<script>
    window.onscroll = function() {BarOverflow()};

    const navbar = document.getElementById("myNavbar");
    const sticky = navbar.offsetTop;
    const actionElement = document.getElementById("actionElement");

    function BarOverflow() {
        if (window.pageYOffset > sticky) {
            navbar.classList.add("sticky");
            actionElement.style.top = "10px";
        } else {
            navbar.classList.remove("sticky");
            actionElement.style.top = "90px";
        }
    }
</script>

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
    const rolesNames = ["Normal User", "Volunteer", "Admin", "Doctor", "Midwife", "Mother"];

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

<script>
    function randomInRange(min, max) {
        return min + (max - min) * Math.random();
    }

    var LinkedParticles = function (ctx) {
        var that = this;

        that.ctx = ctx;
        that.points = [];
        that.currentCursorPosition = { x: 0, y: 0 };

        // Background settings
        that.transparent_background = true;
        that.background_color = '#140328';

        // Points settings
        that.points_count = 150;
        that.point_color = '#8367ef';
        that.point_size = 1.5;

        // Motion settings
        that.velocity_ratio = 1;
        that.velocity_decay = 0.8;
        that.gravity = 0;
        that.bounce = 1;

        // Lines settings
        that.line_width = 0.2;
        that.line_distance = 45;
        that.lines_color = '#5a19f9';
        that.lines_gradient_enabled = false;
        that.lines_gradient_start_color = '#ffa700';
        that.lines_gradient_middle_color = '#f00f0f';
        that.lines_gradient_end_color = '#ff00ff';

        that.ctx.lineCap = 'round';

        that.init = function () {
            // Initialize points positions
            that.points = [];
            for (var i = 0; i < that.points_count; i++) {
                that.points[i] = {
                    mass: 50,
                    x: randomInRange(5, that.ctx.canvas.width - 5),
                    y: randomInRange(5, that.ctx.canvas.height - 5),
                    vx: randomInRange(-1, 1),
                    vy: randomInRange(-1, 1),
                    ax: 0,
                    ay: 0
                };
            }
        };

        that.update = function () {
            // Apply force point if enabled
            that.forcePoint();

            // Update position with velocity and gravity for every point
            for (var i = 0; i < that.points.length; i++) {
                var pt = that.points[i];
                pt.ax *= 0.1;
                pt.vx += pt.ax * that.velocity_ratio * that.velocity_decay;
                pt.x += pt.vx;

                pt.ay *= 0.1;
                pt.vy += (pt.ay + that.gravity) * that.velocity_ratio * that.velocity_decay;
                pt.y += pt.vy;

                // Collide using canvas box
                if (pt.x > that.ctx.canvas.width - that.point_size) {
                    pt.x = that.ctx.canvas.width - that.point_size;
                    pt.vx = -pt.vx * that.bounce;
                }
                if (pt.x < that.point_size) {
                    pt.x = that.point_size;
                    pt.vx = -pt.vx * that.bounce;
                }

                if (pt.y > that.ctx.canvas.height - that.point_size) {
                    pt.y = that.ctx.canvas.height - that.point_size;
                    pt.vy = -pt.vy * that.bounce;
                }

                if (pt.y < that.point_size) {
                    pt.y = that.point_size;
                    pt.vy = -pt.vy * that.bounce;
                }
            }
        };

        that.draw = function () {
            that.ctx.clearRect(0, 0, that.ctx.canvas.width, that.ctx.canvas.height);
            if (!that.transparent_background) {
                that.ctx.fillStyle = that.background_color;
                that.ctx.fillRect(0, 0, that.ctx.canvas.width, that.ctx.canvas.height);
            }

            that.ctx.lineWidth = that.line_width;
            for (var i = 0; i < that.points.length; i++) {
                var pt = that.points[i];

                // Draw lines between points
                for (var j = that.points.length - 1; j > i; j--) {
                    if (i === j) continue;

                    var pt2 = that.points[j];

                    if (Math.abs(pt2.x - pt.x) <= that.line_distance && Math.abs(pt2.y - pt.y) <= that.line_distance) {
                        if (that.lines_gradient_enabled) {
                            var gradient = ctx.createLinearGradient(pt.x, pt.y, pt2.x, pt2.y);
                            gradient.addColorStop(0, that.lines_gradient_start_color);
                            gradient.addColorStop(0.5, that.lines_gradient_middle_color);
                            gradient.addColorStop(1, that.lines_gradient_end_color);
                            that.ctx.strokeStyle = gradient;
                        } else {
                            that.ctx.strokeStyle = that.lines_color;
                        }
                        that.ctx.beginPath();
                        that.ctx.moveTo(pt.x, pt.y);
                        that.ctx.lineTo(pt2.x, pt2.y);
                        that.ctx.stroke();
                        that.ctx.closePath();
                    }
                }
            }

            // Draw points
            for (i = 0; i < that.points.length; i++) {
                pt = that.points[i];
                that.ctx.fillStyle = that.point_color;
                that.ctx.beginPath();
                that.ctx.arc(pt.x, pt.y, that.point_size, 0, 2 * Math.PI);
                that.ctx.fill();
                that.ctx.closePath();
            }
        };

        that.forcePoint = function () {
            if (!that.force_point_enabled) return;

            for (var i = 0; i < that.points.length; i++) {
                var pt = that.points[i];

                var dx = that.currentCursorPosition.x - pt.x;
                var dy = that.currentCursorPosition.x - pt.y;
                var d = Math.hypot(dx, dy);
                var ang = Math.atan2(dy, dx);

                if (d < 100) {
                    pt.ax = 0.5 * d * Math.cos(ang);
                    pt.ay = 0.5 * d * Math.sin(ang);
                }
            }
        };

        // Attach events
        that.onresize = function () {
            that.ctx.canvas.width = window.innerWidth;
            that.ctx.canvas.height = window.innerHeight;
        };

        window.addEventListener('resize', that.onresize, false);

        that.ctx.canvas.addEventListener('mousemove', function (e) {
            that.currentCursorPosition.x = e.x;
            that.currentCursorPosition.y = e.y;
        });

        // Initialize canvas size
        that.onresize();
        // Initialize points
        that.init();
    };

    document.addEventListener("DOMContentLoaded", function (event) {
        var canvas = document.getElementById('lines-demo');
        var ctx = canvas.getContext('2d');

        ctx.scale(2, 2);

        var lp = new LinkedParticles(ctx);

        function loop(nextTime) {
            lp.update();
            lp.draw();
            requestAnimationFrame(loop);
        }

        // Start animation loop
        requestAnimationFrame(loop);
    });

    function resizeCanvas() {
        const canvas = document.getElementById("lines-demo");
        canvas.width = window.innerWidth;
        canvas.height = window.innerHeight;
    }

    window.addEventListener("resize", resizeCanvas);
    resizeCanvas();
</script>

