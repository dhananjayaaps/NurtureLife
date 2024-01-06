<?php
/** @var $this app\core\view */

use app\core\Application;
use app\core\form\Form;
use app\models\Mother;

$this->title = 'Child';
?>

<?php
/** @var $model Child **/
/** @var $modelUpdate Child **/
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

<div class="Child content">

    <div class="shadowBox">
        <h2>Add a New Child<br></h2>
        <?php $form = Form::begin('', "post")?>

        <div class="form-column">
            <?php echo $form->field($model, 'nic', 'NIC Number')?>
            <?php echo $form->field($model, 'Mother_Name', 'Mother Name')?>
            <?php echo $form->field($model, 'Child_Name', 'Child Name ')?>
            <?php echo $form->field($model, 'Register_NO', 'Register NO')?>
    </div>

    <div class="form-column">
        <div class="row" style="display: flex; flex-direction: column; gap: 10px"
        <label for="Birth_Date">Birth Date</label>
        <input type="date" id="birthDate" name="birthDate">

        </div>
        <br>

        <?php echo $form->field($model, 'Birth_Place', 'Birth Place')?>
        <?php echo $form->field($model, 'Age', 'Age')?>
        <?php echo $form->field($model, 'Address', 'Address')?>
    </div>
</div>


<button type="submit" class="btn-submit">Submit</button>
<?php echo Form::end()?>
</div>

</div>

