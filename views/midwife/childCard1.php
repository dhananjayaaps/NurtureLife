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
/** @var $modelUpdate childCard1 **/
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
        <h2>REASONS FOR SPECIAL CARE<br><br></h2>
        <?php $form = Form::begin('', "post")?>

        <div class="form-column">

            <div class="row" style="display: flex; flex-direction: column; gap: 10px">

                <?php
                $radioButton = new RadioButton($model, 'premature_births', '1.Premature Births');
                $radioButton->setOptions([
                    '1' => 'Yes',
                    '2' => 'No',
                ]);
                echo $radioButton;
                ?>

                <?php
                $radioButton = new RadioButton($model, 'low_birth_weight', '2.Low Birth Weight');
                $radioButton->setOptions([
                    '1' => 'Yes',
                    '2' => 'No',
                ]);
                echo $radioButton;
                ?>

                <?php
                $radioButton = new RadioButton($model, 'congenital_disorders', '3.Congenital Disorders');
                $radioButton->setOptions([
                    '1' => 'Yes',
                    '2' => 'No',
                ]);
                echo $radioButton;
                ?>

                <?php
                $radioButton = new RadioButton($model, 'neonatal_complications', '4.Neonatal Complications');
                $radioButton->setOptions([
                    '1' => 'Yes',
                    '2' => 'No',
                ]);
                echo $radioButton;
                ?>

                <?php
                $radioButton = new RadioButton($model, 'acute_conditions', '5.Acute Conditions');
                $radioButton->setOptions([
                    '1' => 'Yes',
                    '2' => 'No',
                ]);
                echo $radioButton;
                ?>

                <?php
                $radioButton = new RadioButton($model, 'complementary_feeding', '6.Complementary Feeding');
                $radioButton->setOptions([
                    '1' => 'Yes',
                    '2' => 'No',
                ]);
                echo $radioButton;
                ?>
            </div>

            <div class="row" style="display: flex; flex-direction: column; gap: 10px">

                <?php
                $radioButton = new RadioButton($model, 'growth_retardation', '7.Growth Retardation');
                $radioButton->setOptions([
                    '1' => 'Yes',
                    '2' => 'No',
                ]);
                echo $radioButton;
                ?>

                <?php
                $radioButton = new RadioButton($model, 'difficulty_feeding', '8.Difficulty Feeding');
                $radioButton->setOptions([
                    '1' => 'Yes',
                    '2' => 'No',
                ]);
                echo $radioButton;
                ?>

                <?php
                $radioButton = new RadioButton($model, 'death_of_mother_or_father', '9.Death of Mother or Father');
                $radioButton->setOptions([
                    '1' => 'Yes',
                    '2' => 'No',
                ]);
                echo $radioButton;
                ?>

                <?php
                $radioButton = new RadioButton($model, 'migration_of_mother_or_father', '10.Migration of Mother or Father Abraod');
                $radioButton->setOptions([
                    '1' => 'No,Both are in the country',
                    '2' => 'Mother left the Country',
                    '3' => 'Father left the Country',
                    '4' => 'Both left the Country',

                ]);
                echo $radioButton;
                ?>

                <?php echo $form->field($model, 'other_reasons', '11.Other Reasons')?>

            </div>
            <button type="submit" class="btn-submit">Submit</button>
            <?php echo Form::end()?>
        </div>
    </div>