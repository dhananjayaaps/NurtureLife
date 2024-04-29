<?php
/** @var $this app\core\view */

use app\core\Application;
use app\core\form\DropDown;
use app\core\form\Form;
use app\models\Immunization;
use app\models\Mother;

$this->title = 'Child';
?>

<?php
/** @var $model Immunization **/
/** @var $modelUpdate immunization **/
//?>


<link rel="stylesheet" href="./assets/styles/Form.css">
<link rel="stylesheet" href="./assets/styles/table.css">
<link rel="stylesheet" href="./assets/styles/immunizationCard.css">

<style>

    .shadBox {
        background-color: #f9f9f9;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        display: flex;
        flex-direction: column;
        width: 80%;
    }
    .card {
        box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
        transition: 0.3s;
        width: 60%;
    }

    .card:hover {
        box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
    }

    .container {
        padding: 2px 16px;
    }

    .vaccinesCards{
        display: flex;
        justify-content: space-around;
        width: 80%;
    }

    .vaccines{
        display:flex;
        gap:20px;
    }
    .container{

    }

    .btn-submit button{
        padding-bottom: 10px;
    }

    h1{
        text-align: center;
        padding: 20px;
    }

    h2{
        text-align: left;
        padding: 30px 0 20px 0;

    }

    h4{
        padding: 10px;
    }

</style>

<h1>Midwife - Immunization card</h1>
<div class="vaccinesCards">
    <div class="vaccineBox">
        <h1>IMMUNIZATION CARD</h1>

        <?php $form = Form::begin('', "post")?>

        <h2>At Birth</h2>

        <div class="vaccines">
            <div class="card">
                <div class="container">
                    <h4>B.C.G 1st dose</h4>
                    <button type="button" class="btn-submit showPopup" data-target="myPopup">Not Vaccinated</button>
                </div>
            </div>

            <div class="card">
                <div class="container">
                    <h4>B.C.G 2nd dose</h4>
                    <button type="button" class="btn-submit showPopup" data-target="myPopup">Not Vaccinated</button>
                </div>
            </div>
        </div>

        <!-- Repeat similar structure for other vaccination stages -->

        <h2>2 Months Completed</h2>

        <div class="vaccines">
            <div class="card">
                <div class="container">
                    <h4>DPT 1</h4>
                    <button type="submit" class="btn-submit showPopup" data-target="myPopup">Not Vaccinated</button>
                </div>
            </div>

            <div class="card">
                <div class="container">
                    <h4>OPV 1</h4>
                    <button type="submit" class="btn-submit showPopup" data-target="myPopup">Not Vaccinated</button>
                </div>
            </div>

            <div class="card">
                <div class="container">
                    <h4>Hepatitis B1</h4>
                    <button type="submit" class="btn-submit showPopup" data-target="myPopup">Not Vaccinated</button>
                </div>
            </div>


        </div>

        <h2>4 Months Completed</h2>

        <div class="vaccines">
            <div class="card">
                <div class="container">
                    <h4>DPT 2</h4>
                    <button type="submit" class="btn-submit">Not Vaccinated</button>
                </div>
            </div>

            <div class="card">
                <div class="container">
                    <h4>OPV 2</h4>
                    <button type="submit" class="btn-submit">Not Vaccinated</button>
                </div>
            </div>

            <div class="card">
                <div class="container">
                    <h4>Hepatitis B2</h4>
                    <button type="submit" class="btn-submit">Not Vaccinated</button>
                </div>
            </div>

        </div>

        <h2>6 Months Completed</h2>

        <div class="vaccines">
            <div class="card">
                <div class="container">
                    <h4>DPT 3</h4>
                    <button type="submit" class="btn-submit">Not Vaccinated</button>
                </div>
            </div>

            <div class="card">
                <div class="container">
                    <h4>OPV 3</h4>
                    <button type="submit" class="btn-submit">Not Vaccinated</button>
                </div>
            </div>

            <div class="card">
                <div class="container">
                    <h4>Hepatitis B3</h4>
                    <button type="submit" class="btn-submit">Not Vaccinated</button>
                </div>
            </div>

        </div>

        <h2>9 Months Completed</h2>

        <div class="vaccines">
            <div class="card">
                <div class="container">
                    <h4>MEASLES</h4>
                    <button type="submit" class="btn-submit">Not Vaccinated</button>
                </div>
            </div>

            <div class="card">
                <div class="container">
                    <h4>VITAMIN A</h4>
                    <button type="submit" class="btn-submit">Not Vaccinated</button>
                </div>
            </div>

        </div>

        <h2>18 Months Completed</h2>

        <div class="vaccines">
            <div class="card">
                <div class="container">
                    <h4>DPT 4</h4>
                    <button type="submit" class="btn-submit">Not Vaccinated</button>
                </div>
            </div>

            <div class="card">
                <div class="container">
                    <h4>OPV 4</h4>
                    <button type="submit" class="btn-submit">Not Vaccinated</button>
                </div>
            </div>

            <div class="card">
                <div class="container">
                    <h4>VITAMIN A</h4>
                    <button type="submit" class="btn-submit">Not Vaccinated</button>
                </div>
            </div>

        </div>

        <h2>3 Years Completed</h2>

        <div class="vaccines">
            <div class="card">
                <div class="container">
                    <h4>MEASLES & RUBELLA</h4>
                    <button type="submit" class="btn-submit">Not Vaccinated</button>
                </div>
            </div>

            <div class="card">
                <div class="container">
                    <h4>VITAMIN A</h4>
                    <button type="submit" class="btn-submit">Not Vaccinated</button>
                </div>
            </div>

        </div>

        <h2>5 Years Completed</h2>

        <div class="vaccines">
            <div class="card">
                <div class="container">
                    <h4>D.T</h4>
                    <button type="submit" class="btn-submit">Not Vaccinated</button>
                </div>
            </div>

            <div class="card">
                <div class="container">
                    <h4>OPV 5</h4>
                    <button type="submit" class="btn-submit">Not Vaccinated</button>
                </div>
            </div>

        </div>

        <?php $form = Form::end()?>

    </div>
