<?php
/** @var $this app\core\view */

use app\core\Application;
use app\core\form\DropDown;
use app\core\form\Form;
use app\core\form\RadioButton;
use app\models\Mother;

$this->title = 'Mothers';
?>

<?php
/** @var $model Mother **/
/** @var $modelUpdate Mother **/
//?>



<link rel="stylesheet" href="./assets/styles/Form.css">
<!--<link rel="stylesheet" href="./assets/styles/table.css">-->
<link rel="stylesheet" href="./assets/styles/admin.css">

<style>
    .form-container {
        display: flex;
        flex-direction: column;
        gap: 20px;
        width: 100%;
        justify-content: space-around;
    }

    .form-content {
        display: flex;
        gap: 20px;
        flex-direction: row;
        flex-wrap: wrap;
        width: 100%;
        justify-content: space-around;
    }
    .form-column:last-child{
        margin-left: 0;
    }
    .form-column{
        display: flex;
        flex-direction: column;
        max-width: 200px;
    }

    .shadowBox{
        width: 100%;
    }
</style>

<div class="Mothers content">
    <div class="shadowBox">
        <div class="form-container">
            <h2>Add a New Mother</h2>
            <?php $form = Form::begin('', 'post')?>
            <div class="form-content">
                <div class="form-column">
                    <?php echo $form->field($model, 'nic', 'NIC Number')?>

                    <?php
                    $maritalStatusField = new Dropdown($model, 'MaritalStatus', 'Marital Status');
                    $maritalStatusField->setOptions([
                        'married' => 'Married',
                        'single' => 'Single Mother',
                        'divorce' => 'Divorced',
                    ]);
                    echo $maritalStatusField;
                    ?>

                    <?php
                    $bloodGroupField = new DropDown($model, 'BloodGroup', 'Blood Group');
                    $bloodGroupField->setOptions([
                        'A+' => 'A positive (A+)',
                        'A-' => 'A negative (A-)',
                        'B+' => 'B positive (B+)',
                        'B-' => 'B negative (B-)',
                        'AB+' => 'AB positive (AB+)',
                        'AB-' => 'AB negative (AB-)',
                        'O+' => 'O positive (O+)',
                        'O-' => 'O negative (O-)',
                    ]);
                    echo $bloodGroupField;
                    ?>

                    <?php echo $form->dateField($model, 'MarriageDate', 'Marriage Date')?>

                </div>

                <div class="form-column">
                    <?php echo $form->field($model, 'Occupation', 'Occupation')?>
                    <?php echo $form->field($model, 'emergencyNumber', 'Emergency Number')?>
                    <?php echo $form->dateField($model, 'DeliveryDate', 'Delivery Date')?>
                    <?php echo $form->field($model, 'Allergies', 'Allergies')?>
                </div>

                <div class="form-column">
                    <?php
                    $radioButton = new RadioButton($model, "Consanguinity", 'Consanguinity');
                    $radioButton->setOptions([
                        '1' => 'Yes',
                        '0' => 'No',
                    ]);
                    echo $radioButton;
                    ?>

                    <!--                <div class="break-line"></div>-->

                    <?php
                    $radioButton = new RadioButton($model, "history_subfertility", 'History subfertility');
                    $radioButton->setOptions([
                        '1' => 'Yes',
                        '0' => 'No',
                    ]);
                    echo $radioButton;
                    ?>

                    <!--                <div class="break-line"></div>-->

                    <?php
                    $radioButton = new RadioButton($model, "Hypertension", 'Hypertension');
                    $radioButton->setOptions([
                        '1' => 'Yes',
                        '0' => 'No',
                    ]);
                    echo $radioButton;
                    ?>

                    <!--                <div class="break-line"></div>-->

                    <?php
                    $radioButton = new RadioButton($model, "diabetes_mellitus", 'Diabetes Mellitus');
                    $radioButton->setOptions([
                        '1' => 'Yes',
                        '0' => 'No',
                    ]);
                    echo $radioButton;
                    ?>

                    <!--                <div class="break-line"></div>-->

                    <?php
                    $radioButton = new RadioButton($model, "rubella_immunization", 'Rubella Immunization');
                    $radioButton->setOptions([
                        '1' => 'Yes',
                        '0' => 'No',
                    ]);
                    echo $radioButton;
                    ?>
                    <div style="display: none">
                        <?php echo $form->field($model, 'location', 'Location')?>
                    </div>


                </div>
            </div>
        </div>

        <script type="text/javascript"
                src="https://maps.googleapis.com/maps/api/js?key=<?php echo $_ENV['MAP_API']?>"></script>
        <script src="https://unpkg.com/location-picker/dist/location-picker.min.js"></script>

        <div id="map"></div>

        <div style="display: none">
            <button id="confirmPosition">Confirm Position</button>
            <button id="findLocation">Find GPS Location</button>
        </div>

        <p>On idle position: <span id="onIdlePositionView"></span></p>
        <p>On click position: <span id="onClickPositionView"></span></p>

        <style type="text/css">
            #map {
                width: 100%;
                height: 480px;
            }
        </style>

        <script>
            var confirmBtn = document.getElementById('confirmPosition');
            var findLocationBtn = document.getElementById('findLocation');
            var onClickPositionView = document.getElementById('onClickPositionView');
            var onIdlePositionView = document.getElementById('onIdlePositionView');
            var locationText = document.getElementsByName('location')[0];

            function setCurrentLocationAsDefault(callback) {
                navigator.geolocation.getCurrentPosition(function(position) {
                    var currentLocation = {
                        lat: position.coords.latitude,
                        lng: position.coords.longitude
                    };

                    var lp = new locationPicker('map', {
                        setCurrentPosition: false,
                        lat: currentLocation.lat,
                        lng: currentLocation.lng
                    }, {
                        zoom: 20
                    });

                    confirmBtn.onclick = function () {
                        var location = lp.getMarkerPosition();
                        onClickPositionView.innerHTML = 'The chosen location is ' + location.lat + ',' + location.lng;
                        locationText.value = location.lat + ',' + location.lng;
                    };

                    google.maps.event.addListener(lp.map, 'idle', function (event) {
                        // Get current location and show it in HTML
                        var location = lp.getMarkerPosition();
                        onIdlePositionView.innerHTML = 'The chosen location is ' + location.lat + ',' + location.lng;
                        locationText.value = location.lat + ', ' + location.lng;
                    });

                    findLocationBtn.onclick = function() {

                        lp.map.setCenter(currentLocation);
                        lp.map.setZoom(20);
                        lp.setLocation(currentLocation);
                    };
                }, function() {
                    alert('Error: The Geolocation service failed.');
                });
            }

            setCurrentLocationAsDefault();
        </script>

        <br>
