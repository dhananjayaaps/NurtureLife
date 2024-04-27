<?php
/** @var $this app\core\view */

use app\core\Application;
use app\core\form\DropDown;
use app\core\form\Form;
use app\models\Mother;

$this->title = 'Child';
?>

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
        <h2>Preparedness Plan in an Emergency<br><br></h2>
        <?php $form = Form::begin('', "post")?>

        <div class="form-column">

            <div class="row" style="display: flex; flex-direction: column; gap: 10px">
                <?php echo $form->field($model, 'intended_hospital', 'Intended Hospital')?>
                <?php echo $form->field($model, 'transport_mode', 'Mode of Transport)')?>
                <?php echo $form->field($model, 'average_cost', 'Average Cost')?>
                <?php echo $form->field($model, 'home_distance', 'Distance from Home')?>
                <?php echo $form->field($model, 'time', 'Time taken to reach')?>

            </div>

            <button type="submit" class="btn-submit">Submit</button>
            <?php echo Form::end()?>
        </div>

    </div>
