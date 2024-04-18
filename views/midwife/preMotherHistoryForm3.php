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
                <label>
                    1. Diabetes:
                    <div class="break-line"></div>
                    <input type="radio" name="diabetes1" value="Yes"> Yes
                    <input type="radio" name="diabetes1" value="No"> No
                </label>

                <div class="break-line"></div>

                <label>
                    2. Hypertension:
                    <div class="break-line"></div>
                    <input type="radio" name="hypertension1" value="Yes"> Yes
                    <input type="radio" name="hypertension1" value="No"> No
                </label>

                <div class="break-line"></div>

                <label>
                    3. Haematological Diseases:
                    <div class="break-line"></div>
                    <input type="radio" name="haematological1" value="Yes"> Yes
                    <input type="radio" name="haematological1" value="No"> No
                </label>

                <div class="break-line"></div>]


                <?php echo $form->field($model, 'other1', '4. Other(specify)')?>



            </div>



        </div>

        <button type="submit" class="btn-submit">Submit</button>
        <?php echo Form::end()?>
    </div>
</div>


