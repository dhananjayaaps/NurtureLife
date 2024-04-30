<?php
/** @var $this app\core\view */

use app\core\Application;
use app\core\form\Form;
use app\core\Model;
use app\models\Fetalkick;
use app\models\Mother;

$this->title = 'Mother Profile';
?>
<?php
/** @var $model Fetalkick **/
/** @var $modelUpdate Fetalkick **/
//?>

<link rel="stylesheet" href="./assets/styles/Form.css">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<style>
    .MotherProfile{
        margin-left: 100px;
        display: flex;

        flex-direction: column;
    }

    .rounded-image {
        border-radius: 50%;
        overflow: hidden;
        width: 200px;
        height: 200px;
    }

    .rounded-image img {
        align-items: center;
        width: auto; /* Ensures the image fits within its parent container */
        height: auto; /* Maintains aspect ratio of the image */
    }

    .MotherProfile {
        margin-left: 100px;
        display: flex;
        flex-direction: row;
        gap: 20px;
    }

    .oneRow{
        display: flex;
        flex-direction: row;
    }

    .row {
        display: flex;
        flex-direction: column;
    }

    .card-row {
        display: flex;
        align-items: flex-start;
        margin-bottom: 20px;
        gap: 20px;
        height: max-content;
    }

    .card {
        width: 200px;
        height: 100%;
        border: 1px solid #ccc;
        border-radius: 5px;
        padding: 10px;
    }

    .card.plus-card {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        cursor: pointer;
    }

    .card.plus-card:hover {
        background-color: #f0f0f0;
    }

    .plus-icon {
        font-size: 24px;
        margin-bottom: 5px;
    }

    h2 {
        margin-top: 20px;
        color: #1F2B6C;
    }
    h3 {
        color: #002a1a;
    }

    .popup {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        z-index: 9999;
        justify-content: center;
        align-items: center;
        padding-left: 250px;
        padding-top: 100px;
    }

    .popup-content {
        background-color: white;
        padding: 20px;
        border-radius: 5px;
        max-width: 80%; /* maximum width of the popup content */
        overflow: auto; /* enable scrolling if content exceeds the popup height */
    }

</style>

<?php
$motherId = isset($_GET['id']) ? $_GET['id'] : null;
$motherData = (new Mother())->getMotherDetails($motherId)[0];
?>

<div>
<h1>Prenatal Mother - Profile</h1>
<div id="myPopup" class="popup">
    <div class="popup-content">
        <h1 style="color:green;">Mother Diagnostic Card</h1>
        <label for="">Diagnosis</label>
        <textarea name="" id="" cols="30" rows="10" style="width: 100%; height: 80px;"></textarea>
        <label for="">Recomondations</label>
        <textarea name="" id="" cols="30" rows="10" style="width: 100%; height: 80px;"></textarea>
        <label for="">Tests to be done</label>
        <textarea name="" id="" cols="30" rows="10" style="width: 100%; height: 80px;"></textarea>
        <label for="">Prescription</label>
        <textarea name="" id="" cols="30" rows="10" style="width: 100%; height: 80px;"></textarea>
        <div class="buttonRow">
            <button id="closePopup" class="btn-submit">
                Save
            </button>
            <button id="closePopup" class="btn-submit" style="background-color: brown;">
                Close
            </button>
        </div>
    </div>
</div>


