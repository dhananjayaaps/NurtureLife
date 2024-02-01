<?php
/** @var $this app\core\view */

use app\core\form\Form;
use app\models\User;

$this->title = 'Login';
?>

<?php
/** @var $model User **/
?>

<div class="login_form_container">
    <div class="login_form_content">
        <h2>Login</h2><br>
        <?php $form = Form::begin('', "post")?>
        <?php echo $form->field($model, 'email', 'Email')?>
        <?php echo $form->field($model, 'password', 'Password')->passwordField()?>
        <button type="submit" class="btn-submit">Login</button>
        <?php echo Form::end()?>
    </div>

</div>

