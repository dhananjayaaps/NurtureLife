<!--<h1>Admin - Reports</h1>-->

<style>
    .content{
        justify-content: flex-start;
    }
</style>

<div class="content">
    <div class="column first-column">
        <div class="quick-access">

        </div>
    </div>
    <div class="column second-column">
        <div class="first-row">
            <div class="report-types">
                <div class="report-type addButtons">
                    <button class="addButton">New Borns</button>
                    <button class="addButton">New Registrations</button>
                    <button class="addButton">Mother Deaths</button>
                    <button class="addButton">Child Deaths</button>
                    <button class="addButton">Mother Deaths</button>
                    <button class="addButton">Child Deaths</button>
                </div>
            </div>
        </div>
        <div class="second-row">
            <div class="side-window" id="sideWindow">
                <h2 id="sideWindowTitle">Report Options</h2>
                <label for="timePeriod">Select Time Period:</label>
                <select id="timePeriod">
                    <option value="select">Select Option</option>
                    <option value="daily">Daily</option>
                    <option value="weekly">Weekly</option>
                    <option value="monthly">Monthly</option>
                    <option value="annual">Annual</option>
                </select>
                <div id="dateFields">
                    <!-- Date fields will be added here -->
                </div>
                <div class="buttons">
                    <button id="generateReport">Generate Report</button>
                    <button id="resetForm">Reset</button>
                </div>

                <!-- Display a loading message -->
                <div id="loadingMessage" style="display: none;">Generating report, please wait...</div>
                <!-- Display a download button -->
                <a id="downloadButton" href="#" download="report.pdf" style="display: none;">Download Report</a>
            </div>
        </div>
        <div>
            <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
            <link rel="stylesheet" type="text/css" href="./assets/styles/heatmap.css" />
            <script type="module" src="./assets/scripts/Heatmap.js"></script>
            <div id="floating-panel">
                <button id="toggle-heatmap">Toggle Heatmap</button>
                <button id="change-gradient">Change gradient</button>
                <button id="change-radius">Change radius</button>
                <button id="change-opacity">Change opacity</button>
            </div>
            <div id="map"></div>

            <script
                    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCun8jKr1zvi4wKd_1HwSuhM7i2KOAIkQI&callback=initMap&libraries=visualization&v=weekly"
                    defer
            >
            </script>
        </div>
    </div>
</div>

<script>
    const sideWindow = document.getElementById("sideWindow");
    const sideWindowTitle = document.getElementById("sideWindowTitle");
    const timePeriodSelect = document.getElementById("timePeriod");
    const dateFields = document.getElementById("dateFields");
    const loadingMessage = document.getElementById("loadingMessage");
    const downloadButton = document.getElementById("downloadButton");
    const generateReportButton = document.getElementById("generateReport");
    const resetFormButton = document.getElementById("resetForm");

    generateReportButton.addEventListener("click", () => {
    });

    const secondRowButtons = document.querySelectorAll(".addButton");
    secondRowButtons.forEach(button => {
        button.addEventListener("click", () => {
            sideWindowTitle.textContent = button.textContent;
        });
    });

    generateReportButton.addEventListener("click", () => {
        loadingMessage.style.display = "block";
        generateReportButton.disabled = true;
        setTimeout(() => {
            loadingMessage.style.display = "none";
            downloadButton.style.display = "inline";
        }, 2000);

    });

    resetFormButton.addEventListener("click", () => {
        timePeriodSelect.value = "select";
        dateFields.innerHTML = "";
        loadingMessage.style.display = "none";
        downloadButton.style.display = "none";
        generateReportButton.disabled = false;
    });

    timePeriodSelect.addEventListener("change", () => {
        const selectedTimePeriod = timePeriodSelect.value;
        dateFields.innerHTML = "";

        if (selectedTimePeriod === "daily") {
            dateFields.innerHTML = `
                    <label for="startDate">Start Date:</label>
                    <input type="date" id="startDate">
                    <label for="endDate">End Date:</label>
                    <input type="date" id="endDate">
                `;
        } else if (selectedTimePeriod === "weekly") {
            dateFields.innerHTML = `
                    <label for="startWeek">Start Week:</label>
                    <input type="week" id="startWeek">
                    <label for="endWeek">End Week:</label>
                    <input type="week" id="endWeek">
                `;
        } else if (selectedTimePeriod === "monthly") {
            dateFields.innerHTML = `
                    <label for="startMonth">Start Month:</label>
                    <input type="month" id="startMonth">
                    <label for="endMonth">End Month:</label>
                    <input type="month" id="endMonth">
                `;
        } else if (selectedTimePeriod === "annual") {
            dateFields.innerHTML = `
                    <label for="startYear">Start Year:</label>
                    <input type="number" id="startYear">
                    <label for="endYear">End Year:</label>
                    <input type="number" id="endYear">
                `;
        }
    });
</script>