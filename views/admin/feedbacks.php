<?php
/** @var $this app\core\view */

use app\core\Application;
use app\models\Feedback;
use app\models\LoginModel;
use app\models\Post;
use app\models\RoleRequest;
use app\models\User;

$this->title = 'User Feedbacks';

/** @var $model Feedback **/
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
<h1>Feedbacks from users</h1>

<!--feedback container-->
<div class="shadowBox" style="height: fit-content; width: 600px; align-self: center">
    <div class="notification-bar" style="height: 500px; border-radius: 20px">
        <div class="scrollable-container" style="max-height: 500px; overflow-y: auto">
            <?php
            $feedbacks = json_decode($model->getFeedbacks());
            foreach ($feedbacks as $feedback) {
                ?>
                <div class="myBox" id="myBox" style="height: fit-content; width: fit-content">
                    <div class="notification emergency">
                        <div class="message-box" style="height: fit-content; width: 450px">
                            <div class="title">Feedback ID = <?= $feedback->id ?></div>
                            <div class="notification-content">
                                <h3>User email - <?=$feedback->email?></h3>
                                <b>Message - <?= $feedback->feedback ?></b><br>
                            </div>
                            <div class="notification-footer">
                                <div class="dates">
                                    <span class="created-date">Created: <?= $feedback->created_at ?></span><br>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
            }
            ?>
        </div>
    </div>
</div>