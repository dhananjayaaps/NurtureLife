<?php
/** @var $this app\core\view */

use app\core\Application;
use app\core\form\DropDown;
use app\core\form\Form;
use app\core\form\RadioButton;
use app\models\BabyCare;
use app\models\Child;
use app\models\Mother;

$this->title = 'Child';
?>

<?php
/** @var $model BabyCare **/

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

    .shadowBox{
        width: 600px;
    }

    .content{
        margin-left: 280px;
    }
</style>

<div class="Mothers content">
    <div class="shadowBox">
        <h2>CARE OF NEWBORN CHILD<br><br></h2>
        <?php $form = Form::begin('', "post")?>
        <div class="form-column">
            <div class="row" style="display: flex; flex-direction: column; gap: 10px">
                <?php
                $radioButton = new RadioButton($model, 'no_of_apga', '1. Number Of APGA');
                $radioButton->setOptions([
                    '1' => '1',
                    '5' => '5',
                    '10' => '10'
                ]);
                echo $radioButton;
                ?>

                <br>
                <?php echo $form->field($model, 'birth_weight', '2. Birth Weight(g)')?>
                <?php echo $form->field($model, 'head_circumference_at_birth', '3.Head Circumference at Birth(cm)')?>
                <?php echo $form->field($model, 'baby_length_at_birth', '4.Baby Length at Birth(cm)')?>


                <?php
                $radioButton = new RadioButton($model, 'health_condition', '5.Health Condition');
                $radioButton->setOptions([
                    '1' => 'Normal',
                    '0' => 'Needs special Care',
                ]);
                echo $radioButton;
                ?>

                <?php
                $radioButton = new RadioButton($model, 'vitamin_k', '6.Vitamin K');
                $radioButton->setOptions([
                    '1' => 'Given',
                    '0' => 'Not Given',
                ]);
                echo $radioButton;
                ?>
            </div>
        <button type="submit" class="btn-submit">Submit</button>
    <?php echo Form::end()?>
</div>

