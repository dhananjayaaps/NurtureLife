<?php
/** @var $this app\core\view */

use app\core\Application;
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

<div class="Mothers content">
    <div class="shadowBox">
        <h2>Add a New Mother</h2>
        <?php $form = Form::begin('/preMotherForm', "post")?>
    </div>
</div>

<!---->
<!--        <div class="form-column">-->
<!--            --><?php //echo $form->field($model, 'rubella_immunization', 'Rubella Immunization')?>
<!--            --><?php //echo $form->field($model, 'emergencyNumber', 'Emergency Number')?>
<!---->
<!--            <div class="row" style="display: flex; flex-direction: column; gap: 10px">-->
<!--                <label for="maritalStatus">Marital Status</label>-->
<!--                <select id="maritalStatus" name="maritalStatus">-->
<!--                    <option value="" selected disabled>Select Marital Status</option>-->
<!--                    <option value="married">Married</option>-->
<!--                    <option value="unmarried">Unmarried</option>-->
<!--                </select>-->
<!---->
<!--                <label for="marriageDate">Marriage Date</label>-->
<!--                <input type="date" id="marriageDate" name="marriageDate">-->
<!---->
<!--                <label for="bloodGroup">Blood Group</label>-->
<!--                <select id="bloodGroup" name="bloodGroup">-->
<!--                    <option value="" selected disabled>Select Blood Group</option>-->
<!--                    <option value="A+">A+</option>-->
<!--                    <option value="A-">A-</option>-->
<!--                    <!-- ... other options ... -->-->
<!--                </select>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!---->
<!--    <div class="multiRowForm">-->
<!--        <button type="submit" class="btn-submit">Submit</button>-->
<!--    </div>-->
<!--    --><?php //echo Form::end()?>
<!--</div>-->
<!---->
<!---->
