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
?>

<link rel="stylesheet" href="./assets/styles/Form.css">
<link rel="stylesheet" href="./assets/styles/Form.css">
<link rel="stylesheet" href="./assets/styles/mother.css">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<div class="content">
<div class="first-column">
    <h1>Prenatal Mother - Fetal Kick Count</h1>
    <div>
        <div class="lineChart">
             <p id="total"></p>
            <p id="avg"></p>
            <canvas id="lineChart" ></canvas>
        </div>
    </div>
</div>
<div class="column-container"  >
    <div id="Add_section" class="right-content">
        <div class="shadowBox">
            <h2>Add a Record <br/><br/></h2>
            <?php $form = Form::begin('', "post")?>
            <?php echo $form->field($model, 'KickCount', 'Kick Count ')?>
            <button type="submit" class="btn-submit">Submit</button>
            <?php echo Form::end()?>
        </div>
    </div>

    <div id="Update_section" class="left-content">
        <div class="shadowBox">
            <div>
                <br>
                <form>
                    <h2 style="color: rgb(0, 15, 128);">Update Kick Count<br/><br/></h2>
                    <br>

                    <div class="form-group">
                        <label for="UpdateKickCount">Correct Kick Count</label>
                        <input type="text" id="UpdateKickCount" name="UpdateKickCount" value=""  class="form-control ">
                        <div class="invalid-feedback">
                        </div>
                    </div>

                </form>
                <div class="buttonRow">
                    <button type="submit" id="updateButton" class="btn-submit">
                        Update
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!--<canvas id="lineChart" width="400" height="200"></canvas>-->

<div id="targetElement"></div>
</div>







<script>
    // Sample data received from the database
    var dbData = <?php echo $model->getKicks() ?>;
    var count = 0;
    for (let i = 0; i < dbData.length; i++) {
        var day = dbData[i];
        count  = count + day.Count;
    }
    var avg = parseInt(count/dbData.length);
    document.getElementById("total").innerHTML = `Total Kicks: ${count}`;
    document.getElementById("avg").innerHTML = `Average Kicks: ${avg}`;



    // Extracting dates and counts from the database data
    var dates = dbData.map(entry => new Date(entry.Date).toLocaleDateString('en-US', { month: 'short', day: 'numeric' }));
    var counts = dbData.map(entry => entry.Count);

    // Creating the chart data
    var data = {
        labels: dates,
        datasets: [{
            label: "Daily Counts",
            borderColor: "#1F2B6C",
            backgroundColor: "rgba(75, 192, 192, 0.2)",
            data: counts
        }]
    };



    var options = {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    };

    // Creating the chart
    var ctx = document.getElementById('lineChart').getContext('2d');
    var myLineChart = new Chart(ctx, {
        type: 'line',
        data: data,
        options: options
    });
</script>

<script>


    var isNew = <?php echo json_encode((new Fetalkick())->isNew()) ?>;
    console.log(isNew);
    var elementA = document.getElementById("Add_section");
    var elementU = document.getElementById("Update_section");

    // Hide the element
    if (isNew == 1) {
        elementU.style.display = "none";
    } else {
        elementA.style.display = "none";
    }

</script>

<script>
    document.getElementById('updateButton').addEventListener('click', function(e) {
        e.preventDefault();

        const KickCount = document.querySelector('input[name="UpdateKickCount"]').value;

        const formData = new FormData();
        formData.append('KickCount', KickCount);
        console.log(KickCount)
        // formData.append('MotherId', Mid);

        const url = '/fetalkickUpdate';

        fetch(url, {
            method: 'POST',
            body: formData,
        })
            .then(response => {
                if (response.ok) {
                    window.location.reload();
                } else {
                    return response.json();
                }
            })
            .then(responseData => {
                if (responseData.errors) {
                    const invalidFeedbackElements = document.querySelectorAll('.invalid-feedback');
                    for (const key in responseData.errors) {
                        console.log(key)
                        if (responseData.errors[key].length > 0) {
                            const feedbackElement = document.querySelector(`[name="Update${key.charAt(0).toUpperCase() + key.slice(1)}"] + .invalid-feedback`);
                            if (feedbackElement) {
                                console.log("found");
                                feedbackElement.innerHTML = "<svg aria-hidden=\"true\" class=\"stUf5b qpSchb\" fill=\"currentColor\" focusable=\"false\" width=\"16px\" height=\"16px\" viewBox=\"0 0 24 24\" xmlns=\"https://www.w3.org/2000/svg\"><path d=\"M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-2h2v2zm0-4h-2V7h2v6z\"></path></svg>" +
                                    responseData.errors[key][0];
                            }
                        }
                    }
                } else {
                    console.log(responseData);
                }
            })
            .catch(error => {
                console.error(error);
            });
    });
</script>