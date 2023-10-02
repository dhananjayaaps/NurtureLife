<?php
    /** @var $this app\core\view */

use app\models\User;

$this->title = 'Profile';
?>
<h1>Profile</h1>

<?php
/** @var $model User **/
?>

<div class="form-container">
    <h2>Edit Profile</h2>
    <?php $form = \app\core\form\Form::begin('', "post")?>
    <?php echo $form->field($model, 'firstname', 'First Name')?>
    <?php echo $form->field($model, 'lastname', 'Last Name')?>
    <?php echo $form->field($model, 'email', 'Email')?>
    <button type="submit" class="btn-submit">Submit</button>
    <?php echo \app\core\form\Form::end()?>
</div>
