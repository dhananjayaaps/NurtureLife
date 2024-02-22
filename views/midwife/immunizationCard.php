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
/** @var $modelUpdate immunizationCard **/
//?>


<link rel="stylesheet" href="./assets/styles/Form.css">
<link rel="stylesheet" href="./assets/styles/table.css">
<link rel="stylesheet" href="./assets/styles/immunizationCard.css">

<style>
    .card {
        box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
        transition: 0.3s;
        width: 40%;
    }

    .card:hover {
        box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
    }

    .container {
        padding: 2px 16px;
    }

    .vaccinesCards{
        display: flex;

    }

    .vaccines{
        display:flex;
        gap:20px;
    }

    h1{
        text-align: center;
        padding: 20px;
    }

    h2{
       text-align: left;
        padding: 10px;

    }

    h4{
        padding: 10px;
    }

    btn-submit{

    }


</style>
<div class="vaccinesCards ">
    <div class="shadowBox">
        <h1>IMMUNIZATION CARD</h1>

        <?php $form = Form::begin('', "post")?>

        <h2>At Birth</h2>

        <div class="vaccines">
            <div class="card">
                <div class="container">
                    <h4><b>B.C.G 1st dose</b></h4>
                    <button type="submit" class="btn-submit">Vaccinated</button>
                </div>
            </div>

            <div class="card">
                <div class="container">
                    <h4><b>B.C.G 2nd dose</b></h4>
                    <p>(If no scar even at 6 months)</p>
                    <?php echo $form->field($model, 'batch_no2', 'Batch No:')?>
                </div>
            </div>

            <div class="card">
                <div class="container">
                    <?php echo $form->field($model, 'effects1', 'Adverse effects following immunization:')?>
                </div>
            </div>

            <div class="card">
                <div class="container">
                    <?php
                        $bcgField = new Dropdown($model, 'bcg', 'B.C.G Scar');
                        $bcgField->setOptions([
                            'yes' => 'Present',
                            'no' => 'Absent',
                        ]);
                        echo $bcgField;
                        ?>
                </div>
            </div>

        </div>


        <h2>Two Months Completed</h2>

        <div class="vaccines">
            <div class="card">
                <div class="container">
                    <h4><b>DPT 1</b></h4>
                    <?php echo $form->field($model, 'batch_no3', 'Batch No:')?>
                </div>
            </div>

            <div class="card">
                <div class="container">
                    <h4><b>OPV 1</b></h4>
                    <?php echo $form->field($model, 'batch_no4', 'Batch No:')?>
                </div>
            </div>

            <div class="card">
                <div class="container">
                    <h4><b>Hepatitis B1</b></h4>
                    <?php echo $form->field($model, 'batch_no5', 'Batch No:')?>
                </div>
            </div>

            <div class="card">
                <div class="container">
                    <?php echo $form->field($model, 'effects2', 'Adverse effects following immunization:')?>
                </div>
            </div>
        </div>

        <h2>Four Months Completed</h2>

        <div class="vaccines">
            <div class="card">
                <div class="container">
                    <h4><b>DPT 2</b></h4>
                    <?php echo $form->field($model, 'batch_no6', 'Batch No:')?>
                </div>
            </div>

            <div class="card">
                <div class="container">
                    <h4><b>OPV 2</b></h4>
                    <?php echo $form->field($model, 'batch_no7', 'Batch No:')?>
                </div>
            </div>

            <div class="card">
                <div class="container">
                    <h4><b>Hepatitis B2</b></h4>
                    <?php echo $form->field($model, 'batch_no8', 'Batch No:')?>
                </div>
            </div>

            <div class="card">
                <div class="container">
                    <?php echo $form->field($model, 'effects3', 'Adverse effects following immunization:')?>
                </div>
            </div>
        </div>

        <h2>Six Months Completed</h2>

        <div class="vaccines">
            <div class="card">
                <div class="container">
                    <h4><b>DPT 3</b></h4>
                    <?php echo $form->field($model, 'batch_no9', 'Batch No:')?>
                </div>
            </div>

            <div class="card">
                <div class="container">
                    <h4><b>OPV 3</b></h4>
                    <?php echo $form->field($model, 'batch_no10', 'Batch No:')?>
                </div>
            </div>

            <div class="card">
                <div class="container">
                    <h4><b>Hepatitis B3</b></h4>
                    <?php echo $form->field($model, 'batch_no11', 'Batch No:')?>
                </div>
            </div>

            <div class="card">
                <div class="container">
                    <?php echo $form->field($model, 'effects4', 'Adverse effects following immunization:')?>
                </div>
            </div>
        </div>

        <h2>Nine Months Completed</h2>

        <div class="vaccines">
            <div class="card">
                <div class="container">
                    <h4><b>MEASLES</b></h4>
                    <?php echo $form->field($model, 'batch_no9', 'Batch No:')?>
                </div>
            </div>

            <div class="card">
                <div class="container">
                    <h4><b>OPV 3</b></h4>
                    <?php echo $form->field($model, 'batch_no10', 'Batch No:')?>
                </div>
            </div>

            <div class="card">
                <div class="container">
                    <h4><b>Hepatitis B3</b></h4>
                    <?php echo $form->field($model, 'batch_no11', 'Batch No:')?>
                </div>
            </div>

            <div class="card">
                <div class="container">
                    <?php echo $form->field($model, 'effects4', 'Adverse effects following immunization:')?>
                </div>
            </div>
        </div>

    </div>