</div>

<div id="myPopup" class="popup">
    <div class="popup-content">
        <h1 style="color: rgb(0, 15, 128);">Vaccination Details<br/><br/></h1>
        <form action="">

            <div class="form-group">

                <label>Batch No:</label>
                <input type="text" id="BatchNo1" name="BatchNo1" value=""  class="form-control ">
                <div class="invalid-feedback"></div>

                <label>Adverse effects following Immunization: </label>
                <input type="text" id="Effects1" name="Effects1" value=""  class="form-control ">
                <div class="invalid-feedback"></div>

                <?php
                $bcgField = new Dropdown($model, 'bcg_scars', 'BCG Scars');
                $bcgField->setOptions([
                    1 => 'Absent',
                    2 => 'Present',

                ]);
                echo $bcgField;
                ?>
            </div>
        </form>
        <div class="buttonRow">
            <button type="submit" id="updateButton" class="btn-submit">Vaccinated</button>
            <button id="closePopup" class="btn-submit" style="background-color: brown;">Close</button>
        </div>
    </div>
    <br>
</div>


<script>
    var popupButtons = document.querySelectorAll('.showPopup');

    popupButtons.forEach(function(button) {
        button.addEventListener("click", function () {
            var targetPopupId = this.getAttribute('data-target');
            var targetPopup = document.getElementById(targetPopupId);
            if (targetPopup) {
                targetPopup.classList.add("show");
            }
        });
    });

    var closeButton = document.getElementById('closePopup');
    var myPopup = document.getElementById('myPopup');

    closeButton.addEventListener("click", function () {
        myPopup.classList.remove("show");
    });

    window.addEventListener("click", function (event) {
        if (event.target == myPopup) {
            myPopup.classList.remove("show");
        }
    });
</script>
