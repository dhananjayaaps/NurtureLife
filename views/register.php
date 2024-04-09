<?php
/** @var $this app\core\view */

use app\models\User;

$this->title = 'Register';
?>

<?php
/** @var $model User **/
?>

<style>
    .container{
        align-items: center;
        gap: 50px;
    }

    .formContent{
        align-items: center;
        justify-content: center;
        display: flex;
    }
</style>

<div class="container">
        <!-- Left side content, image or anything else -->
        <div class="imageBox">
            <img src="https://www.cidrap.umn.edu/sites/default/files/styles/article_detail/public/article/Pregnant%20woman%20with%20young%20child.jpg" alt="Image">
        </div>
    <div class="formContent">
        <div class="shadowBox">
            <h2>Registration Form</h2><br>
            <?php $form = \app\core\form\Form::begin('', "post")?>
            <div class="formRow">
                <div class="formColumn">
                    <?php echo $form->field($model, 'firstname', 'First Name')?>
                    <?php echo $form->field($model, 'lastname', 'Last Name')?>
                    <?php echo $form->field($model, 'email', 'Email')?>
                </div>
                <div class="formColumn">
                    <?php echo $form->field($model, 'nic', 'NIC Number')?>
                    <?php echo $form->field($model, 'password', 'Password')->passwordField()?>
                    <?php echo $form->field($model, 'confirm_password', 'Confirm Password')->passwordField()?>
                </div>
            </div>
            <div class="formRow">
                <div class="formColumn">
                    <?php echo $form->field($model, 'home_number', 'Home Name/Number')?>
                    <?php echo $form->field($model, 'lane', 'Lane')?>
                </div>
                <div class="formColumn">
                    <?php echo $form->field($model, 'city', 'City')?>
                    <?php echo $form->field($model, 'postal_code', 'Postal Code')?>
                </div>
            </div>
            <div class="centeredButton">
                <button type="submit" class="btn-submit">Submit</button>
            </div>
            <?php echo \app\core\form\Form::end()?>
        </div>
    </div>
</div>
