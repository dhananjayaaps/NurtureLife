<!--<h1>Admin - Reports</h1>-->
<?php use app\models\Mother;
?>
<link rel="stylesheet" href="./assets/styles/Form.css">
<style>
    .content{
        justify-content: flex-start;
    }
</style>
<style>
    /*.column .second-column{*/
    /*    width: 100%;*/
    /*    display: flex;*/
    /*    flex-direction: row;*/
    /*    justify-content: space-between;*/
    /*}*/
    .content {
        width: 100%;
        display: flex;
        flex-direction: column;
        justify-content: space-around;
    }

    .content .column {
        display: flex;
        flex-direction: row;
        flex-wrap: wrap;
        height: fit-content;
        gap: 20px;
        justify-content: space-around;

    .shadowBox{
        height: 500px;
        width: 500px;

    }
    .mapContent{
        height: 100%;
        width: 100%;
    }

    .dateRow{
        display: flex;
        flex-direction: row;
        justify-content: space-between;
        margin-bottom: 10px;
    }

</style>

<h1>Mother Registrations Report</h1>

<div>
    <div class="column second-column">

        <div class="shadowBox">
            <div class="dateRow">
                <div class="form-group">
                    <label for="startDate">Start Date:</label>
                    <input type="date" id="startDate" name="startDate" class="form-control">
                </div>

                <div class="form-group">
                    <label for="endDate">End Date:</label>
                    <input type="date" id="endDate" name="endDate" class="form-control">
                </div>
            </div>
            <button class="btn-submit" onclick="updateChart()">Update Chart</button>


        </div>

        <div class="shadowBox">
            <div class="lineChart">
                <canvas id="lineChart" style="display: block; box-sizing: border-box; height: 250px; width: 500px;"></canvas>
            </div>
        </div>

    </div>
</div>


<script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
<link rel="stylesheet" type="text/css" href="./assets/styles/heatmap.css" />
<script type="module" src="./assets/scripts/Heatmap.js"></script>

<script src="https://maps.googleapis.com/maps/api/js?key=<?php echo $_ENV['MAP_API']?>&callback=initMap&libraries=visualization&v=weekly" defer></script>

<script>
    var Registrations = <?php echo (new Mother)->getDailyRegistrationCount(); ?>;
</script>

<script>
    var data = [
        {"Registration_Date": "2024-03-06", "Registration_Count": 1},
        {"Registration_Date": "2024-04-07", "Registration_Count": 1},
        {"Registration_Date": "2024-04-09", "Registration_Count": 2},
        {"Registration_Date": "2024-04-25", "Registration_Count": 1},
        {"Registration_Date": "2024-04-26", "Registration_Count": 1},
        {"Registration_Date": "2024-04-27", "Registration_Count": 1}
    ];

    // Populate arrays with data
    var today = new Date();
    var maxDate = new Date(today.getFullYear(), today.getMonth(), today.getDate());

    // Get date from last month as minDate
    var lastMonthDate = new Date(today.getFullYear(), today.getMonth() - 1, today.getDate());
    var minDate = new Date(lastMonthDate.getFullYear(), lastMonthDate.getMonth(), lastMonthDate.getDate());

    // Initialize an object to store registration counts by date
    var registrationCountsByDate = {};

    // Populate registrationCountsByDate object with existing data
    data.forEach(function(item) {
        registrationCountsByDate[item.Registration_Date] = item.Registration_Count;
    });

    // Fill in missing dates between minDate and maxDate with 0 registration count
    for (var date = new Date(minDate); date <= maxDate; date.setDate(date.getDate() + 1)) {
        var dateString = date.toISOString().split('T')[0];
        if (!(dateString in registrationCountsByDate)) {
            registrationCountsByDate[dateString] = 0;
        }
    }

    // Sort the registration counts by date
    var sortedDates = Object.keys(registrationCountsByDate).sort();
    var registrationDates = [];
    var registrationCounts = [];
    sortedDates.forEach(function(dateString) {
        registrationDates.push(dateString);
        registrationCounts.push(registrationCountsByDate[dateString]);
    });

    // Chart data
    var chartData = {
        labels: registrationDates,
        datasets: [{
            label: 'Registration Count',
            data: registrationCounts,
            borderColor: 'rgba(75, 192, 192, 1)',
            backgroundColor: 'rgba(75, 192, 192, 0.2)',
            tension: 0.4,
            borderWidth: 1
        }]
    };

    // Chart options
    var options = {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    };

    // Get canvas element
    var ctx = document.getElementById('lineChart').getContext('2d');

    // Create the chart
    var myLineChart = new Chart(ctx, {
        type: 'line',
        data: chartData,
        options: options
    });

    function updateChart() {
        // Get selected start and end dates
        var startDate = new Date(document.getElementById('startDate').value);
        var endDate = new Date(document.getElementById('endDate').value);

        // If end date is before start date, swap them
        if (endDate < startDate) {
            var temp = endDate;
            endDate = startDate;
            startDate = temp;
        }

        // Initialize an object to store registration counts by date
        var registrationCountsByDate = {};

        // Populate registrationCountsByDate object with existing data
        data.forEach(function(item) {
            registrationCountsByDate[item.Registration_Date] = item.Registration_Count;
        });

        // Fill in missing dates between startDate and endDate with 0 registration count
        for (var date = new Date(startDate); date <= endDate; date.setDate(date.getDate() + 1)) {
            var dateString = date.toISOString().split('T')[0];
            if (!(dateString in registrationCountsByDate)) {
                registrationCountsByDate[dateString] = 0;
            }
        }

        // Sort the registration counts by date
        var sortedDates = Object.keys(registrationCountsByDate).sort();
        var registrationDates = [];
        var registrationCounts = [];
        sortedDates.forEach(function(dateString) {
            registrationDates.push(dateString);
            registrationCounts.push(registrationCountsByDate[dateString]);
        });

        // Chart data
        var chartData = {
            labels: registrationDates,
            datasets: [{
                label: 'Registration Count',
                data: registrationCounts,
                borderColor: 'rgba(75, 192, 192, 1)',
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                tension: 0.4,
                borderWidth: 1
            }]
        };

        // Chart options
        var options = {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        };

        // Get canvas element
        var ctx = document.getElementById('lineChart').getContext('2d');

        // Destroy the existing chart to avoid duplicate charts
        if (window.myLineChart) {
            window.myLineChart.destroy();
        }

        // Create the new chart
        window.myLineChart = new Chart(ctx, {
            type: 'line',
            data: chartData,
            options: options
        });
    }
</script>
