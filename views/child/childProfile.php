<?php
/** @var $this app\core\view */

use app\core\Application;
use app\core\form\Form;
use app\core\Model;
use app\models\Fetalkick;

$this->title = 'FetalKicks';
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
    }

    .card {
        width: 200px;
        height: 200px;
        border: 1px solid #ccc;
        border-radius: 5px;
        padding: 10px;
    }

    .my-card{
        width: 200px;
        height: 60px;
        border: 1px solid #ccc;
        border-radius: 5px;
        padding: 10px;
    }

    .my-card:hover {
        background-color: #aecdf3;
    }

    .card.medical-card {
        width: 180px;
        height: 30px;
        border: 1px solid #ccc;
        border-radius: 5px;
        padding: 10px;
        margin-bottom: 5px;
    }

    .medical-card:hover {
        background-color: #aecdf3;
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

    a{
        text-decoration: none;
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

<h1>Child Profile</h1>
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
        <h2>Sineth Dhananjaya</h2>
        <br>
        <img class="rounded-image" src="./assets/images/baby_image.jpg" alt="profile"/>
        <br>
        <div class="form-group">
            <label>Mother's Name</label>
            <input type="text" class="form-control" value="Vishaka Devini" disabled>
        </div>
        <div class="form-group">
            <label>Email</label>
            <input type="text" class="form-control" value="vishaka108@gmail.com" disabled>
        </div>
        <div class="form-group">
            <label>Phone Number</label>
            <input type="text" class="form-control" value="0712345678" disabled>
        </div>
        <div class="form-group">
            <label>Address</label>
            <input type="text" class="form-control" value="515, Matara Road, Middeniya" disabled>
        </div>

    </div>

    <div class="row" style="height: 70vh">
        <h2>Basic Details</h2>
        <br>
        <div class="oneRow">
            <br>
            <div class="form-group">
                <label>Date of Birth</label>
                <input type="date" class="form-control" value="2023-02-09" disabled>
            </div>
            <div class="form-group">
                <label>Height</label>
                <input type="text" class="form-control" value="60cm" disabled>
            </div>
            <div class="form-group">
                <label>Weight</label>
                <input type="text" class="form-control" value="6Kg" disabled>
            </div>
            <div class="form-group">
                <label>Blood Group</label>
                <input type="text" class="form-control" value="A+" disabled>
            </div>
        </div>


        <div class="row">
            <h2>Child Forms</h2>
            <br>
            <div class="card-row">
                <div class="my-card">
                    <h3><b><a href="/childCard">Care of Newborn Baby</a></b></h3>
                </div>
                <div class="my-card">
                    <h3><b><a href="/childCard1">Reasons for Special Care</a></b></h3>
                </div>
                <div class="my-card">
                    <h3><b><a href="/childCard2">Newborn Baby's Health Chart</a></b></h3>
                </div>
                <div class="my-card">
                    <h3><b><a href="/immunizationCard">Immunization Card</a></b></h3>
                </div>
            </div>
        </div>


        <div class="row" >
            <h2>Child's Medical Report History</h2>
            <br>
            <div class="card-row">
                <div class="card plus-card" id="addNoteCard">
                    <span class="plus-icon">+</span>
                    <p>Add a Note</p>
                </div>
                <div class="card">
                    <h3><b>2024-11-12</b></h3><br>
                    <div class="card medical-card">
                    <p>Medical Reports</p>
                    </div>
                    <div class="card medical-card">
                        <p>Medicines</p>
                    </div>
                    <div class="card medical-card">
                        <p>Recommendations</p>
                    </div>
                    <br>
                    <b>Conclusion: Normal</b>
                </div>
                <div class="card">
                    <h3><b>2024-10-12</b></h3><br>
                    <div class="card medical-card">
                        <p>Medical Reports</p>
                    </div>
                    <div class="card medical-card">
                        <p>Medicines</p>
                    </div>
                    <div class="card medical-card">
                        <p>Recommendations</p>
                    </div>
                    <br>
                    <b>Conclusion: Normal</b>
                </div>
                <div class="card">
                    <h3><b>2024-09-12</b></h3><br>
                    <div class="card medical-card">
                        <p>Medical Reports</p>
                    </div>
                    <div class="card medical-card">
                        <p>Medicines</p>
                    </div>
                    <div class="card medical-card">
                        <p>Recommendations</p>
                    </div>
                    <br>
                    <b>Conclusion: Good</b>
                </div>
            </div>
        </div>


        <h5>See More ...</h5>
        <br>
        <h2>Child's Weight and Height Gain Charts</h2><br>
        <div class="column first-column">
            <div class="lineChart">
                <b><a href="/childweight">Weight Gain Chart</a></b>
                <canvas id="lineChart"></canvas>
            </div>
            <div class="lineChart">
                <b>Height Gain Chart</b>
                <canvas id="lineChart2"></canvas>
            </div>

        </div>

    </div>
</div>

<!--Scripts for the chart development. That is hardcoded-->

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    // Sample data for the line chart
    var data = {
        labels: ["January", "February", "March", "April", "May"],
        datasets: [{
            label :"weight(g)",
            borderColor: "#1F2B6C",
            backgroundColor: "rgba(75, 192, 192, 0.2)",
            data: [2500, 3000, 3700, 4200, 6000]

        }]
    };

    var data1 = {
        labels: ["January", "February", "March", "April", "May"],
        datasets: [{
            label :"height(cm)",
            borderColor: "#1F2B6C",
            backgroundColor: "rgba(75, 192, 192, 0.2)",
            data: [30, 38, 46, 55, 76]

        }]
    };

    var options = {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    };

    var ctx = document.getElementById('lineChart').getContext('2d');
    var myLineChart = new Chart(ctx, {
        type: 'line',
        data: data,
        options: options
    });

    var ctx = document.getElementById('lineChart2').getContext('2d');
    var myLineChart = new Chart(ctx, {
        type: 'line',
        data: data1,
        options: options
    });


</script>

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
