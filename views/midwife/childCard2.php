<?php
/** @var $this app\core\view */

use app\core\Application;
use app\core\form\DropDown;
use app\core\form\Form;
use app\core\form\RadioButton;
use app\models\Child;
use app\models\Mother;

$this->title = 'Child';
?>

<?php
/** @var $model Child **/
/** @var $modelUpdate child **/
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

                <?php
                $radioButton = new RadioButton($model, 'time_duration', 'Time Duration');
                $radioButton->setOptions([
                    '1' => 'In the first ten days after birth ',
                    '2' => 'During 11 and 28 days',
                    '3' => 'During 29 and 42 days',
                ]);
                echo $radioButton;
                ?>

                <?php echo $form->dateField($model, 'completion_date', 'Date of Form Completion')?>

                <?php echo $form->field($model, 'skin_color', 'Skin Color')?>

                <?php echo $form->field($model, 'eyes', 'The nature of Eyes')?>

                <?php echo $form->field($model, 'pecan', 'The nature of Pecan')?>


                <?php
                $radioButton = new RadioButton($model, 'breast_feeding', 'Exclusive Breastfeeding');
                $radioButton->setOptions([
                    '1' => 'Yes',
                    '2' => 'No',
                ]);
                echo $radioButton;
                ?>

                <?php
                $radioButton = new RadioButton($model, 'breastfeeding_position', 'Breastfeeding Position');
                $radioButton->setOptions([
                    '1' => 'Correct',
                    '2' => 'Incorrect',
                ]);
                echo $radioButton;
                ?>

                <?php echo $form->field($model, 'breastfeeding_relationship', 'Breastfeeding Relationship')?>

                <?php echo $form->field($model, 'other', 'Other Reasons')?>

            </div>
            <button type="submit" class="btn-submit">Submit</button>
            <?php echo Form::end()?>
        </div>
    </div>