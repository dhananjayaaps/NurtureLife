<?php
/** @var $this app\core\view */

use app\core\Application;
use app\core\form\Form;
use app\core\Model;
use app\models\MotherSymptoms;
use app\core\form\DropDown;
use app\models\Mother;

$this->title = 'Symptoms Reporting';
?>
<?php
/** @var $model MotherSymptoms **/
/** @var $modelUpdate MotherSymptoms **/
?>

<link rel="stylesheet" href="./assets/styles/Form.css">
<link rel="stylesheet" href="./assets/styles/table.css">
<link rel="stylesheet" href="./assets/styles/mother.css">

    <div class="popup" id="popupAdd">
        <div class="shadowBox">
            <h2>Report Symptoms</h2>


            <div class="form-container">

                <div class="form-column">
                    <?php $form = Form::begin('', "post")?>
                    <?php echo $form->field($model, 'symptomDescription', 'Symptoms Description');


                    $priorityField = new Dropdown($model, 'priorityLvl', 'Priority Level');
                    $priorityField->setOptions([
                        'high' => 'High',
                        'normal' => 'Normal',
                        'low' => 'Low',
                    ]);
                    echo $priorityField;
                    ?>
                    <button type="submit" class="btn-submit">Submit</button>
                    <?php echo Form::end()?>
                    <span class="close" id="close-popup">&times;</span>
                </div>
            </div>
        </div>
    </div>
<div class="popup" id="viewPopup"></div>


    <div id="updatePopup" class="popup">
        <div class="popup-content">
            <span class="close" id="closePopupBtn">&times;</span>
            <h2>Update Symptom</h2>
            <form class="update-form">
                <input type="hidden" id="symptomId" name="symptomId">
                <div class="form-group">
                    <label for="UpdateSymptomDescription">Symptom Description:</label>
                    <input type="text" id="UpdateSymptomDescription" name="UpdateSymptomDescription" required>
                </div>
                <div class="form-group">
                    <label for="UpdatePriorityLvl">Priority Level:</label>
                    <select id="UpdatePriorityLvl" name="UpdatePriorityLvl" required>
                        <option value="high">High</option>
                        <option value="normal">Normal</option>
                        <option value="low">Low</option>
                    </select>
                </div>
                <button type="submit" class="btn-submit">Update</button>
            </form>
        </div>
    </div>

    <div id="myPopupRemove" class="popup">
        <div class="selectedRow" id="selectedRow" style="display: none"></div>
        <div class="popup-content">
            Do You Really Need to Remove This? That can't be undone
            <div class="buttonRow" style="display: flex; flex-direction: row; gap: 10px;">
                <span class="close" id="closePopup">&times;</span>
                <button id="closePopupRemove" class="btn-submit" style="background-color: brown;">
                    Delete
                </button>
            </div>
        </div>
    </div>



    <div class="Midwifes content">
        <button id="open-popup" class="report-btn">Report Symptoms</button>
        <div class="shadowBox">
            <h2>Mother Symptoms</h2>
            <table class="table-data">
                <thead>
                <tr>
                    <th>Record Time</th>
                    <th>Symptom Description</th>
                    <th>Priority Level</th>
                    <th>Midwife Check</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody id="tableBody">
                <!-- Table rows will be added here -->
                </tbody>
            </table>
            <div class="pagination" id="pagination">
                <!-- Pagination buttons will be added here -->
            </div>
        </div>

</div>
<!--</div>-->

<script>
    document.getElementById("open-popup").addEventListener("click", function() {
        document.getElementById("popupAdd").style.display = "block";
    });
    document.addEventListener("click", function(event) {
        if (event.target && event.target.id === "close-popup") {
            document.getElementById("popupAdd").style.display = "none";
        }
    });

