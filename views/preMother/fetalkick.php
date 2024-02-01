<?php
/** @var $this app\core\view */

use app\core\Application;
use app\core\form\Form;
use app\core\Model;
use app\models\Fetalkick;

$this->title = 'FetalKicks';
?>
<!---->
<?php
/** @var $model Fetalkick **/
/** @var $modelUpdate Fetalkick **/
//?>

<link rel="stylesheet" href="./assets/styles/Form.css">
<link rel="stylesheet" href="./assets/styles/Form.css">

<div>
    <br>
        <h1 style="color: rgb(0, 15, 128);">Update Kick Count<br/><br/></h1>
        <br>

            <div class="form-group">
                <label>Mother ID</label>
                <input type="text" id="UpdateId" name="UpdateId" value=""  class="form-control ">
                <div class="invalid-feedback">
                </div>
            </div>

            <div class="form-group">
                <label>Correct Kick Count</label>
                <input type="text" id="UpdateName" name="UpdateName" value=""  class="form-control ">
                <div class="invalid-feedback">
                </div>
            </div>

        </form>
        <div class="buttonRow">
            <button type="submit" id="updateButton" class="btn-submit">
                Update
            </button>
            <button id="closePopup" class="btn-submit" style="background-color: brown;">
                Close
            </button>
        </div>
</div>

<div>
    <div class="lineChart">
        Total Mothers: 450
        <canvas id="lineChart" ></canvas>
    </div>
</div>

<div class="right-content">
    <div class="shadowBox">
        <h2>Add a Record <br/><br/></h2>
        <?php $form = Form::begin('', "post")?>
        <?php echo $form->field($model, 'MotherId', 'Mother ID ')?>
        <?php echo $form->field($model, 'KickCount', 'Kick Count ')?>
        <button type="submit" class="btn-submit">Submit</button>
        <?php echo Form::end()?>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Sample data for the line chart
    var data = {
        labels: ["January", "February", "March", "April", "May"],
        datasets: [{
            label: "Daily Counts",
            borderColor: "#1F2B6C",
            backgroundColor: "rgba(75, 192, 192, 0.2)",
            data: [65, 59, 80, 81, 56]
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
</script>

<script>
    function fetchData(url) {

        fetch(url)
            .then(response => {
                if (!response.ok) {
                    throw new Error(`HTTP error! Status: ${response.status}`);
                }
                // Parse the response body as JSON
                return response.json();
            })
            .then(data => {
                console.log('Data received:', data);


            })
            .catch(error => {
                // Handle errors during the fetch operation
                console.error('Fetch error:', error);
            });
    }
</script>