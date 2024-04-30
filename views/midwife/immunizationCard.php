<?php
/** @var $this app\core\view */

use app\core\Application;
use app\core\form\DropDown;
use app\core\form\Form;
use app\core\form\RadioButton;
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
<link rel="stylesheet" href="./assets/styles/styles.css">

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
        width: 250px;
        height: 140px;
        border-radius: 10px;
    }

    .btn-submit {
        background-color: #774020;
        color: white;
        font-size: 10px;
    }

    .card:hover {
        box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
    }

    .vaccineContainer {
        display: flex;
        flex-direction: column;
        padding: 2px 16px;
        margin 10px;
        align-items: flex-start;
        justify-content: space-around;
        gap: 40px
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
    .content{
        margin-left: 280px;

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

<?php
$childId = isset($_GET['childid']) ? $_GET['childid'] : null;
$vaccineNumber = isset($_GET['VaccineNumber']) ? $_GET['VaccineNumber'] : null;
$batchNo1 = isset($_GET['BatchNo1']) ? $_GET['BatchNo1'] : null;

if ($childId !== null) {
    $immunit = new Immunization();
    $vaccineArray = $immunit->getImmunization($childId);
}
?>



<div class="vaccinesCards">
    <div class="vaccineBox">
        <h1>Child Immunization Card</h1>
        <h2>At Birth</h2>
        <div class="vaccines">
            <div class="card">
                <div class="vaccineContainer">
                    <h4>B.C.G 1st dose</h4>
                    <?php foreach ($vaccineArray as $vaccine): ?>
                        <?php if ($vaccine->vac_id === '1'): ?>
                            <div>
                                <p>Time: <?php echo $vaccine->timestamp; ?></p>
                                <p>Batch No: <?php echo $vaccine->BatchNo; ?></p>
                            </div>
                            <?php break; ?>
                        <?php endif; ?>
                    <?php endforeach; ?>
                    <?php if (!in_array('1', array_column($vaccineArray, 'vac_id'))): ?>
                        <button type="button" class="btn-submit showPopup" data-target="myPopup" onclick="updateVaccineNumber('1')">Not Vaccinated</button>
                    <?php endif; ?>
                </div>
            </div>

            <div class="card">
                <div class="vaccineContainer">
                    <h4>B.C.G 2nd dose</h4>
                    <?php foreach ($vaccineArray as $vaccine): ?>
                        <?php if ($vaccine->vac_id === '2'): ?>
                            <div>
                                <p>Time: <?php echo $vaccine->timestamp; ?></p>
                                <p>Batch No: <?php echo $vaccine->BatchNo; ?></p>
                            </div>
                            <?php break; ?>
                        <?php endif; ?>
                    <?php endforeach; ?>
                    <?php if (!in_array('2', array_column($vaccineArray, 'vac_id'))): ?>
                        <button type="button" class="btn-submit showPopup" data-target="myPopup" onclick="updateVaccineNumber('2')">Not Vaccinated</button>
                    <?php endif; ?>
                </div>
            </div>

        </div>

        <!-- Repeat similar structure for other vaccination stages -->

        <h2>2 Months Completed</h2>

        <div class="vaccines">
            <div class="card">
                <div class="vaccineContainer">
                    <h4>DPT 1</h4>
                    <?php foreach ($vaccineArray as $vaccine): ?>
                        <?php if ($vaccine->vac_id === '3'): ?>
                            <div>
                                <p>Time: <?php echo $vaccine->timestamp; ?></p>
                                <p>Batch No: <?php echo $vaccine->BatchNo; ?></p>
                            </div>
                            <?php break; ?>
                        <?php endif; ?>
                    <?php endforeach; ?>
                    <?php if (!in_array('3', array_column($vaccineArray, 'vac_id'))): ?>
                        <button type="button" class="btn-submit showPopup" data-target="myPopup" onclick="updateVaccineNumber('2')">Not Vaccinated</button>
                    <?php endif; ?>
                </div>
            </div>

            <div class="card">
                <div class="vaccineContainer">
                    <h4>OPV 1</h4>
                    <button type="submit" class="btn-submit showPopup" data-target="myPopup">Not Vaccinated</button>
                </div>
            </div>

            <div class="card">
                <div class="vaccineContainer">
                    <h4>Hepatitis B1</h4>
                    <button type="submit" class="btn-submit showPopup" data-target="myPopup">Not Vaccinated</button>
                </div>
            </div>


        </div>

        <h2>4 Months Completed</h2>

        <div class="vaccines">
            <div class="card">
                <div class="vaccineContainer">
                    <h4>DPT 2</h4>
                    <button type="submit" class="btn-submit">Not Vaccinated</button>
                </div>
            </div>

            <div class="card">
                <div class="vaccineContainer">
                    <h4>OPV 2</h4>
                    <button type="submit" class="btn-submit">Not Vaccinated</button>
                </div>
            </div>

            <div class="card">
                <div class="vaccineContainer">
                    <h4>Hepatitis B2</h4>
                    <button type="submit" class="btn-submit">Not Vaccinated</button>
                </div>
            </div>

        </div>

        <h2>6 Months Completed</h2>

        <div class="vaccines">
            <div class="card">
                <div class="vaccineContainer">
                    <h4>DPT 3</h4>
                    <button type="submit" class="btn-submit">Not Vaccinated</button>
                </div>
            </div>

            <div class="card">
                <div class="vaccineContainer">
                    <h4>OPV 3</h4>
                    <button type="submit" class="btn-submit">Not Vaccinated</button>
                </div>
            </div>

            <div class="card">
                <div class="vaccineContainer">
                    <h4>Hepatitis B3</h4>
                    <button type="submit" class="btn-submit">Not Vaccinated</button>
                </div>
            </div>

        </div>

        <h2>9 Months Completed</h2>

        <div class="vaccines">
            <div class="card">
                <div class="vaccineContainer">
                    <h4>MEASLES</h4>
                    <button type="submit" class="btn-submit">Not Vaccinated</button>
                </div>
            </div>

            <div class="card">
                <div class="vaccineContainer">
                    <h4>VITAMIN A</h4>
                    <button type="submit" class="btn-submit">Not Vaccinated</button>
                </div>
            </div>

        </div>

        <h2>18 Months Completed</h2>

        <div class="vaccines">
            <div class="card">
                <div class="vaccineContainer">
                    <h4>DPT 4</h4>
                    <button type="submit" class="btn-submit">Not Vaccinated</button>
                </div>
            </div>

            <div class="card">
                <div class="vaccineContainer">
                    <h4>OPV 4</h4>
                    <button type="submit" class="btn-submit">Not Vaccinated</button>
                </div>
            </div>

            <div class="card">
                <div class="vaccineContainer">
                    <h4>VITAMIN A</h4>
                    <button type="submit" class="btn-submit">Not Vaccinated</button>
                </div>
            </div>

        </div>

        <h2>3 Years Completed</h2>

        <div class="vaccines">
            <div class="card">
                <div class="vaccineContainer">
                    <h4>MEASLES & RUBELLA</h4>
                    <button type="submit" class="btn-submit">Not Vaccinated</button>
                </div>
            </div>

            <div class="card">
                <div class="vaccineContainer">
                    <h4>VITAMIN A</h4>
                    <button type="submit" class="btn-submit">Not Vaccinated</button>
                </div>
            </div>

        </div>

        <h2>5 Years Completed</h2>

        <div class="vaccines">
            <div class="card">
                <div class="vaccineContainer">
                    <h4>D.T</h4>
                    <button type="submit" class="btn-submit">Not Vaccinated</button>
                </div>
            </div>

            <div class="card">
                <div class="vaccineContainer">
                    <h4>OPV 5</h4>
                    <button type="submit" class="btn-submit">Not Vaccinated</button>
                </div>
            </div>

        </div>

    </div>
</div>

<div id="myPopup" class="popup">
    <div class="popup-content">
        <h1 style="color: rgb(0, 15, 128);">Vaccination Details<br/><br/></h1>
        <form action="" method="post">

            <div class="form-group">
                <label>Child Id:</label>
                <input type="text" id="childid" name="child_id" value="" class="form-control">
                <label>Vaccine Number:</label>
                <input type="text" id="VaccineNumber" name="vac_id" value="" class="form-control">
                <label>Batch No:</label>
                <input type="text" id="BatchNo1" name="BatchNo" value=""  class="form-control ">
                <div class="invalid-feedback"></div>
                <br>

            </div>
            <div class="buttonRow">
                <button type="submit" id="updateButton" class="btn-submit">Vaccinated</button>
                <button id="closePopup" class="btn-submit" style="background-color: brown;">Close</button>
            </div>
        </form>
    </div>
    <br>
</div>

<script>
    document.getElementById("closePopup").addEventListener("click", function(event) {
        event.preventDefault();
    });
</script>

<script>
    var selectedVaccine = null;
    selectedVaccine = document.getElementById('VaccineNumber');
    var popupButtons = document.querySelectorAll('.showPopup');
    var currentChild = document.getElementById('childid');
    const queryString = window.location.search;
    const urlParams = new URLSearchParams(queryString);
    const childId = urlParams.get('childid');

    currentChild.value = childId;

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
    function updateVaccineNumber(number) {
        selectedVaccine.value = number;
    }
</script>

<?php
$immunit = new Immunization();

var_dump($immunit->getImmunization(1));
//result like this
//array(1) { [0]=> object(stdClass)#33 (5) { ["recordId"]=> int(1) ["child_id"]=> int(1) ["vac_id"]=> string(1) "1" ["BatchNo"]=> string(4) "1234" ["timestamp"]=> string(19) "2024-04-29 18:13:27" } }
?>