<div class="MotherProfile">
    <div class="row">
        <h2><?php echo $motherData->firstname ?> <?php echo $motherData->lastname ?></h2>
        <br>
        <img class="rounded-image" src="./assets/images/men_user.jpg" alt="profile"/>
        <br>
        <div class="form-group">
            <label>Email</label>
            <input type="text" class="form-control" value=<?php echo $motherData->email?> disabled>
        </div>
        <div class="form-group">
            <label>Phone Number</label>
            <input type="text" class="form-control" value=<?php echo $motherData->contact_no?> disabled>
        </div>
        <div class="form-group">
            <label>Address</label>
            <input type="text" class="form-control" value=<?php echo $motherData->home_number; echo ', '; echo $motherData->lane; echo ', '; echo $motherData->city;?> , <?php echo $motherData->lane; echo $motherData->city ?>  disabled>
        </div>
        <div class="form-group">
            <label>Date of Birth</label>
            <input type="date" class="form-control" value=<?php echo $motherData->DOB?> disabled>
        </div>
    </div>

    <div class="row" style="height: 70vh">
        <h2>Basic Details</h2>
        <br>
        <div class="oneRow">
            <br>
            <div class="form-group">
                <label>Weight</label>
                <input type="text" class="form-control" value='64.5Kg' disabled>
            </div>
            <div class="form-group">
                <label>Diabetes Mellitus</label>
                <input type="text" class="form-control" value=<?php echo $motherData->diabetes_mellitus?> disabled>
            </div>
            <div class="form-group">
                <label>Blood Group</label>
                <input type="text" class="form-control" value=<?php echo $motherData->BloodGroup?> disabled>
            </div>
            <div class="form-group">
                <label>Allergies</label>
                <input type="text" class="form-control" value=<?php echo $motherData->Allergies?> disabled>
            </div>
        </div>

        <div class="row">
            <h2>Mother Forms</h2>
            <br>
            <div class="card-row">
                <div class="my-card">
                    <h3><b><a href="/preMotherHistoryForm1"> Present Obstetric Mother History</a></b></h3>
                </div>
                <div class="my-card">
                    <h3><b><a href="/preMotherHistoryForm2">Medical and Surgical History</a></b></h3>
                </div>
                <div class="my-card">
                    <h3><b><a href="/preMotherHistoryForm3">Family History</a></b></h3>
                </div>
                <div class="my-card">
                    <h3><b><a href="/personalInformationForm">Personal Information</a></b></h3>
                </div>
            </div>
        </div>

        <h2>Medical History</h2>
        <br>
        <div class="card-row">
            <div class="card plus-card" id="addNoteCard">
                <span class="plus-icon">+</span>
                <p>Add a Note</p>
            </div>
            <div class="card">
                <h3>2024-12-18</h3><br>
                <b>Reminders</b><br>
                <p>Please ensure the patient is properly prepared for the colonoscopy.</p>
            </div>


            <div class="card">
                <h3>2024-11-03</h3><br>
                <b>Tests to be done: </b><br>
                <div style="background-color: #f2f2f2; padding: 5px; margin-bottom: 5px;">
                    <span>Eye exam</span><br>
                    <span>Thyroid function test</span><br>
                    <span>Liver function test</span>
                </div>
                <b>Reminders</b><br>
                <p>Check for any contraindications before prescribing calcium supplements.</p>
            </div>

            <div class="card">
                <h3>2024-10-12</h3><br>
                <b>Tests to be done: </b><br>
                <div style="background-color: #f2f2f2; padding: 5px; margin-bottom: 5px;">
                    <span>Blood pressure test</span><br>
                </div>
                <b>Reminders</b><br>
                <p>Monitor the patient's blood pressure regularly if beta-blockers are prescribed.</p>
            </div>

        </div>
        <h5>See More ...</h5>
        <br>
        <?php echo (new Mother())->getMotherChildrenHTML($motherId);?>
<!--        <h2>Children</h2><br>-->
<!--        <div class="card-row">-->
<!--            <div class="card">-->
<!--                <h3>Sineth Dhananjaya</h3><br>-->
<!--                <b>DOB : </b>2020-08-06<br><br>-->
<!--            </div>-->
<!--            <div class="card">-->
<!--                <h3>Sameera Dilhara</h3><br>-->
<!--                <b>DOB: </b>2020-08-06<br><br>-->
<!--            </div>-->
<!--        </div>-->

    </div>
</div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        var addNoteCard = document.getElementById("addNoteCard");

        var popup = document.getElementById("myPopup");

        var closePopupButton = popup.querySelector("#closePopup");

        addNoteCard.addEventListener("click", function() {
            popup.style.display = "block";
        });

        closePopupButton.addEventListener("click", function() {
            popup.style.display = "none";
        });
    });
</script>
