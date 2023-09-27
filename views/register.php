<h2>Registration Form</h2>

<?php $form = \app\core\form\Form::begin('', "post")?>
    echo $form->field($model, 'firstname')?>
    <?php echo $form->field($model, 'lastname')?>
    <?php echo $form->field($model, 'email')?>
    <?php echo $form->field($model, 'password')->passwordField()?>
    <?php echo $form->field($model, 'confirm_password')->passwordField()?>
    <button type="submit" class="btn btn-primary">Submit</button>
<?php echo \app\core\form\Form::end()?>
