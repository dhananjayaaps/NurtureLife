<?php
    /** @var $this app\core\view */

use app\models\User;

$this->title = 'Profile';
?>
<h1>Profile</h1>

<?php
/** @var $model User **/
?>
<h1>User Profile</h1>
<div class="column-container">
    <div class="left-container">
        <div class="profile-image">
            <img src="https://www.w3schools.com/howto/img_avatar.png" alt="Avatar" class="avatar" style="height: 100px">
        </div>

    </div>
    <div class="right-container">
        <div class="profile-details">
            <h3>First Name: <?php echo $model->firstname?></h3>
            <h3>Last Name: <?php echo $model->lastname?></h3>
            <h3>Email: <?php echo $model->email?></h3>
        </div>
    </div>
</div>

