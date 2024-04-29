<?php
/** @var $this app\core\view */

use app\models\User;

$this->title = 'Register';
?>

<?php
/** @var $model User **/
?>

<style>
    body{
        background-color: #f1f1f1;
    }

    .registration_container{
        display: flex;
        justify-content: space-around;
        align-items: center;
        height: 100vh;
        width: 100%;
        margin-left: 30px;
        background-color: #f1f1f1;
    }
    .formRow{
        display: flex;
        flex-direction: row;
        justify-content: space-around;
    }
    .shadowBox{
        display: flex;
        justify-content: space-around;
        align-items: center;
        max-width: 800px;
    }

</style>

<link rel="stylesheet" href="./assets/styles/Form.css">
<div class="registration_container">
    <!-- Left side content, image or anything else -->
    <div class="imageBox">
        <img src="./assets/images/mother_baby_cover.jpeg" alt="Image">
    </div>
    <div class="formContent">
        <div class="shadowBox">
            <h2>Registration Form</h2><br>
            <?php $form = \app\core\form\Form::begin('', "post")?>
            <div class="formRow">
                <div class="formColumn">
                    <?php echo $form->field($model, 'firstname', 'First Name')?>
                    <?php echo $form->field($model, 'lastname', 'Last Name')?>
                </div>
                <div class="formColumn">
                    <?php echo $form->field($model, 'password', 'Password')->passwordField()?>
                    <?php echo $form->field($model, 'confirm_password', 'Confirm Password')->passwordField()?>

                </div>
                <div class="formColumn">
                    <?php echo $form->field($model, 'nic', 'NIC Number')?>
                    <?php echo $form->field($model, 'email', 'Email')?>
                </div>
                <div class="formColumn">
                    <?php echo $form->field($model, 'contact_no', 'Contact Number')?>
                </div>
            </div>
            <div class="formRow">
                <div class="formColumn">
                    <?php echo $form->field($model, 'home_number', 'Home Name / Home No.')?>
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
