<?php
/** @var $this app\core\view */

use app\core\Application;
use app\core\form\DropDown;
use app\core\form\Form;
use app\models\Mother;

$this->title = 'Mothers';
?>

<?php
/** @var $model Mother **/
/** @var $modelUpdate Mother **/
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

<div class="Mothers content">

    <div class="shadowBox">
        <h2>Add a New Mother</h2>
        <?php $form = Form::begin('', "post")?>

        <div class="form-container">

            <div class="form-column">
                <?php echo $form->field($model, 'nic', 'NIC Number')?>

                    <?php
                    $maritalStatusField = new Dropdown($model, 'MaritalStatus', 'Marital Status');
                    $maritalStatusField->setOptions([
                        'married' => 'Married',
                        'unmarried' => 'Unmarried',
                    ]);
                    echo $maritalStatusField;
                    ?>

                    <?php
                    $bloodGroupField = new DropDown($model, 'BloodGroup', 'Blood Group');
                    $bloodGroupField->setOptions([
                        'A+' => 'A+',
                        'A-' => 'A-',
                        'B+' => 'B+',
                        'B-' => 'B-',
                        'O+' => 'O+',
                        'O-' => 'O-',
                    ]);
                    echo $bloodGroupField;
                    ?>

                <br>
                <?php echo $form->dateField($model, 'MarriageDate', 'Marriage Date')?>
                <?php echo $form->field($model, 'Occupation', 'Occupation')?>
                <?php echo $form->field($model, 'Allergies', 'Allergies')?>
            </div>

            <div class="form-column">
                <?php echo $form->field($model, 'Consanguinity', 'Consanguinity')?>
                <?php echo $form->field($model, 'history_subfertility', 'History Subfertility')?>
                <?php echo $form->field($model, 'Hypertension', 'Hypertension')?>
                <?php echo $form->field($model, 'diabetes_mellitus', 'Diabetes Mellitus')?>
                <?php
                $rubellaImmunizationField = new Dropdown($model, 'rubella_immunization', 'Rubella Immunization');
                $rubellaImmunizationField->setOptions([
                    1 => 'Yes',
                    2 => 'No',
                ]);
                echo $rubellaImmunizationField;
                ?>

                <?php echo $form->field($model, 'emergencyNumber', 'Emergency Number')?>
            </div>

        </div>

        <button type="submit" class="btn-submit">Submit</button>
        <?php echo Form::end()?>
    </div>
</div>
