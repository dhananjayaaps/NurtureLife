<?php
/** @var $model \app\models\User **/
?>

<div class="form-container">
    <h2>Registration Form</h2>
    <?php $form = \app\core\form\Form::begin('', "post")?>
    <?php echo $form->field($model, 'email', 'Email')?>
    <?php echo $form->field($model, 'password', 'Password')->passwordField()?>
    <button type="submit" class="btn-submit">Login</button>
    <?php echo \app\core\form\Form::end()?>
</div>

