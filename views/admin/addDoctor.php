<?php
/** @var $this app\core\view */

use app\models\User;

$this->title = 'Add Doctor';
?>

<?php
/** @var $model User **/
?>


<h1>Add Doctor</h1>


<?php
/** @var $model User **/
?>

<div class="form-container">
    <?php $form = \app\core\form\Form::begin('', "post")?>
    <?php echo $form->field($model, 'nic', 'NIC')?>
    <?php echo $form->field($model, 'clinic', 'Choose the Clinic')->passwordField()?>
    <button type="submit" class="btn-submit">Add Doctor</button>
    <?php echo \app\core\form\Form::end()?>
</div>