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
        box-sizing: border-box;
        padding: 0 10px;
    }

    .clear {
        clear: both;
    }
</style>

<div class="Child content">

    <div class="shadowBox">
        <h2>Add a New Child<br><br></h2>
        <?php $form = Form::begin('', "post")?>

        <div class="form-column">
            <?php echo $form->field($model, 'nic', '1. Mother NIC Number')?>

            <?php echo $form->field($model, 'Child_Name', '2. Child Name ')?>

            <?php
            $radioButton = new RadioButton($model, 'Gender', '3. Gender');
            $radioButton->setOptions([
                '1' => 'Male',
                '2' => 'Female'
            ]);
            echo $radioButton;
            ?>

            <?php echo $form->dateField($model, 'Birth_Date', '4. Birth Date')?>

            <?php echo $form->field($model, 'Birth_Place', '5. Birth Place')?>

    </div>
        <button type="submit" class="btn-submit">Submit</button>
</div>



<?php echo Form::end()?>
</div>

