<?php
/** @var $this app\core\view */

use app\models\User;

$this->title = 'Register';
?>

<?php
/** @var $model User **/
?>

<style>
    .container {
        margin-top: 60px;
        display: flex;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
        align-items: center;
    }

    .imageBox {
        display: flex;
        justify-content: center;
        align-items: center;
        width: 40%;
        height: 40%;
    }

    .imageBox img {
        max-width: 100%;
        max-height: 100%;
        border-radius: 20px;
    }

    .formContent {
        padding: 20px;
    }

    .signup_form_container {
        width: 100%; /* Ensure the form container takes up full width */
    }

    .formRow {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
        margin-bottom: 20px;
    }

    .formColumn {
        flex-basis: calc(50% - 10px); /* 50% width with a little space between columns */
    }

    .centeredButton {
        display: flex;
        justify-content: center;
        margin-top: 20px;
    }

</style>

<div class="container">
        <!-- Left side content, image or anything else -->
        <div class="imageBox">
            <img src="https://www.cidrap.umn.edu/sites/default/files/styles/article_detail/public/article/Pregnant%20woman%20with%20young%20child.jpg" alt="Image">
        </div>
    <div class="formContent">
        <div class="shadowBox">
            <div class="signup_form_container">
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
</div>
