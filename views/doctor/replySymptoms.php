<?php
/** @var $this app\core\view */

use app\models\MotherSymptoms;
use app\models\Doctor;


$this->title = 'Reply Symptoms';
?>

<?php
/** @var $model Doctor **/
/** @var $modelUpdate Doctor **/
?>
<link rel="stylesheet" href="./assets/styles/mother.css">
<link rel="stylesheet" href="./assets/styles/table.css">

<div id="updatePopup" class="popup">
    <div class="popup-content">
        <span class="close" id="closePopupBtn">&times;</span>
        <h2>Symptom Reply</h2>
        <form class="update-form">
            <input type="hidden" id="symptomId" name="symptomId">
            <div class="form-group">
                <label for="SymptomReply">Symptom Reply:</label>
                <input type="text" id="SymptomReply" name="SymptomReply" required>
            </div>
            <button type="submit" class="btn-submit">Update</button>
        </form>
    </div>
</div>


<div id="tablePopup" class="popup">
    <div class="popup-content">
        <span class="close" id="closePopupBttn">&times;</span>
        <h2>Symptom History</h2>
        <table id="popupTable">
            <thead>
            <tr>
                <th>Record Time</th>
                <th>Mother Name</th>
                <th>Symptom Description</th>
                <th>Priority Level</th>
                <th>Midwife Name</th>
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
                <td>Midwife Name</td>
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

        var data = <?php echo (new MotherSymptoms())->getSymptomsByDoctor() ?>;
        data.sort((a, b) => b.symptomRecNo - a.symptomRecNo);
        var docNames = <?php echo (new Doctor())->getClinicDoctors()  ?>;
        var momNames = <?php echo (new Doctor())->getClinicMothers()  ?>;
        var midwifeNames = <?php echo (new Doctor())->getClinicMidwiwes()  ?>;
        var itemsPerPage = 10;
        var currentPage = 1;

        // Function to display table data
        function displayTableData() {
            var startIndex = (currentPage - 1) * itemsPerPage;
            var endIndex = Math.min(startIndex + itemsPerPage, data.length);
            var tableBody = document.getElementById('tableBody');
            tableBody.innerHTML = '';

            for (var i = startIndex; i < endIndex && i < data.length; i++) {
                var row = data[i];
                var docReply = row.doctorReply;
                var DocName = docNames.find(item => item.MOH_id === parseInt(row.replyDocId));
                var momName = momNames.find(item => item.MotherId === parseInt(row.MotherId));
                var midwifeName = midwifeNames.find(item => item.PHM_id === parseInt(row.midwifeId));

                console.log(DocName);
                var newRow = document.createElement('tr');

                if (!docReply) {
                    newRow.innerHTML = `
            <td>${row.recTime}</td>
            <td>${momName.firstname} ${momName.lastname}</td>
            <td>${row.symptomDescription}</td>
            <td>${row.priorityLvl}</td>
            <td>${midwifeName.firstname} ${midwifeName.lastname}</td>
            <td>${row.midwifeCheck}</td>
            <td></td>
            <td>${row.doctorReply}</td>
            <td>${row.replyTime}</td>
            <td class="action-buttons">
                <button class="view-btn" value="${row.MotherId}">View Profile</button>
                <button class="hist-btn" value="${row.MotherId}">Symptom History</button>
                <button class="reply-btn" value="${row.symptomRecNo}">Reply</button>
            </td>
        `;
                } else {
                    newRow.innerHTML = `
            <td>${row.recTime}</td>
            <td>${momName.firstname} ${momName.lastname}</td>
            <td>${row.symptomDescription}</td>
            <td>${row.priorityLvl}</td>
            <td>${midwifeName.firstname} ${midwifeName.lastname}</td>
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
                // Inside the displayTableData function

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

        // Function to display pagination
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

        // Call functions to display initial table data and pagination
        displayTableData();
        displayPagination();


        // Get the reply button
        const replyButtons = document.querySelectorAll('.reply-btn');

        // Add click event listener to each reply button
        replyButtons.forEach(button => {
            button.addEventListener("click", function(event) {
                if (event.target && event.target.classList.contains("reply-btn")) {
                    const symptomRecNo = event.target.value;

                    // Populate the hidden input field in the update popup with the symptomRecNo value
                    document.getElementById('symptomId').value = symptomRecNo;

                    // Display the update popup
                    document.getElementById('updatePopup').style.display = 'block';
                }
            });
        });

        // Add event listener for the close button in the update popup
        document.getElementById('closePopupBtn').addEventListener('click', function() {
            // Hide the update popup when the close button is clicked
            document.getElementById('updatePopup').style.display = 'none';
        });

        // Function to handle form submission
        document.querySelector('.update-form').addEventListener('submit', function(event) {
            event.preventDefault();

            // Get the form data
            const docId= <?php echo (new Doctor())->getDocId() ?>;
            const symptomId = document.getElementById('symptomId').value;
            const symptomReply = document.getElementById('SymptomReply').value;
            const currentDateAndTime = new Date();
            const currentTime = `${currentDateAndTime.getFullYear()}-${(currentDateAndTime.getMonth() + 1).toString().padStart(2, '0')}-${currentDateAndTime.getDate().toString().padStart(2, '0')} ${currentDateAndTime.getHours().toString().padStart(2, '0')}:${currentDateAndTime.getMinutes().toString().padStart(2, '0')}:${currentDateAndTime.getSeconds().toString().padStart(2, '0')}`;

            // Create FormData object
            const formData = new FormData();
            formData.append('replyDocId', docId);
            formData.append('symptomRecNo', symptomId);
            formData.append('doctorReply', symptomReply);
            formData.append('replyTime', currentTime);

            // Define the URL to send the form data
            const url = '/symptomsUpdate'; // Replace with your backend URL

            // Define request options
            const options = {
                method: 'POST',
                body: formData
            };

            // Send fetch request
            fetch(url, options)
                .then(response => {
                    return response.text();
                })
                .then(data => {
                    // Handle successful response
                    console.log('Update successful:', data);
                    // Optionally, you can check if the response data is valid JSON
                    //     try {
                    //         const jsonData = JSON.parse(data);
                    //         // Handle JSON data
                    //         console.log('Parsed JSON data:', jsonData);
                    //     } catch (error) {
                    //         // Handle JSON parsing error
                    //         console.error('JSON parsing error:', error);
                    //     }

                    // Optionally, perform additional actions after successful update
                    // For example, close the update popup
                    document.getElementById('updatePopup').style.display = 'none';
                    setTimeout(() => {
                        window.location.reload(); // Refresh the page
                    }, 1000);
                    // // Then, refresh the table data
                    // displayTableData();
                    // displayPagination();
                });
                // .catch(error => {
                //     // Handle fetch errors
                //     console.error('Update failed:', error);
                // });
        });

        const histButtons = document.querySelectorAll('.hist-btn');

        // Add click event listener to each reply button
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
                            var midwifeName = midwifeNames.find(item => item.PHM_id === parseInt(row.midwifeId));
                            console.log("for loop");
                            console.log("row", row);
                            var newRow = document.createElement('tr');

                            if (!docReply) {
                                newRow.innerHTML = `
                            <td>${row.recTime}</td>
                            <td>${momName.firstname} ${momName.lastname}</td>
                            <td>${row.symptomDescription}</td>
                            <td>${row.priorityLvl}</td>
                            <td>${midwifeName.firstname} ${midwifeName.lastname}</td>
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
                            <td>${midwifeName.firstname} ${midwifeName.lastname}</td>
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

                    // Call functions to display initial table data and pagination
                    displayTableData();
                    displayPagination();

                    document.getElementById('tablePopup').style.display = 'block';
                }
            });
        });

// Add event listener for the close button in the popup
        document.getElementById('closePopupBttn').addEventListener('click', function() {
            // Hide the popup when the close button is clicked
            document.getElementById('tablePopup').style.display = 'none';
        });
    });

</script>

<style>
    /* Popup container */
    .popup {
        display: none; /* Hidden by default */
        position: fixed; /* Stay in place */
        z-index: 9999; /* Sit on top */
        left: 0;
        top: 0;
        width: 60%; /* Full width */
        height: 80%; /* Full height */
        overflow: auto; /* Enable scroll if needed */
        background-color: rgba(0,0,0,0.5); /* Black w/ opacity */
    }

    /* Popup content */
    .popup-content {
        background-color: #fefefe;
        margin: 5% auto; /* 5% from the top and centered */
        padding: 20px;
        border: 1px solid #888;
        width: 80%; /* Could be more or less, depending on screen size */
        max-width: 500px; /* Max width */
        border-radius: 10px;
    }
</style>