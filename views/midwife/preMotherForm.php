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
    .form-column {
        float: left;
        width: 50%;
        box-sizing: border-box;
        padding: 0 10px;
    }

    .clear {
        clear: both;
    }
</style>

<div class="Mothers content">

    <div class="shadowBox">
        <h2>Add a New Mother<br></h2>
        <?php $form = Form::begin('', "post")?>

        <div class="form-column">
            <?php echo $form->field($model, 'nic', 'NIC Number')?>

            <div class="row" style="display: flex; flex-direction: column; gap: 10px">

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
        </div>

        <br>
        <?php echo $form->dateField($model, 'MarriageDate', 'Marriage Date')?>
        <?php echo $form->field($model, 'Occupation', 'Occupation')?>
        <?php echo $form->field($model, 'Allergies', 'Allergies')?>
    </div>

    <div class="form-column">
        <?php echo $form->field($model, 'Consanguinity', 'Consanguinity')?>
        <?php echo $form->field($model, 'history_subfertility', 'history_subfertility')?>
        <?php echo $form->field($model, 'Hypertension', 'Hypertension')?>

        <?php
        $maritalStatusField = new Dropdown($model, 'rubella_immunization', 'Rubella Immunization');
        $maritalStatusField->setOptions([
            'yes' => 'Yes',
            'no' => 'No',
        ]);
        echo $maritalStatusField;
        ?>

        <?php echo $form->field($model, 'emergencyNumber', 'Emergency Number')?>
    </div>
</div>

<button type="submit" class="btn-submit">Submit</button>
<?php echo Form::end()?>
</div>