<?php
/** @var $this app\core\view */

use app\models\MotherSymptoms;
use app\models\Midwife;


$this->title = 'Reply Symptoms';
?>

<?php
/** @var $model Midwife **/
/** @var $modelUpdate Midwife **/
?>
<!--<link rel="stylesheet" href="./assets/styles/mother.css">-->
<!--<link rel="stylesheet" href="./assets/styles/table.css">-->
<link rel="stylesheet" href="./assets/styles/motherTable.css">

<div id="tablePopup" class="popup">
    <div class="popup-content">
        <span class="close" id="closePopupBtn">&times;</span>
        <h2>Symptom History</h2>
        <table id="popupTable">
            <thead>
            <tr>
                <th>Record Time</th>
                <th>Mother Name</th>
                <th>Symptom Description</th>
                <th>Priority Level</th>
                <th>Midwife Check</th>
                <th>Doctor Name</th>
                <th>Doctor Reply</th>
                <th>Reply Time</th>
            </tr>
            </thead>
            <tbody id="popupTableBody">
            </tbody>
        </table>
        <div id="popupPagination" class="pagination">
        </div>
    </div>
</div>

<div class="content">
    <div class="shadowBox">
        <h2>Mother Symptoms</h2>
        <table class="table-data">
            <thead>
            <tr>
                <th>Record Time</th>
                <th>Mother Name</th>
                <th>Symptom Description</th>
                <th>Priority Level</th>
                <th>Midwife Check</th>
                <th>Doctor Name</th>
                <th>Doctor Reply</th>
                <th>Reply Time</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody id="tableBody">
            </tbody>
        </table>
        <div class="pagination" id="pagination">
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {

        var data = <?php echo (new MotherSymptoms())->getSymptomsByMidwife() ?>;
        data.sort((a, b) => b.symptomRecNo - a.symptomRecNo);
        var docNames = <?php echo (new Midwife())->getClinicDoctors()  ?>;
        var momNames = <?php echo (new Midwife())->getMidwifeMothers() ?>;
        var itemsPerPage = 10;
        var currentPage = 1;

        function displayTableData() {
            var startIndex = (currentPage - 1) * itemsPerPage;
            var endIndex = Math.min(startIndex + itemsPerPage, data.length);
            var tableBody = document.getElementById('tableBody');
            tableBody.innerHTML = '';

            for (var i = startIndex; i < endIndex && i < data.length; i++) {
                var row = data[i];
                var docReply = row.doctorReply;
                var midwifeCheck = row.midwifeCheck;
                var DocName = docNames.find(item => item.MOH_id === parseInt(row.replyDocId));
                var momName = momNames.find(item => item.MotherId === parseInt(row.MotherId));
                var newRow = document.createElement('tr');

                if (midwifeCheck==='No' && (!docReply)) {
                    newRow.innerHTML = `
            <td>${row.recTime}</td>
            <td>${momName.firstname} ${momName.lastname}</td>
            <td>${row.symptomDescription}</td>
            <td>${row.priorityLvl}</td>
            <td>${row.midwifeCheck}</td>
            <td></td>
            <td>${row.doctorReply}</td>
            <td>${row.replyTime}</td>
            <td class="action-buttons">
                <button class="view-btn" value="${row.MotherId}">View Profile</button>
                <button class="hist-btn" value="${row.MotherId}">Symptom History</button>
                <button class="checked-btn" value="${row.symptomRecNo}">Checked</button>
            </td>
        `;
                } else if(midwifeCheck!=='No' && (!docReply)) {
                    newRow.innerHTML = `
            <td>${row.recTime}</td>
            <td>${momName.firstname} ${momName.lastname}</td>
            <td>${row.symptomDescription}</td>
            <td>${row.priorityLvl}</td>
            <td>${row.midwifeCheck}</td>
            <td></td>
            <td>${row.doctorReply}</td>
            <td>${row.replyTime}</td>
            <td class="action-buttons">
                <button class="view-btn" value="${row.MotherId}">View Profile</button>
                <button class="hist-btn" value="${row.MotherId}">Symptom History</button>
            </td>
        `;
                } else if(midwifeCheck==='No' && (docReply)) {
                    newRow.innerHTML = `
            <td>${row.recTime}</td>
            <td>${momName.firstname} ${momName.lastname}</td>
            <td>${row.symptomDescription}</td>
            <td>${row.priorityLvl}</td>
            <td>${row.midwifeCheck}</td>
            <td>${DocName.firstname} ${DocName.lastname}</td>
            <td>${row.doctorReply}</td>
            <td>${row.replyTime}</td>
            <td class="action-buttons">
                <button class="view-btn" value="${row.MotherId}">View Profile</button>
                <button class="hist-btn" value="${row.MotherId}">Symptom History</button>
                <button class="checked-btn" value="${row.symptomRecNo}">Checked</button>
            </td>
        `;
                } else {
                    newRow.innerHTML = `
            <td>${row.recTime}</td>
            <td>${momName.firstname} ${momName.lastname}</td>
            <td>${row.symptomDescription}</td>
            <td>${row.priorityLvl}</td>
            <td>${row.midwifeCheck}</td>
            <td>${DocName.firstname} ${DocName.lastname}</td>
            <td>${row.doctorReply}</td>
            <td>${row.replyTime}</td>
            <td class="action-buttons">
                <button class="view-btn" value="${row.MotherId}">View Profile</button>
                <button class="hist-btn" value="${row.MotherId}">Symptom History</button>
            </td>
        `;
                }

                // classify for row colouring
                if (row.priorityLvl === 'low') {
                    newRow.classList.add('low-priority');
                } else if (row.priorityLvl === 'normal') {
                    newRow.classList.add('medium-priority');
                } else if (row.priorityLvl === 'high') {
                    newRow.classList.add('high-priority');
                }

                tableBody.appendChild(newRow);
            }

        }

        function displayPagination() {
            var totalPages = Math.ceil(data.length / itemsPerPage);
            var pagination = document.getElementById('pagination');
            pagination.innerHTML = '';

            for (var i = 1; i <= totalPages; i++) {
                var pageButton = document.createElement('button');
                pageButton.className = 'page-button';
                pageButton.textContent = i;
                pageButton.addEventListener('click', function () {
                    currentPage = parseInt(this.textContent);
                    displayTableData();
                    displayPagination();
                });
                pagination.appendChild(pageButton);
            }
        }

        displayTableData();
        displayPagination();

        const checkedButtons = document.querySelectorAll('.checked-btn');

        checkedButtons.forEach(button => {
            button.addEventListener("click", function(event) {
                if (event.target && event.target.classList.contains("checked-btn")) {
                    const symptomRecNo = event.target.value;

                    const formData = new FormData();
                    formData.append('symptomRecNo', symptomRecNo);
                    formData.append('midwifeCheck', "Yes");

                    const url = '/symptomsUpdate';
                    fetch(url, {
                        method: 'POST',
                        body: formData,
                    })
                        .then(response => {
                            return response.text();
                        })
                        .then(data => {
                            console.log('Response data:', data);
                            displayTableData();
                            displayPagination();
                            setTimeout(() => {
                                window.location.reload();
                            }, 1000);
                        });
                }
            });
        });

        const histButtons = document.querySelectorAll('.hist-btn');

        histButtons.forEach(button => {
            button.addEventListener("click", function(event) {
                if (event.target && event.target.classList.contains("hist-btn")) {
                    const motherId = event.target.value;
                    const motherSymptoms =  data.filter(item => item.MotherId === parseInt(motherId));
                    console.log("momSymptoms", motherSymptoms);

                    var itemsPerPage = 10;
                    var currentPage = 1;

                    function displayTableData() {
                        var startIndex = (currentPage - 1) * itemsPerPage;
                        var endIndex = Math.min(startIndex + itemsPerPage, motherSymptoms.length);
                        var tableBody = document.getElementById('popupTableBody');
                        tableBody.innerHTML = '';
                        console.log(motherSymptoms.length);

                        for (let i = startIndex; i < endIndex && i < motherSymptoms.length; i++) {
                            var row = motherSymptoms[i];
                            var docReply = row.doctorReply;
                            var DocName = docNames.find(item => item.MOH_id === parseInt(row.replyDocId));
                            var momName = momNames.find(item => item.MotherId === parseInt(row.MotherId));
                            var newRow = document.createElement('tr');

                            if (!docReply) {
                                newRow.innerHTML = `
                            <td>${row.recTime}</td>
                            <td>${momName.firstname} ${momName.lastname}</td>
                            <td>${row.symptomDescription}</td>
                            <td>${row.priorityLvl}</td>
                            <td>${row.midwifeCheck}</td>
                            <td></td>
                            <td>${row.doctorReply}</td>
                            <td>${row.replyTime}</td>
                        `;
                            } else {
                                newRow.innerHTML = `
                            <td>${row.recTime}</td>
                            <td>${momName.firstname} ${momName.lastname}</td>
                            <td>${row.symptomDescription}</td>
                            <td>${row.priorityLvl}</td>
                            <td>${row.midwifeCheck}</td>
                            <td>${DocName.firstname} ${DocName.lastname}</td>
                            <td>${row.doctorReply}</td>
                            <td>${row.replyTime}</td>
                        `;
                            }
                            if (row.priorityLvl === 'low') {
                                newRow.classList.add('low-priority');
                            } else if (row.priorityLvl === 'normal') {
                                newRow.classList.add('medium-priority');
                            } else if (row.priorityLvl === 'high') {
                                newRow.classList.add('high-priority');
                            }

                            tableBody.appendChild(newRow);
                        }
                    }

                    function displayPagination() {
                        var totalPages = Math.ceil(motherSymptoms.length / itemsPerPage);
                        var pagination = document.getElementById('popupPagination');
                        pagination.innerHTML = '';

                        for (var i = 1; i <= totalPages; i++) {
                            var pageButton = document.createElement('button');
                            pageButton.className = 'page-button';
                            pageButton.textContent = i;
                            pageButton.addEventListener('click', function () {
                                currentPage = parseInt(this.textContent);
                                displayTableData();
                                displayPagination();
                            });
                            pagination.appendChild(pageButton);
                        }
                    }

                    displayTableData();
                    displayPagination();

                    document.getElementById('tablePopup').style.display = 'block';
                }
            });
        });

        document.getElementById('closePopupBtn').addEventListener('click', function() {
            // Hide the popup when the close button is clicked
            document.getElementById('tablePopup').style.display = 'none';
        });

    });



