<?php
/** @var $this app\core\view */

use app\core\Application;
use app\core\form\DropDown;
use app\core\form\Form;
use app\models\Mother;

$this->title = 'Present Mother History Form1';
?>

<?php
/** @var $model Midwife **/
/** @var $modelUpdate Midwife **/
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

     .break-line {
         border-top: 1px solid #FFF;
         margin-top: 12px;
         margin-bottom: 10px;
     }

</style>

<div class="Mothers content">

    <div class="shadowBox">
        <h2>Present Obstetric Mother History Form </h2>
        <?php $form = Form::begin('', "post")?>

        <div class="form-container">

            <div class="form-column">

                <div class="row" style="display: flex; flex-direction: column; gap: 10px">
                    <?php
                    $gravidityField = new Dropdown($model, 'gravidity', 'Gravidity');
                    $gravidityField->setOptions([
                        '1' => 'G',
                        '0' => 'P',
                    ]);
                    echo $gravidityField;
                    ?>


                </div>

                <br>
                <?php echo $form->field($model, 'no_of_children', 'No of living children ')?>
                <?php echo $form->field($model, 'age_of_youngest_child', 'Age of Youngest child')?>
                <?php echo $form->dateField($model, 'lrmp', 'Date of last regular period')?>
                <?php echo $form->dateField($model, 'edd', 'Expected Period Date')?>
                <?php echo $form->dateField($model, 'us_corrected_edd', 'US corrected EDD')?>
                <?php echo $form->field($model, 'expected_period', 'Expected period of Delivery')?>
                <?php echo $form->dateField($model, 'date_of_quickening', 'First date of Quickening')?>
                <?php echo $form->field($model, 'POA_at_registration', 'Weeks into pregnancy at time of registration')?>

            </div>

            <div class="form-column">

                <label>
                    Consanguinity:
                    <div class="break-line"></div>
                    <input type="radio" name="Consanguinity" value="Yes"> Yes
                    <input type="radio" name="Consanguinity" value="No"> No
                </label>

                <div class="break-line"></div>

                <label>
                    Rubella Immunization:
                    <div class="break-line"></div>
                    <input type="radio" name="rubella_immunization" value="Yes"> Yes
                    <input type="radio" name="rubella_immunization" value="No"> No
                </label>

                <div class="break-line"></div>

                <label>
                    Pre-Pregancy Screening done:
                    <div class="break-line"></div>
                    <input type="radio" name="pre_pregancy_screening_done" value="Yes"> Yes
                    <input type="radio" name="pre_pregancy_screening_done" value="No"> No
                </label>

                <div class="break-line"></div>

                <label>
                    On Folic Acid:
                    <div class="break-line"></div>
                    <input type="radio" name="folic_acid" value="Yes"> Yes
                    <input type="radio" name="folic_acid" value="No"> No
                </label>

                <div class="break-line"></div>


            </div>

        </div>

        <button type="submit" class="btn-submit">Submit</button>
        <?php echo Form::end()?>
    </div>
</div>

