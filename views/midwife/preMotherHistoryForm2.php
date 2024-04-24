<?php
/** @var $this app\core\view */

use app\core\Application;
use app\core\form\DropDown;
use app\core\form\Form;
use app\models\Mother;

$this->title = 'Present Mother History Form1';
?>

<?php
/** @var $model Midwife **/
/** @var $modelUpdate Midwife **/
//?>



<link rel="stylesheet" href="./assets/styles/Form.css">
<link rel="stylesheet" href="./assets/styles/table.css">

<style>
    .shadowBox{
        width: 100%;
    }

    .form-container {
        display: flex;
        justify-content: space-between;
        max-width: 800px; /* Adjust the width as needed */
        margin: 0 auto;
        gap: 20px;
        flex-direction: column;
        align-items: center;
        /*flex-wrap: wrap;*/
    }

    .form-content-container{
        display: flex;
        flex-direction: row;
        justify-content: space-between;
        margin: 0 auto;
        gap: 30px;
    }

    .btn-submit{
        width: 90px;
    }

    .form-column {
        width: 48%; /* Adjust the width as needed */
        box-sizing: border-box;
        padding: 0 10px;
        display: flex;
        flex-direction: column;
    }

    .form-column:last-child {
        margin-left: 2%; /* Adjust the margin between columns as needed */
    }

    .btn-submit {
        margin-top: 20px;
    }

    .break-line {
        border-top: 1px solid #FFF;
        margin-top: 8px;
        margin-bottom: 8px;
    }

</style>

<div class="Mothers content">

    <div class="shadowBox">
        <div class="form-container">

            <h2>Medical and Surgical History</h2>
            <?php $form = Form::begin('', "post")?>

            <div class="form-content-container">

                <div class="form-column">

                    <div class="row" style="display: flex; flex-direction: column; gap: 5px">
                        <label>
                           1. Diabetes:
                            <div class="break-line"></div>
                            <input type="radio" name="diabetes" value="Yes"> Yes
                            <input type="radio" name="diabetes" value="No"> No
                        </label>

                        <div class="break-line"></div>

                        <label>
                           2. Hypertension:
                            <div class="break-line"></div>
                            <input type="radio" name="hypertension" value="Yes"> Yes
                            <input type="radio" name="hypertension" value="No"> No
                        </label>

                        <div class="break-line"></div>

                        <label>
                           3. Cardiac Diseases:
                            <div class="break-line"></div>
                            <input type="radio" name="cardiac_diseases" value="Yes"> Yes
                            <input type="radio" name="cardiac_diseases" value="No"> No
                        </label>

                        <div class="break-line"></div>

                        <label>
                           4. Renal Diseases:
                            <div class="break-line"></div>
                            <input type="radio" name="renal_diseases" value="Yes"> Yes
                            <input type="radio" name="renal_diseases" value="No"> No
                        </label>

                        <label>
                           5. Hepatic Diseases:
                            <div class="break-line"></div>
                            <input type="radio" name="hepatic_diseases" value="Yes"> Yes
                            <input type="radio" name="hepatic_diseases" value="No"> No
                        </label>
                    </div>
                </div>

                <div class="form-column">
                    <label>
                        6. Psychiatric Illnesses:
                        <div class="break-line"></div>
                        <input type="radio" name="psychiatric_illnesses" value="Yes"> Yes
                        <input type="radio" name="psychiatric_illnesses" value="No"> No
                    </label>

                    <div class="break-line"></div>

                    <label>
                        7. Epilepsy:
                        <div class="break-line"></div>
                        <input type="radio" name="epilepsy" value="Yes"> Yes
                        <input type="radio" name="epilepsy" value="No"> No
                    </label>

                    <div class="break-line"></div>

                    <label>
                        8. Malignancies:
                        <div class="break-line"></div>
                        <input type="radio" name="malignancies" value="Yes"> Yes
                        <input type="radio" name="malignancies" value="No"> No
                    </label>

                    <div class="break-line"></div>

                    <label>
                        9. Haematological Diseases:
                        <div class="break-line"></div>
                        <input type="radio" name="haematological_diseases" value="Yes"> Yes
                        <input type="radio" name="haematological_diseases" value="No"> No
                    </label>

                    <div class="break-line"></div>

                    <label>
                        10. Tuberculosis:
                        <div class="break-line"></div>
                        <input type="radio" name="tuberculosis" value="Yes"> Yes
                        <input type="radio" name="tuberculosis" value="No"> No
                    </label>

                </div>

                <div class="form-column">


                   <div class="row"  style="display: flex; flex-direction: column; gap: 5px">
                       <label>
                           11. Thyroid Diseases:
                           <div class="break-line"></div>
                           <input type="radio" name="thyroid_diseases" value="Yes"> Yes
                           <input type="radio" name="thyroid_diseases" value="No"> No
                       </label>
                       <label>
                          12. Bronchial Asthma:
                           <div class="break-line"></div>
                           <input type="radio" name="bronchial_asthma" value="Yes"> Yes
                           <input type="radio" name="bronchial_asthma" value="No"> No
                       </label>

                       <div class="break-line"></div>

                       <label>
                          13. Previous DTV:
                           <div class="break-line"></div>
                           <input type="radio" name="previous_dtv" value="Yes"> Yes
                           <input type="radio" name="previous_dtv" value="No"> No
                       </label>

                       <div class="break-line"></div>

                       <label>
                          14. Surgeries other than LSCS:
                           <div class="break-line"></div>
                           <input type="radio" name="surgeries" value="Yes"> Yes
                           <input type="radio" name="surgeries" value="No"> No
                       </label>

                       <div class="break-line"></div>

                       <label>
                          15. Social risk factors:
                           <div class="break-line"></div>
                           <input type="radio" name="social_risk" value="Yes"> Yes
                           <input type="radio" name="social_risk" value="No"> No
                       </label>
                       <div class="break-line"></div>

                       <?php echo $form->field($model, 'other', '16. Other(Specify)')?>

                   </div>
               </div>
            </div>
        </div>

        <button type="submit" class="btn-submit">Submit</button>
        <?php echo Form::end()?>
    </div>
</div>








