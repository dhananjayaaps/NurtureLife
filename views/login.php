<?php
/** @var $this app\core\view */

use app\core\form\Form;
use app\models\User;

$this->title = 'Login';
?>

<?php
/** @var $model User **/
?>

<style>
    .container{
        align-items: center;
        gap: 50px;
        width: 70vw;
        margin: 50px 50px 50px 200px;
        justify-content: space-between;
    }

    .formContent{
        width: 50%;
        height: 100%;
    }
</style>
<div class="container">
    <div class="imageBox">
        <img src="assets/images/mother_baby.jpeg" alt="Image">
    </div>

    <div class="formContent">
        <div class="shadowBox">
            <h2>Login</h2><br>
            <?php $form = Form::begin('', "post")?>
            <?php echo $form->field($model, 'email', 'Email')?>
            <?php echo $form->field($model, 'password', 'Password')->passwordField()?>
            <button type="submit" class="btn-submit">Login</button>
            <?php echo Form::end()?>
        </div>
    </div>
</div>

