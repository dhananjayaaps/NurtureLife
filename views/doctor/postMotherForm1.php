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

    .break-line {
        border-top: 1px solid #FFF;
        margin-top: 5px;
        margin-bottom: 5px;
    }

</style>

<h1>Postnatal Mother Form</h1>
<div class="Mothers content">

    <div class="shadowBox">
        <div class="form-container">
            <h2>Postnatal Clinic Care</h2>
            <?php $form = Form::begin('', "post")?>
            <div class="form-content">
                <div class="form-column">
                    <?php
                    $radioButton = new RadioButton($model, 'breast_problems', '1. Breast Problems');
                    $radioButton->setOptions([
                        '1' => 'Yes',
                        '2' => 'No',
                    ]);
                    echo $radioButton;
                    ?>
                    <?php
                    $radioButton = new RadioButton($model, 'abnormal_vaginal_discharge', '2. Abnormal Vaginal Discharge');
                    $radioButton->setOptions([
                        '1' => 'Yes',
                        '2' => 'No',
                    ]);
                    echo $radioButton;
                    ?>
                    <?php
                    $radioButton = new RadioButton($model, 'excessive_vaginal_bleeding', '3. Excessive Vaginal Bleeding');
                    $radioButton->setOptions([
                        '1' => 'Yes',
                        '2' => 'No',
                    ]);
                    echo $radioButton;
                    ?>
                    <?php
                    $radioButton = new RadioButton($model, 'pallor', '4. Pallor');
                    $radioButton->setOptions([
                        '1' => 'Yes',
                        '2' => 'No',
                    ]);
                    echo $radioButton;
                    ?>
                    <?php
                    $radioButton = new RadioButton($model, 'lcterus', '5. Lcterus');
                    $radioButton->setOptions([
                        '1' => 'Yes',
                        '2' => 'No',
                    ]);
                    echo $radioButton;
                    ?>
                </div>

                <div class="form-column">
                    <?php
                    $radioButton = new RadioButton($model, 'dema', '6. Dema(ankle and/or facial)');
                    $radioButton->setOptions([
                        '1' => 'Yes',
                        '2' => 'No',
                    ]);
                    echo $radioButton;
                    ?>
                    <?php
                    $radioButton = new RadioButton($model, 'bp', '7. Blood Pressure');
                    $radioButton->setOptions([
                        '1' => 'Normal',
                        '2' => 'Irregular',
                    ]);
                    echo $radioButton;
                    ?>
                    <?php
                    $radioButton = new RadioButton($model, 'cardiovascular_system', '8. Cardiovascular System');
                    $radioButton->setOptions([
                        '1' => '1',
                        '5' => '5',
                        '10' => '10'
                    ]);
                    echo $radioButton;
                    ?>
                    <?php
                    $radioButton = new RadioButton($model, 'respiratory_system', '9. Respiratory System');
                    $radioButton->setOptions([
                        '1' => '1',
                        '5' => '5',
                        '10' => '10'
                    ]);
                    echo $radioButton;
                    ?>
                    <label>
                        6. Dema(ankle and/or facial):
                        <div class="break-line"></div>
                        <input type="radio" name="dema" value="Yes"> Yes
                        <input type="radio" name="dema" value="No"> No
                    </label>

                    <div class="break-line"></div>

                    <label>
                        7. Blood Pressure:
                        <div class="break-line"></div>
                        <input type="radio" name="bp" value="Normal"> Normal
                        <input type="radio" name="bp" value="Irregular"> Irregular
                    </label>

                    <div class="break-line"></div>

                    <label>
                        8. Cardiovascular System:
                        <div class="break-line"></div>
                        <input type="radio" name="cardiovascular_system" value="Normal"> Normal
                        <input type="radio" name="cardiovascular_system" value="Unusual"> Unusual
                    </label>

                    <div class="break-line"></div>

                    <label>
                        9. Respiratory System:
                        <div class="break-line"></div>
                        <input type="radio" name="respiratory_system" value="Normal"> Normal
                        <input type="radio" name="respiratory_system" value="Unusual"> Unusual
                    </label>
                </div>

                <div class="form-column">
                    <?php
                    $radioButton = new RadioButton($model, 'abdominal_examination', '10. Abdominal Examination');
                    $radioButton->setOptions([
                        '1' => '1',
                        '5' => '5',
                        '10' => '10'
                    ]);
                    echo $radioButton;
                    ?>
                    <?php
                    $radioButton = new RadioButton($model, 'mental_status', '11. Mental Status');
                    $radioButton->setOptions([
                        '1' => '1',
                        '5' => '5',
                        '10' => '10'
                    ]);
                    echo $radioButton;
                    ?>
                    <?php
                    $radioButton = new RadioButton($model, 'family_planning_method', '12. Family Planning Method Chosen');
                    $radioButton->setOptions([
                        '1' => '1',
                        '5' => '5',
                        '10' => '10'
                    ]);
                    echo $radioButton;
                    ?>
                    <label>
                        10. Abdominal Examination:
                        <div class="break-line"></div>
                        <input type="radio" name="abdominal_examination" value="Normal"> Normal
                        <input type="radio" name="abdominal_examination" value="Unusual"> Unusual
                    </label>

                    <div class="break-line"></div>

                    <label>
                        11. Mental Status:
                        <div class="break-line"></div>
                        <input type="radio" name="mental_status" value="Normal"> Normal
                        <input type="radio" name="mental_status" value="Unusual"> Unusual
                    </label>
                    <div class="break-line"></div>
                    <label>
                        12. Family Planning Method Chosen:
                        <div class="break-line"></div>
                        <input type="radio" name="family_planning_method" value="1"> DMPA <br>
                        <input type="radio" name="family_planning_method" value="2"> IUD  <br>
                        <input type="radio" name="family_planning_method" value="3"> Female Sterilization <br>
                        <input type="radio" name="family_planning_method" value="4"> Other
                    </label>
                    <div class="break-line"></div>
                </div>
            </div>
            <button type="submit" class="btn-submit">Submit</button>
        </div>
        <?php echo Form::end()?>
    </div>
</div>








