<?php
/** @var $this app\core\view */

use app\models\User;

$this->title = 'Register';
?>

<?php
/** @var $model User **/
?>


<div class="form-container">
    <div class="form-content">
        <h2>Registration Form</h2>
        <?php $form = \app\core\form\Form::begin('', "post")?>
        <?php echo $form->field($model, 'firstname', 'First Name')?>
        <?php echo $form->field($model, 'lastname', 'Last Name')?>
        <?php echo $form->field($model, 'email', 'Email')?>
        <?php echo $form->field($model, 'nic', 'NIC Number')?>
        <?php echo $form->field($model, 'password', 'Password')->passwordField()?>
        <?php echo $form->field($model, 'confirm_password', 'Confirm Password')->passwordField()?>
        <button type="submit" class="btn-submit">Submit</button>
        <?php echo \app\core\form\Form::end()?>
    </div>
</div>