</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Define variables
        var data = <?php echo (new MotherSymptoms())->getMomRecords() ?>;
        data.sort((a, b) => b.symptomRecNo - a.symptomRecNo);
        var docNames = <?php echo (new Mother())->getClinicDoctors() ?>;
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
                var newRow = document.createElement('tr');

                if (!docReply) {
                    newRow.innerHTML = `
            <td>${row.recTime}</td>
            <td>${row.symptomDescription}</td>
            <td>${row.priorityLvl}</td>
            <td>${row.midwifeCheck}</td>
            <td class="action-buttons">
                <button class="edit-btn" value="${row.symptomRecNo}">Edit</button>
                <button class="delete-btn" value="${row.symptomRecNo}">Delete</button>
            </td>
        `;
                } else {
                    newRow.innerHTML = `
            <td>${row.recTime}</td>
            <td>${row.symptomDescription}</td>
            <td>${row.priorityLvl}</td>
            <td>${row.midwifeCheck}</td>
            <td class="action-buttons">
                <button class="view-btn" value="${row.symptomRecNo}">View</button>
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

        // Function to populate form fields with symptom data
        function updateFormWithData(data) {
            console.log(data); // Check the content of the data object
            const symptomIdField = document.querySelector('input[name="symptomId"]');
            const symptomDescriptionField = document.querySelector('input[name="UpdateSymptomDescription"]');
            console.log(symptomDescriptionField); // Check if the field exists
            const priorityLvlField = document.querySelector('select[name="UpdatePriorityLvl"]');
            console.log(priorityLvlField); // Check if the field exists

            if (data) {
                symptomIdField.value = data.symptomRecNo;
                symptomDescriptionField.value = data.symptomDescription;
                priorityLvlField.value = data.priorityLvl;
            }
            else {
                console.error("Data is undefined or null.");
            }
        }


        // Function to open update popup
        function openUpdatePopup(symptomId , data) {

            symptomId = parseInt(symptomId);
            console.log("symptomId",symptomId," data", data);
            const oldDetails = data.find(item => item.symptomRecNo === symptomId);
            console.log("old", oldDetails);

            updateFormWithData(oldDetails);

            // Show the update popup
            document.getElementById('updatePopup').style.display = 'block';
        }

        // Function to handle form submission
        function handleFormSubmit(event) {
            event.preventDefault();

            // Get form data
            const symptomId = document.querySelector('input[name="symptomId"]').value;
            const symptomDescription = document.querySelector('input[name="UpdateSymptomDescription"]').value;
            const priorityLvl = document.querySelector('select[name="UpdatePriorityLvl"]').value;

            // Create FormData object
            const formData = new FormData();
            formData.append('symptomRecNo', symptomId);
            formData.append('symptomDescription', symptomDescription);
            formData.append('priorityLvl', priorityLvl);
            formData.append('midwifeCheck', "No");

            // Define request options
            const url = '/symptomsUpdate';
            const options = {
                method: 'POST',
                body: formData
            };

            // Send fetch request
            fetch(url, {
                method: 'POST',
                body: formData,
            })
                .then(response => {
                    // Read the response body as text
                    return response.text();
                })
                .then(data => {
                    // Handle the response data here
                    console.log('Response data:', data);
                    document.getElementById('updatePopup').style.display = 'none';
// Then, refresh the table data
                    displayTableData();
                    displayPagination();
                    setTimeout(() => {
                        window.location.reload(); // Refresh the page
                    }, 1000);


                    // Optionally, you can check if the response data is valid JSON
                //     try {
                //         const jsonData = JSON.parse(data);
                //         // Handle JSON data
                //         console.log('Parsed JSON data:', jsonData);
                //     } catch (error) {
                //         // Handle JSON parsing error
                //         console.error('JSON parsing error:', error);
                //     }
                });

        }

        // Add event listener for form submission
        const form = document.querySelector('.update-form');
        form.addEventListener('submit', handleFormSubmit);


        // Add event listener for edit buttons
        const editButtons = document.querySelectorAll('.edit-btn');
        editButtons.forEach(button => {
            button.addEventListener("click", function(event) {
                if (event.target && event.target.classList.contains("edit-btn")) {
                    const symptomId = event.target.value;
                    console.log("lisn",symptomId);
                    openUpdatePopup(symptomId, data);
                }
            });
        });



        // Function to close update popup
        function closeUpdatePopup() {
            document.getElementById('updatePopup').style.display = 'none';
        }

        // Add event listener for close popup button
        const closePopupBtn = document.getElementById('closePopupBtn');
        closePopupBtn.addEventListener('click', closeUpdatePopup);



        const viewPopup = document.getElementById("viewPopup");
        const viewButtons = document.querySelectorAll('.view-btn');
        viewButtons.forEach(button => {
            button.addEventListener("click", function(event) {
                if (event.target && event.target.classList.contains("view-btn")) {
                    let symptomId = event.target.value;
                    symptomId = parseInt(symptomId);
                    console.log("symptomId",symptomId," data", data);
                    const record = data.find(item => item.symptomRecNo === symptomId);
                    var DocName = docNames.find(item => item.MOH_id === parseInt(record.replyDocId));

                    const line1 = "Doctor Name: " + DocName.firstname +" "+ DocName.lastname;
                    const line2 = "Doctor Reply: " + record.doctorReply;
                    const line3 = "Reply Time: " + record.replyTime;

                    viewPopup.innerHTML = `
                        <div class="popup-content">

                            <h2>Reply Details</h2>
                            <p>${line1}</p>
                            <p>${line2}</p>
                            <p>${line3}</p>
                            <span class="close" id="close-popup">&times;</span>
                        </div>
                        `;
                    viewPopup.style.display = "block";


                }
            });
        });

        document.addEventListener("click", function(event) {
            if (event.target && event.target.id === "close-popup") {
                document.getElementById("viewPopup").style.display = "none";
            }
        });


    });



</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Define variables
        var data = <?php echo (new MotherSymptoms())->getMomRecords() ?>;
        var selectedRowId; // Variable to store the id of the selected row

        // Function to open the delete popup
        function openDeletePopup(symptomId) {
            selectedRowId = symptomId;
            document.getElementById('myPopupRemove').style.display = 'block';
            // Optionally, display the selected row inside the delete popup
            document.getElementById('selectedRow').textContent = `Selected Row ID: ${symptomId}`;
        }

        // Add event listener for delete button in the table
        const deleteButtons = document.querySelectorAll('.delete-btn');
        deleteButtons.forEach(button => {
            button.addEventListener('click', function(event) {
                if (event.target && event.target.classList.contains('delete-btn')) {
                    const symptomId = event.target.value;
                    openDeletePopup(symptomId);
                }
            });
        });

        // Add event listener for remove button in the delete popup
        const removePopupBtn = document.getElementById('closePopupRemove');
        removePopupBtn.addEventListener('click', function() {
            // Prepare the data to be sent in the POST request
            const formData = new FormData();
            formData.append('symptomRecNo', selectedRowId);

            // Define request options
            const url = '/deleteSymptom'; // Update with your endpoint
            const options = {
                method: 'POST',
                body: formData
            };

            // Send fetch request
            fetch(url, options)
                .then(response => {
                    if (!response.ok) {
                        throw new Error(`HTTP error! Status: ${response.status}`);
                    }
                    return response.json();
                })
                .then(data => {
                    console.log('Item deleted successfully:', data);
                    // Optionally, perform additional actions after successful deletion
                    // For example, close the delete popup
                    document.getElementById('myPopupRemove').style.display = 'none';
                    // Then, refresh the table data
                    // displayTableData();
                    // displayPagination();
                    setTimeout(() => {
                        window.location.reload(); // Refresh the page
                    }, 1000);
                })
                .catch(error => {
                    console.error('Delete failed:', error);
                });
        });

        // Add event listener for close button in the delete popup
        const closePopupBtn = document.getElementById('closePopup');
        closePopupBtn.addEventListener('click', function() {
            document.getElementById('myPopupRemove').style.display = 'none';
        });


    });


</script>

<style>

    /*.content{*/
    /*    margin-top: 100px;*/
    /*}*/

    .low-priority {
        background-color: #fff3cd; /* Light yellow */
    }

    .medium-priority {
        background-color: #ffc107; /* Orange */
    }

    .high-priority {
        background-color: #f8d7da; /* Light red */
    }
    /* Report Symptoms button */
    .report-btn {
        background-color: green; /* Green color for the Report Symptoms button */
        color: #fff;
        padding: 8px 16px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    .report-btn:hover {
        background-color: #5cb85c; /* Darker green on hover */
    }

    /* Edit button */
    .edit-btn {
        background-color: yellow; /* Yellow color for edit button */
        color: #000000;
        padding: 8px 16px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    .edit-btn:hover {
        background-color: #f0ad4e; /* Darker yellow on hover */
    }

    /* Delete button */
    .delete-btn {
        background-color: red; /* Red color for delete button */
        color: #fff;
        padding: 8px 16px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    .delete-btn:hover {
        background-color: #d9534f; /* Darker red on hover */
    }

    /* View button */
    .view-btn {
        background-color: blue; /* Blue color for view button */
        color: #fff;
        padding: 8px 16px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    .view-btn:hover {
        background-color: #286090; /* Darker blue on hover */
    }



</style>