<?php
/** @var $this app\core\view */

use app\core\Application;
use app\core\form\DropDown;
use app\core\form\Form;
use app\models\Mother;
use app\models\PreMotherPersonalDetails;

$this->title = 'Present Mother History Form1';
?>

<?php
/** @var $model PreMotherPersonalDetails **/
/** @var $modelUpdate PreMotherPersonalDetails **/
//?>



<link rel="stylesheet" href="./assets/styles/Form.css">
<link rel="stylesheet" href="./assets/styles/table.css">

<style>
    .form-container {
        display: flex;
        justify-content: space-between;
        max-width: 800px; /* Adjust the width as needed */
        margin: 0 auto;
    }

    .form-column {
        width: 48%; /* Adjust the width as needed */
        box-sizing: border-box;
        padding: 0 10px;
    }

    .form-column:last-child {
        margin-left: 2%; /* Adjust the margin between columns as needed */
    }

    .btn-submit {
        margin-top: 20px;
    }
</style>
<h1>Midwife - Personal information of mother</h1>
<div class="Mothers content">

    <div class="shadowBox">
        <h2>Personal Information of Husband</h2>
        <?php $form = Form::begin('', "post")?>

        <div class="form-container">

            <div class="form-column">

                <?php echo $form->field($model, 'age', 'Age')?>

                <?php echo $form->field($model, 'education_level', 'Education Level')?>

                <?php echo $form->field($model, 'occuption', 'Occuption')?>

            </div>

        </div>

        <button type="submit" class="btn-submit">Submit</button>
        <?php echo Form::end()?>
    </div>
</div>


<div class="Mothers content">

    <div class="shadowBox">
        <h2>Personal Information of Wife</h2>
        <?php $form = Form::begin('', "post")?>

        <div class="form-container">

            <div class="form-column">

                <?php echo $form->field($model, 'age1', 'Age')?>

                <?php echo $form->field($model, 'education_level1', 'Education Level')?>

                <?php echo $form->field($model, 'occuption1', 'Occuption')?>

            </div>

        </div>

        <button type="submit" class="btn-submit">Submit</button>
        <?php echo Form::end()?>
    </div>
</div>


