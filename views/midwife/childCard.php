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
/** @var $modelUpdate childCard **/
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
        <h2>CARE OF NEWBORN CHILD<br><br></h2>
        <?php $form = Form::begin('', "post")?>

        <div class="form-column">

            <div class="row" style="display: flex; flex-direction: column; gap: 10px">
                <?php echo $form->field($model, 'child_id', 'Child ID')?>

                <?php
                $apgaField = new Dropdown($model, 'no_of_apga', 'Number Of APGA');
                $apgaField->setOptions([
                    '1' => '1',
                    '5' => '5',
                    '10' => '10'
                ]);
                echo $apgaField;
                ?>

                <br>
                <?php echo $form->field($model, 'birth_weight', ' Birth Weight(g)')?>
                <?php echo $form->field($model, 'head_circumference_at_birth', 'Head Circumference at Birth(cm)')?>
                <?php echo $form->field($model, 'baby_length_at_birth', 'Baby Length at Birth(cm)')?>


                <?php
                $healthConditionField = new Dropdown($model, 'health_condition', ' Health Condition of NewBorn Baby');
                $healthConditionField->setOptions([
                    'normal' => 'Normal',
                    'needs special care' => 'Needs Special Care',
                ]);
                echo $healthConditionField;
                ?>

                <?php
                $vitaminField = new Dropdown($model, 'vitamin_k', 'Vitamin K');
                $vitaminField->setOptions([
                    'given' => 'Given',
                    'not given' => 'Not Given',
                ]);
                echo $vitaminField;
                ?>




    </div>

    <button type="submit" class="btn-submit">Submit</button>
    <?php echo Form::end()?>
</div>

</div>