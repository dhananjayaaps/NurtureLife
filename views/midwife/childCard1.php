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
                <?php echo $form->field($model, 'child_id', 'Child ID')?>

                <?php echo $form->dateField($model, 'completion_date', 'Date of Form Completion')?>

                <?php
                $prematureField = new Dropdown($model, 'premature_births', 'Premature Births');
                $prematureField->setOptions([
                     'no' => 'No',
                     'yes' => 'Yes',

                ]);
                echo $prematureField;
                ?>

                <?php
                $lowBirthField = new Dropdown($model, 'low_birth_weight', 'Low Birth Weight ');
                $lowBirthField->setOptions([
                    'no' => 'No',
                    'yes' => 'Yes',

                ]);
                echo $lowBirthField;
                ?>

                <?php
                $NeonatalField = new Dropdown($model, 'neonatal_complications', 'Neonatal Complications ');
                $NeonatalField->setOptions([
                    'no' => 'No',
                    'yes' => 'Yes',

                ]);
                echo $NeonatalField;
                ?>

                <?php
                $congenitalField = new Dropdown($model, 'congenital_disorders', 'Congenital Disoders ');
                $congenitalField->setOptions([
                    'no' => 'No',
                    'yes' => 'Yes',

                ]);
                echo $congenitalField;
                ?>

                <?php
                $acuteConditionsField = new Dropdown($model, 'acute_conditions', 'Acute Conditions of the Mother after delivery  ');
                $acuteConditionsField->setOptions([
                    'no' => 'No',
                    'yes' => 'Yes',

                ]);
                echo $acuteConditionsField;
                ?>

                <?php
                $complementaryFeedingField = new Dropdown($model, 'complementary_feeding', 'Complementary feeding during the first six months');
                $complementaryFeedingField->setOptions([
                    'no' => 'No',
                    'yes' => 'Yes',

                ]);
                echo $complementaryFeedingField;
                ?>

                <?php
                $growthField = new Dropdown($model, 'growth_retardation', 'Growth Retardation');
                $growthField->setOptions([
                    'no' => 'No',
                    'yes' => 'Yes',


                ]);
                echo $growthField;
                ?>

                <?php
                $difficultyFeedingField = new Dropdown($model, 'difficulty_feeding', 'Difficulty Breastfeeding/Feeding');
                $difficultyFeedingField->setOptions([
                    'no' => 'No',
                    'yes' => 'Yes',

                ]);
                echo $difficultyFeedingField;
                ?>

                <?php
                $deathMoFaField = new Dropdown($model, 'death_of_mother_or_father', 'Death of Mother or Father');
                $deathMoFaField->setOptions([
                    '1' => 'No,Both are alive',
                    '2' => 'Mother is dead',
                    '3' => 'Father is dead',
                    '4' => 'Both are dead',

                ]);
                echo $deathMoFaField;
                ?>

                <?php
                $migrationField = new Dropdown($model, 'migration_of_mother_or_father', 'Migration of Mother or Father abraod');
                $migrationField->setOptions([
                    '1' => 'No,Both are in the country',
                    '2' => 'Mother left the Country',
                    '3' => 'Father left the Country',
                    '4' => 'Both left the Country',

                ]);
                echo $migrationField;
                ?>

                <?php echo $form->field($model, 'other_reasons', 'Other Reasons')?>



            </div>

            <button type="submit" class="btn-submit">Submit</button>
            <?php echo Form::end()?>
        </div>

    </div>