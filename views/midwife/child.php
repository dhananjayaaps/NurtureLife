<?php
/** @var $this app\core\view */

use app\core\Application;
use app\core\form\Form;
use app\core\form\RadioButton;
use app\models\Child;
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

<h1>Midwife - Child</h1>
<div class="Child content">

    <div class="shadowBox">
        <h2>Add a New Child<br><br></h2>
        <?php $form = Form::begin('', "post")?>

        <div class="form-column">
            <?php echo $form->field($model, 'nic', 'NIC Number')?>
            <?php echo $form->field($model, 'Mother_Name', 'Mother Name')?>
            <?php echo $form->field($model, 'Child_Name', 'Child Name ')?>
            <?php echo $form->field($model, 'Register_NO', 'Register NO')?>

            <?php
            $radioButton = new RadioButton($model, 'Gender', 'Gender');
            $radioButton->setOptions([
                '1' => 'Male',
                '0' => 'Female',
            ]);
            echo $radioButton;
            ?>

            <?php echo $form->dateField($model, 'Birth_Date', 'Birth Date')?>
            <?php echo $form->field($model, 'Birth_Place', 'Birth Place')?>

    </div>
</div>


<button type="submit" class="btn-submit">Submit</button>
<?php echo Form::end()?>
</div>