<!--        <h3>Allergies</h3><br>-->
<!--        <div id="allergies-container">-->
<!--            <div class="allergy">-->
<!--                <label for="allergy-type">Allergy Type:</label>-->
<!--                <select name="allergy-type" class="allergy-type">-->
<!--                    <option value="food">Food</option>-->
<!--                    <option value="drug">Drug</option>-->
<!--                    <option value="other">Other</option>-->
<!--                </select>-->
<!--                <label for="allergy-description">Description:</label>-->
<!--                <input type="text" name="allergy-description" class="allergy-description">-->
<!--            </div>-->
<!--        </div>-->
<!--        <button class="btn-add" id="add-allergy">Add New Allergy</button>-->
<!--        <br>-->

        <button type="submit" class="btn-submit">Submit</button>
        <?php echo Form::end()?>
    </div>
</div>


<!--<script>-->
<!--    document.getElementById('add-allergy').addEventListener('click', function (event) {-->
<!--        event.preventDefault(); // Prevent the default form submission behavior-->
<!---->
<!--        const allergiesContainer = document.getElementById('allergies-container');-->
<!--        const allergyTypeSelect = document.createElement('select');-->
<!--        allergyTypeSelect.name = 'allergy-type';-->
<!--        allergyTypeSelect.className = 'allergy-type';-->
<!--        allergyTypeSelect.innerHTML = `-->
<!--            <option value="food">Food</option>-->
<!--            <option value="drug">Drug</option>-->
<!--            <option value="other">Other</option>-->
<!--        `;-->
<!---->
<!--        const allergyDescriptionInput = document.createElement('input');-->
<!--        allergyDescriptionInput.type = 'text';-->
<!--        allergyDescriptionInput.name = 'allergy-description';-->
<!--        allergyDescriptionInput.className = 'allergy-description';-->
<!---->
<!--        const newAllergy = document.createElement('div');-->
<!--        newAllergy.classList.add('allergy');-->
<!--        newAllergy.appendChild(document.createElement('label')).textContent = 'Allergy Type:';-->
<!--        newAllergy.appendChild(allergyTypeSelect);-->
<!--        newAllergy.appendChild(document.createElement('label')).textContent = 'Description:';-->
<!--        newAllergy.appendChild(allergyDescriptionInput);-->
<!---->
<!--        allergiesContainer.appendChild(newAllergy);-->
<!--    });-->
<!---->
<!--    document.getElementById('btn-submit').addEventListener('submit', function (event) {-->
<!--        const allergies = [];-->
<!--        const allergyElements = document.querySelectorAll('.allergy');-->
<!--        allergyElements.forEach(allergyElement => {-->
<!--            const allergyType = allergyElement.querySelector('.allergy-type').value;-->
<!--            const allergyDescription = allergyElement.querySelector('.allergy-description').value;-->
<!--            allergies.push([allergyType, allergyDescription]);-->
<!--        });-->
<!--        console.log(allergies);-->
<!--    });-->
<!--</script>-->
