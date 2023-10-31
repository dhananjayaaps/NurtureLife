<?php
/** @var $this app\core\view */

use app\models\User;

$this->title = 'Login';
?>

<?php
/** @var $model User **/
?>


<div class="content">
    <div class="column first-column">
        <div class="lineChart">
            Total Prnatal Mothers: 450
            <canvas id="lineChart"></canvas>
        </div>
        <div class="lineChart">
            Total Postnatal Mothers: 450
            <canvas id="lineChart2"></canvas>
        </div>
        <div class="lineChart">
            Total Babies: 200
            <canvas id="lineChart3"></canvas>
        </div>
    </div>
    <div class="column second-column">
        <div class="right-content" style="width:100%">
            <div class="shadowBox">
                <div class="clinic-details">
                    <h2>Next Clinic Details<br><br></h2>
                    <p>Date : Today</p>
                    <p>Day : Wednesday</p><br>
                    <p>Number of Mothers  : 3</p>
                    <p>Number of Midwives : 3</p><br>
                    <p>Midwives:</p>

                    <div class="myBox" style="height: 100px;">
                        <ul class="midwives-list">
                            <li>A.S.D. Achala</li>
                            <li>H.K.D. Sewwandi</li>
                            <li>S.U. Rathnayake</li>
                            <li>S.U. Rathnayake</li>
                            <li>S.U. Rathnayake</li>
                            <li>S.U. Rathnayake</li>
                            <li>S.U. Rathnayake</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="quick-access">
            <div class="user-control addButtons">
                <button class="addButton">Add a Clinic</button>
                <button class="addButton">Transfer a Doctor</button>
                <button class="addButton">Add a Doctor</button>
                <button class="addButton">Add a Midwife</button>
            </div>

            <div class="shadowBox">
                <div class="notification-bar">
                    <div class="notifications">
                        <span style="font-size: 20px; font-weight: bold;">Notifications</span>
                    </div>
                    <div class="myBox">
                        <div class="notification emergency">
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

