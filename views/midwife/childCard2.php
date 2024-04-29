<?php
/** @var $this app\core\view */

use app\core\Application;
use app\core\form\DropDown;
use app\core\form\Form;
use app\core\form\RadioButton;
use app\models\BabyHealthChart;


$this->title = 'Child';
?>

<?php
/** @var $model BabyHealthChart **/
//?>



<link rel="stylesheet" href="./assets/styles/Form.css">
<link rel="stylesheet" href="./assets/styles/table.css">

<style>
    .shadowBox{
        width: 600px;
    }

    .form-column {
        float: left;
        width: 100%;
        box-sizing: border-box;
        padding: 0 10px;
    }

    .clear {
        clear: both;
    }

    .content{
        margin-left: 280px;
    }
</style>

<div class="Mothers content">

    <div class="shadowBox">
        <h2>NEWBORN BABY'S HEALTH CHART<br><br></h2>
        <?php $form = Form::begin('', "post")?>

        <div class="form-column">

            <div class="row" style="display: flex; flex-direction: column; gap: 10px">

                <?php
                $radioButton = new RadioButton($model, 'time_duration', '1.Time Duration');
                $radioButton->setOptions([
                    '1' => 'In the first ten days after birth ',
                    '2' => 'During 11 and 28 days',
                    '3' => 'During 29 and 42 days',
                ]);
                echo $radioButton;
                ?>

                <?php echo $form->field($model, 'skin_color', '2.Skin Color')?>

                <?php echo $form->field($model, 'eyes', '3.The nature of Eyes')?>

                <?php echo $form->field($model, 'pecan', '4.The nature of Pecan')?>


                <?php
                $radioButton = new RadioButton($model, 'breast_feeding', '5.Exclusive Breastfeeding');
                $radioButton->setOptions([
                    '1' => 'Yes',
                    '2' => 'No',
                ]);
                echo $radioButton;
                ?>

                <?php
                $radioButton = new RadioButton($model, 'breastfeeding_position', '6.Breastfeeding Position');
                $radioButton->setOptions([
                    '1' => 'Correct',
                    '2' => 'Incorrect',
                ]);
                echo $radioButton;
                ?>

                <?php echo $form->field($model, 'breastfeeding_relationship', '7.Breastfeeding Relationship')?>

                <?php echo $form->field($model, 'other', '8.Other Reasons')?>

            </div>
            <button type="submit" class="btn-submit">Submit</button>
            <?php echo Form::end()?>
        </div>
    </div>