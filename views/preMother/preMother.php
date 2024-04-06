<?php
/** @var $this app\core\view */

use app\models\User;

$this->title = 'preMother Dashboard';
?>
<link rel="stylesheet" href="./assets/styles/mother.css">


<?php
/** @var $model User **/
?>

<div class="content">
    <div class="column first-column">
        <div class="quick-access">
            <div class="user-control addButtons">

                <button class="addButton">SOS Emergency</button>
            </div>
            <div>
            <div class="user-control addButtons">

                <button class="addButton">Report Symptoms</button>
                <button class="addButton">View Reports</button>
                <button class="addButton">View Schedules</button>
            </div>
            <div class="user-control addButtons">

                <button class="addButton">Nutrition Guidelines</button>
                <button class="addButton">Communicate to  Officers</button>
                <button class="addButton">Record Fetalkicks</button>
            </div>
            </div>

        </div>

    </div>
    <div class="column second-column">

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
        <div>
            Mother's appointments Calender
        </div>

    </div>
</div>
