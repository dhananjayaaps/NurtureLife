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
</style>

<div class="Mothers content">

    <div class="shadowBox">
        <h2>Medical and Surgical History</h2>
        <?php $form = Form::begin('', "post")?>

        <div class="form-container">

            <div class="form-column">


                <div class="row" style="display: flex; flex-direction: column; gap: 10px">
                    <?php
                    $diabetesField = new Dropdown($model, 'diabetes', 'Diabetes');
                    $diabetesField->setOptions([
                        '1' => 'Yes',
                        '0' => 'No',
                    ]);
                    echo $diabetesField;
                    ?>

                    <?php
                    $hypertensionField = new Dropdown($model, 'hypertension', 'Hypertension');
                    $hypertensionField->setOptions([
                        '1' => 'Yes',
                        '0' => 'No',
                    ]);
                    echo $hypertensionField;
                    ?>

                    <?php
                    $cardiacField = new Dropdown($model, 'cardiac_diseases', 'Cardiac Diseases');
                    $cardiacField->setOptions([
                        '1' => 'Yes',
                        '0' => 'No',
                    ]);
                    echo $cardiacField;
                    ?>

                    <?php
                    $renalField = new Dropdown($model, 'renal_diseases', 'Renal Diseases');
                    $renalField->setOptions([
                        '1' => 'Yes',
                        '0' => 'No',
                    ]);
                    echo $renalField;
                    ?>

                    <?php
                    $hepaticField = new Dropdown($model, 'hepatic_diseases', 'Hepatic Diseases');
                    $hepaticField->setOptions([
                        '1' => 'Yes',
                        '0' => 'No',
                    ]);
                    echo $hepaticField;
                    ?>

                    <?php
                    $psychiatricField = new Dropdown($model, 'psychiatric_illnesses', 'Psychiatric Illnesses');
                    $psychiatricField->setOptions([
                        '1' => 'Yes',
                        '0' => 'No',
                    ]);
                    echo $psychiatricField;
                    ?>

                    <?php
                    $epilepsyField = new Dropdown($model, 'epilepsy', 'Epilepsy');
                    $epilepsyField->setOptions([
                        '1' => 'Yes',
                        '0' => 'No',
                    ]);
                    echo $epilepsyField;
                    ?>

                    <?php
                    $malignanciesField = new Dropdown($model, 'malignancies', 'Malignancies');
                    $malignanciesField->setOptions([
                        '1' => 'Yes',
                        '0' => 'No',
                    ]);
                    echo $malignanciesField;
                    ?>
                </div>
            </div>

           <div class="form-column">

               <div class="row"  style="...">

                    <?php
                    $haematologicalField = new Dropdown($model, 'haematological_diseases', 'Haematological Diseases');
                    $haematologicalField->setOptions([
                        '1' => 'No',
                        '0' => 'Yes',
                    ]);
                    echo $haematologicalField;
                    ?>

                    <?php
                    $tuberculosisField = new Dropdown($model, 'tuberculosis', 'Tuberculosis');
                    $tuberculosisField->setOptions([
                        '1' => 'Yes',
                        '0' => 'No',
                    ]);
                    echo $tuberculosisField;
                    ?>

                    <?php
                    $thyroidField = new Dropdown($model, 'thyroid_diseases', 'Thyroid Diseases');
                    $thyroidField->setOptions([
                        '1' => 'Yes',
                        '0' => 'No',
                    ]);
                    echo $thyroidField;
                    ?>

                    <?php
                    $asthmaField = new Dropdown($model, 'bronchial_asthma', 'Bronchial Asthma');
                    $asthmaField->setOptions([
                        '1' => 'Yes',
                        '0' => 'No',
                    ]);
                    echo $asthmaField;
                    ?>

                    <?php
                    $previousdtvField = new Dropdown($model, 'previous_dtv', 'Previous DTV');
                    $previousdtvField->setOptions([
                        '1' => 'Yes',
                        '0' => 'No',
                    ]);
                    echo $previousdtvField;
                    ?>


                    <?php
                    $surgeriesField = new Dropdown($model, 'surgeries', 'Surgeries other than LSCS');
                    $surgeriesField->setOptions([
                        '1' => 'Yes',
                        '0' => 'No',
                    ]);
                    echo $surgeriesField;
                    ?>


                    <?php
                    $socialField = new Dropdown($model, '`social_risk`', 'Social risk factors');
                    $socialField->setOptions([
                        '1' => 'Yes',
                        '0' => 'No',
                    ]);
                    echo $socialField;
                    ?>

                    <?php echo $form->field($model, 'other', 'Other(Specify)')?>

               </div>

           </div>


        </div>

        <button type="submit" class="btn-submit">Submit</button>
        <?php echo Form::end()?>
    </div>
</div>








