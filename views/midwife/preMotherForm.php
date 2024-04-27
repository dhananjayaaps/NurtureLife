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

    #allergies-container {
        /*display: flex;*/
        flex-direction: row;
        flex-wrap: wrap;
    }

    .allergy {
        margin-bottom: 10px; /* Adjust spacing as needed */
        display: flex;
        align-items: center;
    }

    .allergy label {
        flex: 0 0 120px; /* Adjust label width as needed */
        font-weight: bold;
    }

    .allergy select,
    .allergy input[type="text"] {
        flex: 1;
        padding: 5px;
        border: 1px solid #ccc;
        border-radius: 3px;
        box-sizing: border-box;
        margin-left: 10px; /* Adjust margin as needed */
    }

    .btn-add {
        padding: 8px 16px; /* Adjust padding to make the button smaller */
        font-size: 14px; /* Adjust font size to make the button text smaller */
    }

    .content{
        margin-left: 300px;
        justify-content: center;
        align-content: center;
    }


</style>

<div class="Mothers content">

    <div class="shadowBox">
        <h2>Add a New Mother</h2>
        <?php $form = Form::begin('', "post")?>

        <div class="form-container">

            <div class="form-column">
                <?php echo $form->field($model, 'nic', 'NIC Number');


                    $maritalStatusField = new Dropdown($model, 'MaritalStatus', 'Marital Status');
                    $maritalStatusField->setOptions([
                        'married' => 'Married',
                        'single' => 'Single Mother',
                        'divorce' => 'Divorced',
                    ]);
                    echo $maritalStatusField;
                    ?>

                    <?php
                    $bloodGroupField = new DropDown($model, 'BloodGroup', 'Blood Group');
                    $bloodGroupField->setOptions([
                        'A+' => 'A positive (A+)',
                        'A-' => 'A negative (A-)',
                        'B+' => 'B positive (B+)',
                        'B-' => 'B negative (B-)',
                        'AB+' => 'AB positive (AB+)',
                        'O+' => 'O positive (O+)',
                        'O-' => 'O negative (O-)',
                    ]);
                    echo $bloodGroupField;
                    ?>

                <br>
                <?php echo $form->dateField($model, 'MarriageDate', 'Marriage Date')?>
                <?php echo $form->field($model, 'Occupation', 'Occupation')?>
<!--                --><?php //echo $form->field($model, 'Allergies', 'Allergies')?>
                <?php echo $form->field($model, 'emergencyNumber', 'Emergency Number')?>


            </div>

            <div class="form-column">
<!--                --><?php //echo $form->field($model, 'Consanguinity', 'Consanguinity')?>
<!--                --><?php //echo $form->field($model, 'history_subfertility', 'History Subfertility')?>
<!--                --><?php //echo $form->field($model, 'Hypertension', 'Hypertension')?>
<!--                --><?php //echo $form->field($model, 'diabetes_mellitus', 'Diabetes Mellitus')?>
<!--                --><?php
//                $rubellaImmunizationField = new Dropdown($model, 'rubella_immunization', 'Rubella Immunization');
//                $rubellaImmunizationField->setOptions([
//                    1 => 'Yes',
//                    2 => 'No',
//                ]);
//                echo $rubellaImmunizationField;
//                ?>

                <style>
                    .break-line {
                        border-top: 1px solid #FFF;
                        margin-top: 12px;
                        margin-bottom: 10px;
                    }
                </style>

                <label>
                    Consanguinity:
                    <div class="break-line"></div>
                    <input type="radio" name="Consanguinity" value="Yes"> Yes
                    <input type="radio" name="Consanguinity" value="No"> No
                </label>

                <div class="break-line"></div>

                <label>
                    History Subfertility:
                    <div class="break-line"></div>
                    <input type="radio" name="history_subfertility" value="Yes"> Yes
                    <input type="radio" name="history_subfertility" value="No"> No
                </label>

                <div class="break-line"></div>

                <label>
                    Hypertension:
                    <div class="break-line"></div>
                    <input type="radio" name="Hypertension" value="Yes"> Yes
                    <input type="radio" name="Hypertension" value="No"> No
                </label>

                <div class="break-line"></div>

                <label>
                    Diabetes Mellitus:
                    <div class="break-line"></div>
                    <input type="radio" name="diabetes_mellitus" value="Yes"> Yes
                    <input type="radio" name="diabetes_mellitus" value="No"> No
                </label>

                <div class="break-line"></div>

                <label>
                    Rubella Immunization:
                    <div class="break-line"></div>
                    <input type="radio" name="rubella_immunization" value="Yes"> Yes
                    <input type="radio" name="rubella_immunization" value="No"> No
                </label>

                <div class="break-line"></div>

            </div>

        </div>
        <br>
        <h3>Allergies</h3><br>
        <div id="allergies-container">
            <div class="allergy">
                <label for="allergy-type">Allergy Type:</label>
                <select name="allergy-type" class="allergy-type">
                    <option value="food">Food</option>
                    <option value="drug">Drug</option>
                    <option value="other">Other</option>
                </select>
                <label for="allergy-description">Description:</label>
                <input type="text" name="allergy-description" class="allergy-description">
            </div>
        </div>
        <button class="btn-add" id="add-allergy">Add New Allergy</button>

        <br>

        <button type="submit" class="btn-submit">Submit</button>
        <?php echo Form::end()?>
    </div>
</div>


<script>
    document.getElementById('add-allergy').addEventListener('click', function (event) {
        event.preventDefault(); // Prevent the default form submission behavior

        const allergiesContainer = document.getElementById('allergies-container');
        const newAllergy = document.createElement('div');
        newAllergy.classList.add('allergy');
        newAllergy.innerHTML = `
        <label for="allergy-type">Allergy Type:</label>
        <select name="allergy-type" class="allergy-type">
            <option value="food">Food</option>
            <option value="drug">Drug</option>
            <option value="other">Other</option>
        </select>
        <label for="allergy-description">Description:</label>
        <input type="text" name="allergy-description" class="allergy-description">
    `;
        allergiesContainer.appendChild(newAllergy);
    });
</script>