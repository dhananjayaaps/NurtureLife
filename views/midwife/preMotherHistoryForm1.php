<?php
/** @var $this app\core\view */

use app\core\Application;
use app\core\form\DropDown;
use app\core\form\Form;
use app\core\form\RadioButton;
use app\models\Mother;
use app\models\PresentObstetricDetails;

$this->title = 'Present Mother History Form1';
?>

<?php
/** @var $model PresentObstetricDetails **/
/** @var $modelUpdate PresentObstetricDetails **/
//?>



<link rel="stylesheet" href="./assets/styles/Form.css">
<link rel="stylesheet" href="./assets/styles/table.css">

<style>
    .shadowBox{
        width: 100%;
    }

    .form-container {
        display: flex;
        justify-content: space-between;
        max-width: 800px; /* Adjust the width as needed */
        margin: 0 auto;
        gap: 20px;
        flex-direction: column;
        align-items: center;
        /*flex-wrap: wrap;*/
    }

    .form-content-container{
        display: flex;
        flex-direction: row;
        justify-content: space-between;
        margin: 0 auto;
        gap: 30px;
    }

    .btn-submit{
        width: 90px;
    }

    .form-column {
        width: 48%; /* Adjust the width as needed */
        box-sizing: border-box;
        padding: 0 10px;
        display: flex;
        flex-direction: column;
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

        <?php $form = Form::begin('', "post")?>

        <div class="form-container">
            <h2>Present Obstetric Mother History Form </h2>
            <div class="form-content-container">
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

                </div>

                <div class="form-column">
                    <?php echo $form->dateField($model, 'us_corrected_edd', 'US corrected EDD')?>
                    <?php echo $form->field($model, 'expected_period', 'Expected period of Delivery')?>
                    <?php echo $form->dateField($model, 'date_of_quickening', 'First date of Quickening')?>
                    <?php echo $form->field($model, 'POA_at_registration', 'Weeks into pregnancy at time of registration')?>

                </div>

                <div class="form-column">

                    <?php
                    $radioButton = new RadioButton($model, 'consanguinity', 'Consanguinity');
                    $radioButton->setOptions([
                        '1' => 'Yes',
                        '2' => 'No',
                    ]);
                    echo $radioButton;
                    ?>

                    <?php
                    $radioButton = new RadioButton($model, 'rubella_immunization', 'Rubella Immunization');
                    $radioButton->setOptions([
                        '1' => 'Yes',
                        '2' => 'No',
                    ]);
                    echo $radioButton;
                    ?>

                    <?php
                    $radioButton = new RadioButton($model, 'pre_pregancy_screening_done', 'Pre-Pregancy Screening done');
                    $radioButton->setOptions([
                        '1' => 'Yes',
                        '2' => 'No',
                    ]);
                    echo $radioButton;
                    ?>

                    <?php
                    $radioButton = new RadioButton($model, 'folic_acid', 'On Folic Acid');
                    $radioButton->setOptions([
                        '1' => 'Yes',
                        '2' => 'No',
                    ]);
                    echo $radioButton;
                    ?>

                </div>
            </div>
            <button type="submit" class="btn-submit">Submit</button>
        </div>
        <?php echo Form::end()?>
    </div>
</div>

