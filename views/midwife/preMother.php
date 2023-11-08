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

            <div class="row" style="display: flex; flex-direction: column; gap: 10px"
                <label for="maritalStatus">Marital Status</label>
                <select id="maritalStatus" name="maritalStatus">
                    <option value="married">Married</option>
                    <option value="unmarried">Unmarried</option>
                </select>

                <label for="marriageDate">Marriage Date</label>
                <input type="date" id="marriageDate" name="marriageDate">

                <label for="bloodGroup">Blood Group</label>
                <select id="bloodGroup" name="bloodGroup">
                    <option value="A+">A+</option>
                    <option value="A-">A-</option>
                    <option value="B+">B+</option>
                    <option value="B-">B-</option>
                    <option value="B+">AB+</option>
                    <option value="B+">AB-</option>
                    <option value="B+">O+</option>
                    <option value="B-">O-</option>
                </select>
            </div>
            <br>
            <?php echo $form->field($model, 'Occupation','Occupation')?>
            <?php echo $form->field($model, 'Allergies', 'Allergies')?>
        </div>

        <div class="form-column">
            <?php echo $form->field($model, 'Consanguinity', 'Consanguinity')?>
            <?php echo $form->field($model, 'history_subfertility', 'history_subfertility')?>
            <?php echo $form->field($model, 'Hypertension', 'Hypertension')?>
            <?php echo $form->field($model, 'rubella_immunization', 'Rubella Immunization')?>
            <?php echo $form->field($model, 'emergencyNumber', 'Emergency Number')?>
        </div>
            </div>


        <button type="submit" class="btn-submit">Submit</button>
        <?php echo Form::end()?>
    </div>

</div>

