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

                <?php echo $form->dateField($model, 'date', 'Date of Form Completion')?>

                <?php
                $prematureField = new Dropdown($model, 'premature_births', 'Premature Births');
                $prematureField->setOptions([
                    'yes' => 'Yes',
                    'no' => 'No',

                ]);
                echo $prematureField;
                ?>

                <?php
                $lowBirthField = new Dropdown($model, 'low_birth_weight', 'Low Birth Weight ');
                $lowBirthField->setOptions([
                    'yes' => 'Yes',
                    'no' => 'No',

                ]);
                echo $lowBirthField;
                ?>

                <?php
                $NeonatalField = new Dropdown($model, 'neonatal_complications', 'Neonatal Complications ');
                $NeonatalField->setOptions([
                    'yes' => 'Yes',
                    'no' => 'No',

                ]);
                echo $NeonatalField;
                ?>

                <?php
                $congenitalField = new Dropdown($model, 'congenital_disorders', 'Congenital Disoders ');
                $congenitalField->setOptions([
                    'yes' => 'Yes',
                    'no' => 'No',

                ]);
                echo $congenitalField;
                ?>

                <?php
                $acuteConditionsField = new Dropdown($model, 'acute_conditions', 'Acute Conditions of the Mother after delivery  ');
                $acuteConditionsField->setOptions([
                    'yes' => 'Yes',
                    'no' => 'No',

                ]);
                echo $acuteConditionsField;
                ?>

                <?php
                $complementaryFeedingField = new Dropdown($model, 'complementary_feeding', 'Complementary feeding during the first six months');
                $complementaryFeedingField->setOptions([
                    'yes' => 'Yes',
                    'no' => 'No',

                ]);
                echo $complementaryFeedingField;
                ?>

                <?php
                $growthField = new Dropdown($model, 'growth_retardation', 'Growth Retardation');
                $growthField->setOptions([
                    'yes' => 'Yes',
                    'no' => 'No',

                ]);
                echo $growthField;
                ?>

                <?php
                $difficultyFeedingField = new Dropdown($model, 'difficulty_feeding', 'Difficulty Breastfeeding/Feeding');
                $difficultyFeedingField->setOptions([
                    'yes' => 'Yes',
                    'no' => 'No',

                ]);
                echo $difficultyFeedingField;
                ?>

                <?php
                $deathMoFaField = new Dropdown($model, 'death_of_mother_or_father', 'Death of Mother or Father');
                $deathMoFaField->setOptions([
                    'mother is dead' => 'Mother is dead',
                    'father is dead' => 'Father is dead',
                    'both are dead'  => 'Both are dead',

                ]);
                echo $deathMoFaField;
                ?>

                <?php
                $migrationField = new Dropdown($model, 'migration_of_mother_or_father', 'Migration of Mother or Father abraod');
                $migrationField->setOptions([
                    'mother left the country' => 'Mother left the Country',
                    'father left the country' => 'Father left the Country',
                    'both left the country'   => 'Both left the Country',

                ]);
                echo $migrationField;
                ?>

                <?php echo $form->field($model, 'other_reasons', 'Other Reasons')?>



            </div>

            <button type="submit" class="btn-submit">Submit</button>
            <?php echo Form::end()?>
        </div>

    </div>