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
    .shadowBox{
        min-width: 80%;
        min-height: 60%;
    }
    .content{
        margin-left: 0;
        align-items: center;
    }
    .container{
        align-items: center;
        gap: 50px;
        /*justify-content: space-around;*/
    }

    .formContent{
        align-items: center;
        justify-content: center;
        display: flex;
    }
</style>

<div class="container">
    <div class="imageBox">
        <img src="https://www.cidrap.umn.edu/sites/default/files/styles/article_detail/public/article/Pregnant%20woman%20with%20young%20child.jpg" alt="Image">
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

