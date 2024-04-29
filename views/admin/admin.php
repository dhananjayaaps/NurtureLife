<?php
/** @var $this app\core\view */

use app\models\Child;
use app\models\Mother;
use app\models\User;

$this->title = 'Admin Dashboard';
?>
<style>
    .content .shadowBox{
        height: 40vh;
        margin-top: 15px;
    }
    .quick-access{
        align-items: center;
    }
    .two-rows{
        display: flex;
        flex-direction: column;
        gap: 30px;
        justify-content: space-between;

    }
    a{
        text-decoration: none;
        color: white;
    }
</style>
<h1>Admin Dashboard</h1>
<div class="two-rows">
    <div class="column first-column">
        <div class="lineChart">
            Mother Registrations
            <canvas id="lineChart"></canvas>
        </div>
        <div class="lineChart">
            Child Registrations
            <canvas id="lineChart2"></canvas>
        </div>
        <div class="lineChart">
            User Registrations
            <canvas id="lineChart3"></canvas>
        </div>
    </div>
    <div class="column second-column">
        <div class="user-control">
            User Distribution
            <canvas id="myBarChart" width="300" height="300"></canvas>
        </div>
        <div class="quick-access">
            <div class="user-control addButtons">
                <button class="addButton"><a href="/motherRegistrations">Mother Registrations</a></button>
                <button class="addButton"><a href="/users">Restrict a User</a></button>
            </div>
            <div class="user-control addButtons">
                <button class="addButton"><a href="/childBorn">Child Registrations</a></button>

                <button class="addButton"><a href="/ManageAdmins">Add an Admin</a></button>
            </div>
        </div>

        <div class="shadowBox">
            <div class="notification-bar">
                <div class="notifications">
                    <span style="font-size: 20px; font-weight: bold;">Notifications</span>
                </div>
                <div class="myBox">
                    <div class="notification emergency">
                        <div class="message-box">
                            <div class="title">Emergency Alert</div>
                            <div class="notification-content">
                                Pressed the Emergency Alarm by Kamala Wijethunga
                            </div>
                        </div>
                    </div>

                    <div class="notification">
                        <div class="message-box">
                            <div class="title">Emergency Alert</div>
                            <div class="notification-content">
                                Pressed the Emergency Alarm by Kamala Wijethunga
                            </div>
                        </div>
                    </div>

                    <div class="notification warning">
                        <div class="message-box">
                            <div class="title">Emergency Alert</div>
                            <div class="notification-content">
                                Pressed the Emergency Alarm by Kamala Wijethunga
                            </div>
                        </div>
                    </div>

                    <div class="notification">
                        <div class="message-box">
                            <div class="title">Emergency Alert</div>
                            <div class="notification-content">
                                Pressed the Emergency Alarm by Kamala Wijethunga
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<!--Scripts for the chart development. That is hardcoded-->

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    var dataarrayMother = <?php echo (new Mother)->getMotherCountForAdmin() ?>;
    var dataarrayChild = <?php echo (new Child)->getChildCountForAdmin() ?>;
    var dataarrayUser = <?php echo (new User)->getUsersCountForAdmin() ?>;
    var dataDistribution = <?php echo (new User)->getUsersCountForAdminByRole() ?>;

    var dataMother = {
        labels: ["November","December","January", "February", "March", "April"],
        datasets: [{
            label: "New Borns",
            borderColor: "#1F2B6C",
            backgroundColor: "rgba(75, 192, 192, 0.2)",
            data: dataarrayMother
        }]
    };

    var dataChild = {
        labels: ["November","December","January", "February", "March", "April"],
        datasets: [{
            label: "New Borns",
            borderColor: "#1F2B6C",
            backgroundColor: "rgba(75, 192, 192, 0.2)",
            data: dataarrayChild
        }]
    };

    var dataUser = {
        labels: ["November","December","January", "February", "March", "April"],
        datasets: [{
            label: "New Borns",
            borderColor: "#1F2B6C",
            backgroundColor: "rgba(75, 192, 192, 0.2)",
            data: dataarrayUser
        }]
    };

    var options = {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    };

    var ctx = document.getElementById('lineChart').getContext('2d');
    var myLineChart = new Chart(ctx, {
        type: 'line',
        data: dataMother,
        options: options
    });

    var ctx = document.getElementById('lineChart2').getContext('2d');
    var myLineChart = new Chart(ctx, {
        type: 'line',
        data: dataChild,
        options: options
    });

    var ctx = document.getElementById('lineChart3').getContext('2d');
    var myLineChart = new Chart(ctx, {
        type: 'line',
        data: dataUser,
        options: options
    });

    var ctxBar = document.getElementById('myBarChart').getContext('2d');

    var dataBar = {
        labels: ['Volunteers', 'Admin', 'Doctor', 'Prenatal Mothers','MidWife'],
        datasets: [{
            label: 'Number of Individuals',
            data: dataDistribution,
            backgroundColor: [
                'rgba(255, 99, 132, 0.5)',
                'rgba(54, 162, 235, 0.5)',
                'rgba(255, 206, 86, 0.5)',
                'rgba(75, 192, 192, 0.5)',
                'rgba(153, 102, 255, 0.5)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)'
            ],
            borderWidth: 1
        }]
    };

    var optionsBar = {
        responsive: false,
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    };

    var myBarChart = new Chart(ctxBar, {
        type: 'bar',
        data: dataBar,
        options: optionsBar
    });


</script>