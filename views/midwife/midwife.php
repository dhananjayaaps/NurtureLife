<?php
/** @var $this app\core\view */

use app\models\User;

$this->title = 'Midwife Dashboard';
?>

<style>
    .content{
        margin-top: 0;
        padding-top: 0;
    }

    .content .shadowBox{
        height: 40vh;
        margin-top: 15px;
    }
</style>

<div class="content">
    <div class="column first-column">
        <div class="lineChart">
            Total Mothers: 450
            <canvas id="lineChart"></canvas>
        </div>
        <div class="lineChart">
            Total Borns: 450
            <canvas id="lineChart2"></canvas>
        </div>
        <div class="lineChart">
            Total Registrations: 450
            <canvas id="lineChart3"></canvas>
        </div>
    </div>
    <div class="column second-column">
        <div class="user-control">
            User Distribution
            <canvas id="myPieChart" width="300" height="300"></canvas>
        </div>

        <div class="quick-access">
            <div class="user-control addButtons">

                <button class="addButton">Register a Mother</button>
                <button class="addButton">View Mother</button>
                <button class="addButton">Record Pregnancy Report Card</button>
                <button class="addButton">Track Mother</button>
            </div>
            <div class="user-control addButtons">

                <button class="addButton">Register a child</button>
                <button class="addButton">Record baby card </button>
                <button class="addButton">View field Schedule</button>
                <button class="addButton">View clinic schedule</button>

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
                                Pressed the Emergency Elarm by Kamala Wijethunga
                            </div>
                        </div>
                    </div>

                    <div class="notification">
                        <div class="message-box">
                            <div class="title">Emergency Alert</div>
                            <div class="notification-content">
                                Pressed the Emergency Elarm by Kamala Wijethunga
                            </div>
                        </div>
                    </div>

                    <div class="notification warning">
                        <div class="message-box">
                            <div class="title">Emergency Allert</div>
                            <div class="notification-content">
                                Pressed the Emergency Elarm by Kamala Wijethunga
                            </div>
                        </div>
                    </div>

                    <div class="notification">
                        <div class="message-box">
                            <div class="title">Emergency Allert</div>
                            <div class="notification-content">
                                Pressed the Emergency Elarm by Kamala Wijethunga
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
    // Sample data for the line chart
    var data = {
        labels: ["January", "February", "March", "April", "May"],
        datasets: [{
            label: "Daily New Borns",
            borderColor: "#1F2B6C",
            backgroundColor: "rgba(75, 192, 192, 0.2)",
            data: [65, 59, 80, 81, 56]
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
        data: data,
        options: options
    });

    var ctx = document.getElementById('lineChart2').getContext('2d');
    var myLineChart = new Chart(ctx, {
        type: 'line',
        data: data,
        options: options
    });

    var ctx = document.getElementById('lineChart3').getContext('2d');
    var myLineChart = new Chart(ctx, {
        type: 'line',
        data: data,
        options: options
    });

    var ctxDoughnut = document.getElementById('myPieChart').getContext('2d');

    var dataDoughnut = {
        labels: ['Volunteers', 'Doctors', 'Midwives', 'Prenatal Mothers', 'Postnatal Mothers'],
        datasets: [{
            data: [20, 15, 10, 30, 25],
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

    var optionsDoughnut = {
        responsive: false,
    };

    var myDoughnutChart = new Chart(ctxDoughnut, {
        type: 'pie', //
        data: dataDoughnut,
        options: optionsDoughnut
    });

</script>


<?php
/** @var $model User **/
?>