</script>

<style>
    /* General popup styles */
    .popup {
        position: fixed;
        /*margin: 20%;*/
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5); /* Semi-transparent background */
        display: none;
        justify-content: center;
        align-items: center;
        z-index: 9999; /* Ensure popups appear on top of other content */
        /*padding-top: 5%;*/
        padding-left: 15%;
    }

    .popup-content {
        background-color: #fff;
        border-radius: 8px;
        padding: 20px;
        max-width: 600px;
        width: 90%;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.1); /* Soft shadow */
        position: relative;
        display: table-cell;
    }

    /* Close button */
    .close {
        color: #aaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
    }

    .close:hover,
    .close:focus {
        color: black;
        text-decoration: none;
        cursor: pointer;
    }

    /* Popup content */
    .popup-content {
        background-color: #fefefe;
        margin: 5% auto; /* 5% from the top and centered */
        padding: 20px;
        border: 1px solid #888;
        width: 80%; /* Could be more or less, depending on screen size */
        max-width: 800px; /* Max width */
        border-radius: 10px;
    }

    /* Table styling */
    #popupTable {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 10px;
    }

    #popupTable th,
    #popupTable td {
        border: 1px solid #ddd;
        padding: 8px;
    }

    #popupTable th {
        background-color: #f2f2f2;
        text-align: left;
    }

    #popupTable tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    #popupTable tr:hover {
        background-color: #ddd;
    }

    /* Pagination styling */
    .pagination {
        text-align: center;
    }

    .pagination button {
        display: inline-block;
        background-color: #f2f2f2;
        color: #333;
        border: 1px solid #ccc;
        padding: 8px 16px;
        margin: 0 4px;
        cursor: pointer;
    }

    .pagination button.active {
        background-color: #333;
        color: #fff;
    }

    /* Close button */
    .close {
        color: #aaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
    }

    .close:hover,
    .close:focus {
        color: black;
        text-decoration: none;
        cursor: pointer;
    }

</style>