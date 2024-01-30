<?php
/** @var $this app\core\view */

use app\core\Application;
use app\core\form\DropDown;
use app\core\form\Form;
use app\models\Mother;

$this->title = 'Child';
?>

<?php
/** @var $model Child **/
/** @var $modelUpdate childCard2 **/
//?>



<link rel="stylesheet" href="./assets/styles/Form.css">
<link rel="stylesheet" href="./assets/styles/table.css">

<style>
    .form-column {
        float: left;
        width: 100%;
        box-sizing: border-box;
        padding: 0 10px;
    }

    .clear {
        clear: both;
    }
</style>

<div class="Mothers content">

    <div class="shadowBox">
        <h2>NEWBORN BABY'S HEALTH CHART<br><br></h2>
        <?php $form = Form::begin('', "post")?>

        <div class="form-column">

            <div class="row" style="display: flex; flex-direction: column; gap: 10px">
                <?php echo $form->field($model, 'child_id', 'Child ID')?>

                <?php
                $timeDurationField = new Dropdown($model, 'time_duration', 'Time Duration');
                $timeDurationField->setOptions([
                    'in the first 10 days' => 'In the first ten days after birth ',
                    'during 11 and 28 days' => 'During 11 and 28 days',
                    'during 29 and 42 days' => 'During 29 and 42 days',
                ]);
                echo $timeDurationField;
                ?>

                <?php echo $form->dateField($model, 'date', 'Date of Form Completion')?>

                <?php echo $form->field($model, 'skin_color', 'Skin Color')?>

                <?php echo $form->field($model, 'eyes', 'The nature of Eyes')?>

                <?php echo $form->field($model, 'pecan', 'The nature of Pecan')?>


                <?php
                $breastFeedingField = new Dropdown($model, 'breast_feeding', 'Exclusive Breastfeeding');
                $breastFeedingField->setOptions([
                    'yes' => 'Yes',
                    'no' => 'No',
                ]);
                echo $breastFeedingField;
                ?>

                <?php
                $breastFeedingPositionField = new Dropdown($model, 'breastfeeding_position', 'Breastfeeding Position');
                $breastFeedingPositionField->setOptions([
                    'correct' => 'Correct',
                    'incorrect' => 'Incorrect',
                ]);
                echo $breastFeedingPositionField;
                ?>

                <?php echo $form->field($model, 'breastfeeding_relationship', 'Breastfeeding Relationship')?>

                <?php echo $form->field($model, 'other', 'Other Reasons')?>


            </div>

            <button type="submit" class="btn-submit">Submit</button>
            <?php echo Form::end()?>
        </div>

    </div>