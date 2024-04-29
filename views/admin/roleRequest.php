<?php
/** @var $this app\core\view */

use app\core\Application;
use app\models\LoginModel;
use app\models\Post;
use app\models\RoleRequest;
use app\models\User;

$this->title = 'Admin';

/** @var $model RoleRequest **/
?>
<style>
    .content {
        display: flex;
        flex-direction: column;
        justify-content: center;
        /*background-color: #6652a4;*/
    }
</style>
<link rel="stylesheet" href="assets/css/styles.css">
<h1>Role Requests from users</h1>

<!--posts container-->
<div class="shadowBox" style="height: fit-content; width: 500px;align-self: center">
    <div class="notification-bar" style="height: 400px; border-radius: 20px">
        <div class="scrollable-container" style="max-height: 500px; overflow-y: auto">
            <?php
            $roleRequests = json_decode($model->getRoleRequests());
            foreach ($roleRequests as $roleRequest) {
                // Check if status is 0 or 1
                if ($roleRequest->status === 0 || $roleRequest->status === 1) {
                    ?>
                    <div class="myBox" id="myBox" style=" height: fit-content; width: fit-content">
                        <div class="notification emergency">
                            <div class="message-box" style="; height: fit-content;width: 380px">
                                <div class="title"><?=$roleRequest->name?> ⚬ Volunteer</div>
                                <div class="notification-content">
                                    <h3>Requested User Role - <?=ucfirst($roleRequest->requested_role)?></h3>
                                    <b>User ID - <?=$roleRequest->user_id?></b><br>
                                    <b>NIC No. - <?=$roleRequest->nic?></b><br>
                                    <b>SLMC Registration No. - <?=$roleRequest->SLMC_no?></b><br>
                                </div>
                                <div class="notification-footer">
                                    <div class="dates">
                                        <span class="created-date">Created: <?=$roleRequest->created_at?></span><br>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                }
            }
            ?>
        </div>

    </div>
</div>