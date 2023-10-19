<?php

/** @var $this app\core\view */

use app\models\User;

$this->title = 'Register';
?>

<?php
/** @var $model User **/
?>


<div class="form-container">
    <h2>Registration Form</h2>
<?php $form = \app\core\form\Form::begin('', "post")?>
    <?php echo $form->field($model, 'firstname', 'First Name')?>
    <?php echo $form->field($model, 'lastname', 'Last Name')?>

<?php echo \app\core\form\Form::end()?>
</div>


///** @var $model \app\models\User **/
//?>
<!---->
<!--<div class="form-container">-->
<!--    <h2>Registration Form</h2>-->
<!--    --><?php //$form = \app\core\form\Form::begin('', "post")?>
<!--    --><?php //echo $form->field($model, 'firstname', 'First Name')?>
<!--    --><?php //echo new \app\core\form\TextArea($model, 'firstname', 'First Name')?>
<!--    <button type="submit" class="btn-submit">Submit</button>-->
<!--    --><?php //echo \app\core\form\Form::end()?>
<!--</div>-->
