<?php
/** @var $this app\core\view */

use app\core\Application;
use app\core\form\DropDown;
use app\core\form\Form;
use app\models\Mother;
use app\models\PostMotherDetails;

$this->title = 'Present Mother History Form1';
?>

<?php
/** @var $model PostMotherDetails **/
/** @var $modelUpdate PostMotherDetails **/
//?>



<link rel="stylesheet" href="./assets/styles/Form.css">
<link rel="stylesheet" href="./assets/styles/table.css">

<style>
    .form-container {
        display: flex;
        justify-content: space-between;
        max-width: 800px; /* Adjust the width as needed */
        margin: 0 auto;
    }

    .form-column {
        width: 48%; /* Adjust the width as needed */
        box-sizing: border-box;
        padding: 0 10px;
    }

    .form-column:last-child {
        margin-left: 2%; /* Adjust the margin between columns as needed */
    }

    .btn-submit {
        margin-top: 20px;
    }

    .break-line {
        border-top: 1px solid #FFF;
        margin-top: 12px;
        margin-bottom: 10px;
    }
</style>

<div class="Mothers content">

    <div class="shadowBox">
        <h2>Postnatal Clinic Care</h2>
        <?php $form = Form::begin('', "post")?>

        <div class="form-container">

            <div class="form-column">

                <div class="row" style="display: flex; flex-direction: column; gap: 10px">
                    <label>
                        1. Breast Problems:
                        <div class="break-line"></div>
                        <input type="radio" name="breast_problems" value="Yes"> Yes
                        <input type="radio" name="breast_problems" value="No"> No
                    </label>

                    <div class="break-line"></div>

                    <label>
                        2. Abnormal Vaginal Discharge:
                        <div class="break-line"></div>
                        <input type="radio" name="abnormal_vaginal_discharge" value="Yes"> Yes
                        <input type="radio" name="abnormal_vaginal_discharge" value="No"> No
                    </label>

                    <div class="break-line"></div>

                    <label>
                        3. Excessive Vaginal Bleeding:
                        <div class="break-line"></div>
                        <input type="radio" name="excessive_vaginal_bleeding" value="Yes"> Yes
                        <input type="radio" name="excessive_vaginal_bleeding" value="No"> No
                    </label>

                    <div class="break-line"></div>

                    <label>
                        4. Pallor:
                        <div class="break-line"></div>
                        <input type="radio" name="pallor" value="Yes"> Yes
                        <input type="radio" name="pallor" value="No"> No
                    </label>

                    <div class="break-line"></div>

                    <label>
                        5. Lcterus:
                        <div class="break-line"></div>
                        <input type="radio" name="lcterus" value="Yes"> Yes
                        <input type="radio" name="lcterus" value="No"> No
                    </label>

                    <div class="break-line"></div>

                    <label>
                        6. Dema(ankle and/or facial):
                        <div class="break-line"></div>
                        <input type="radio" name="dema" value="Yes"> Yes
                        <input type="radio" name="dema" value="No"> No
                    </label>

                    <div class="break-line"></div>


                </div>
            </div>

            <div class="form-column">

                <div class="row"  style="...">
                    <label>
                        7. Blood Pressure:
                        <div class="break-line"></div>
                        <input type="radio" name="bp" value="Normal"> Normal
                        <input type="radio" name="bp" value="Irregular"> Irregular
                    </label>

                    <div class="break-line"></div>

                    <label>
                        8. Cardiovascular System:
                        <div class="break-line"></div>
                        <input type="radio" name="cardiovascular_system" value="Normal"> Normal
                        <input type="radio" name="cardiovascular_system" value="Unusual"> Unusual
                    </label>

                    <div class="break-line"></div>

                    <label>
                        9. Respiratory System:
                        <div class="break-line"></div>
                        <input type="radio" name="respiratory_system" value="Normal"> Normal
                        <input type="radio" name="respiratory_system" value="Unusual"> Unusual
                    </label>

                    <div class="break-line"></div>

                    <label>
                        10. Abdominal Examination:
                        <div class="break-line"></div>
                        <input type="radio" name="abdominal_examination" value="Normal"> Normal
                        <input type="radio" name="abdominal_examination" value="Unusual"> Unusual
                    </label>

                    <div class="break-line"></div>

                    <label>
                        11. Mental Status:
                        <div class="break-line"></div>
                        <input type="radio" name="mental_status" value="Normal"> Normal
                        <input type="radio" name="mental_status" value="Unusual"> Unusual
                    </label>

                    <div class="break-line"></div>

                    <label>
                        12. Family Planning Method Chosen:
                        <div class="break-line"></div>
                        <input type="radio" name="family_planning_method" value="1"> DMPA <br>
                        <input type="radio" name="family_planning_method" value="2"> IUD  <br>
                        <input type="radio" name="family_planning_method" value="3"> Female Sterilization <br>
                        <input type="radio" name="family_planning_method" value="4"> Other
                    </label>

                    <div class="break-line"></div>


                </div>

            </div>

        </div>

        <button type="submit" class="btn-submit">Submit</button>
        <?php echo Form::end()?>
    </div>
</div>








