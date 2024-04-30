<?php
/** @var $this app\core\view */

use app\core\Application;
use app\core\form\DropDown;
use app\core\form\Form;
use app\core\form\RadioButton;
use app\models\Mother;
use app\models\PostMotherDetails;

?>

<?php
/** @var $model PostMotherDetails **/
/** @var $modelUpdate PostMotherDetails **/
//?>



<link rel="stylesheet" href="./assets/styles/Form.css">
<link rel="stylesheet" href="./assets/styles/table.css">

<style>
    .form-container{
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .form-content {
        display: flex;
        justify-content: space-between;
        max-width: 800px; /* Adjust the width as needed */
        margin: 0 auto;
    }

    .form-column {
        width: 48%; /* Adjust the width as needed */
        box-sizing: border-box;
        padding: 0 10px;
        display: flex;
        flex-direction: column;
        gap: 10px;
    }

    .form-column:last-child {
        margin-left: 2%; /* Adjust the margin between columns as needed */
    }

    .btn-submit {
        margin-top: 20px;
    }

    .shadowBox{
        width: 600px;
    }

    .content{
        margin-left: 280px;
    }
</style>

<h1>Postnatal Mother Form</h1>
<div class="Mothers content">

    <div class="shadowBox">
        <div class="form-container">
            <h2>Postnatal Clinic Care<br><br></h2>
            <?php $form = Form::begin('', "post")?>
            <div class="form-content">
                <div class="form-column">
                    <?php
                    $radioButton = new RadioButton($model, 'breast_problems', '1. Breast Problems');
                    $radioButton->setOptions([
                        '1' => 'Yes',
                        '2' => 'No'
                    ]);
                    echo $radioButton;
                    ?>
                    <?php
                    $radioButton = new RadioButton($model, 'abnormal_vaginal_discharge', '2. Abnormal Vaginal Discharge');
                    $radioButton->setOptions([
                        '1' => 'Yes',
                        '2' => 'No'
                    ]);
                    echo $radioButton;
                    ?>
                    <?php
                    $radioButton = new RadioButton($model, 'excessive_vaginal_bleeding', '3. Excessive Vaginal Bleeding');
                    $radioButton->setOptions([
                        '1' => 'Yes',
                        '2' => 'No'
                    ]);
                    echo $radioButton;
                    ?>
                    <?php
                    $radioButton = new RadioButton($model, 'pallor', '4. Pallor');
                    $radioButton->setOptions([
                        '1' => 'Yes',
                        '2' => 'No'
                    ]);
                    echo $radioButton;
                    ?>
                    <?php
                    $radioButton = new RadioButton($model, 'lcterus', '5. Lcterus');
                    $radioButton->setOptions([
                        '1' => 'Yes',
                        '2' => 'No'
                    ]);
                    echo $radioButton;
                    ?>
                    <?php
                    $radioButton = new RadioButton($model, 'dema', '6. Dema(ankle and/or facial)');
                    $radioButton->setOptions([
                        '1' => 'Yes',
                        '2' => 'No'
                    ]);
                    echo $radioButton;
                    ?>
                </div>

                <div class="form-column">
                    <?php
                    $radioButton = new RadioButton($model, 'bp', '7. Blood Pressure');
                    $radioButton->setOptions([
                        '1' => 'Normal',
                        '2' => 'Irregular'
                    ]);
                    echo $radioButton;
                    ?>
                    <?php
                    $radioButton = new RadioButton($model, 'cardiovascular_system', '8. Cardiovascular System');
                    $radioButton->setOptions([
                        '1' => 'Normal',
                        '2' => 'Unusual'
                    ]);
                    echo $radioButton;
                    ?>
                    <?php
                    $radioButton = new RadioButton($model, 'respiratory_system', '9. Respiratory System');
                    $radioButton->setOptions([
                        '1' => 'Normal',
                        '2' => 'Unusual'
                    ]);
                    echo $radioButton;
                    ?>

                <div class="form-column">
                    <?php
                    $radioButton = new RadioButton($model, 'abdominal_examination', '10. Abdominal Examination');
                    $radioButton->setOptions([
                        '1' => 'Normal',
                        '2' => 'Unusual'
                    ]);
                    echo $radioButton;
                    ?>
                    <?php
                    $radioButton = new RadioButton($model, 'mental_status', '11. Mental Status');
                    $radioButton->setOptions([
                        '1' => 'Normal',
                        '2' => 'Unusual'
                    ]);
                    echo $radioButton;
                    ?>
                    <?php
                    $radioButton = new RadioButton($model, 'family_planning_method', '12. Family Planning Method Chosen');
                    $radioButton->setOptions([
                        '1' => 'DMPA',
                        '2' => 'IUD',
                        '3' => 'Female Sterilization',
                        '4' => 'Other'
                    ]);
                    echo $radioButton;
                    ?>
                    <button type="submit" class="btn-submit">Submit</button>
                </div>
            </div>
        </div>
        <?php echo Form::end()?>
    </div>
</div>








