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


                    <?php
                    $diabetes1Field = new Dropdown($model, 'diabetes1', 'Diabetes');
                    $diabetes1Field->setOptions([
                        '1' => 'Yes',
                        '0' => 'No',
                    ]);
                    echo $diabetes1Field;
                    ?>

                    <?php
                    $hypertension1Field = new Dropdown($model, 'hypertension1', 'Hypertension');
                    $hypertension1Field->setOptions([
                        '1' => 'Yes',
                        '0' => 'No',
                    ]);
                    echo $hypertension1Field;
                    ?>

                    <?php
                    $haematological1Field = new Dropdown($model, 'haematological1', 'Haematological Diseases');
                    $haematological1Field->setOptions([
                        '1' => 'Yes',
                        '0' => 'No',
                    ]);
                    echo $haematological1Field;
                    ?>

                    <?php echo $form->field($model, 'other1', 'Other(specify)')?>



            </div>



        </div>

        <button type="submit" class="btn-submit">Submit</button>
        <?php echo Form::end()?>
    </div>
</div>


