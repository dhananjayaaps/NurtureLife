<?php
/** @var $this app\core\view */

use app\core\Application;
use app\core\form\DropDown;
use app\core\form\Form;
use app\core\Model;
use app\models\Clinic;

$this->title = 'Clinics';
?>
<!---->
<?php
/** @var $model Clinic **/
/** @var $modelUpdate Clinic **/
//?>
<sc

<link rel="stylesheet" href="./assets/styles/Form.css">
<link rel="stylesheet" href="./assets/styles/table.css">

<h1>Admin - Clinics</h1>
<div id="myPopup" class="popup">
    <div class="popup-content">
        <h1 style="color: rgb(0, 15, 128);">Update Clinic Details<br/><br/></h1>
        <form action="">

            <div class="form-group">
                <label>Clinic ID</label>
                <input type="text" id="UpdateId" name="UpdateId" value=""  class="form-control ">
                <div class="invalid-feedback">
                </div>
            </div>

            <div class="form-group">
                <label>New Name</label>
                <input type="text" id="UpdateName" name="UpdateName" value=""  class="form-control ">
                <div class="invalid-feedback">
                </div>
            </div>

            <div class="form-group">
                <label>New Address</label>
                <input type="text" id="UpdateAddress" name="UpdateAddress" value=""  class="form-control ">
                <div class="invalid-feedback">
                </div>
            </div>

            <div class="form-group">
                <label>New Contact No</label>
                <input type="text" id="UpdateContact" name="UpdateContact" value=""  class="form-control ">
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
    <br>
</div>

<div id="myPopupRemove" class="popup">
    <div class="selectedRow" id="selectedRow" style="display: none"></div>
    <div class="popup-content">
        Do You Really Need to Remove This? That can't be undone
        <div class="buttonRow" style="display: flex; flex-direction: row; gap: 10px;">
            <button id="closePopup" class="btn-submit">
                Close
            </button>
            <button id="closePopupRemove" class="btn-submit" style="background-color: brown;">
                Remove
            </button>
        </div>
    </div>
</div>

<div class="clinics content">
    <div class="shadowBox">
        <div class="left-content">
            <div class="search-container">
                <label for="clinicsSearchData"></label><input type="text" id="clinicsSearchData" placeholder="Search Clinic...">
                <button type="submit" id="ClinicSearch">Search</button>
            </div>
            <table class="table-data">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Mothers</th>
                    <th>Midwives</th>
                    <th>Doctors</th>
                    <th>Contact</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody id="tableBody">
                <!-- Displayed rows will be added here -->
                </tbody>
            </table>
            <div class="pagination" id="pagination">
                <!-- Pagination buttons will be added here -->
            </div>
        </div>
    </div>
    <div class="right-content">
        <div class="shadowBox">
            <h2>Add a New Clinic <br/><br/></h2>
            <?php $form = Form::begin('', "post")?>
            <?php echo $form->field($model, 'name', 'Name')?>
            <?php
            $appointmentType = new Dropdown($model, 'district', 'District');
            $appointmentType->setOptions([
                'Matara' => 'Matara',
                'Galle' => 'Galle',
                'Hambantota' => 'Well baby Clinic',
                'Colombo' => 'Colombo',
            ]);
            echo $appointmentType;
            ?>
            <?php echo $form->field($model, 'address', 'Address')?>
            <?php echo $form->field($model, 'contactNo', 'Contact No')?>
            <button type="submit" class="btn-submit">Submit</button>
            <?php echo Form::end()?>
        </div>
    </div>

</div>


<script>
    var data = <?php echo $model->getClinics()?>;
    var itemsPerPage = 8;
    var currentPage = 1;

    function displayTableData() {
        var startIndex = (currentPage - 1) * itemsPerPage;
        var endIndex = startIndex + itemsPerPage;
        var tableBody = document.getElementById('tableBody');
        tableBody.innerHTML = '';

        for (var i = startIndex; i < endIndex && i < data.length; i++) {
            var row = data[i];
            var newRow = document.createElement('tr');
            newRow.innerHTML = `
                    <td>${row.name}</td>
                    <td>${row.totalMothers}</td>
                    <td>${row.totalMidwives}</td>
                    <td>${row.totalDoctors}</td>
                    <td>${row.contactNo}</td>
                    <td class="action-buttons">
                    <button id="showPopUp" onclick="UpdatePopUp(${row.clinicID})" class="action-button update-button">Update</button>
                    <button class="action-button remove-button" onclick="UpdatePopUp(${row.clinicID})">Remove</button>
                `;
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
</script>

<script>
    var myPopup = document.getElementById('myPopup');
    var closeButton = document.getElementById('closePopup');
    var popupButtonContainer = document.querySelector('.clinics.content');

    popupButtonContainer.addEventListener("click", function (event) {
        if (event.target.id === 'showPopUp') {
            myPopup.classList.add("show");
        }
    });

    closeButton.addEventListener("click", function () {
        myPopup.classList.remove("show");
    });

    window.addEventListener("click", function (event) {
        if (event.target === myPopup) {
            myPopup.classList.remove("show");
        }
    });
</script>

<script>
    function getClinicDetails(id) {
        const url = `/getClinicDetails?id=${id}`;

        return fetch(url)
            .then((response) => {
                if (response.ok) {
                    return response.json();
                } else {
                    throw new Error('Failed to fetch data');
                }
            });
    }

    function UpdatePopUp(ClinicId){

        var labels = document.querySelectorAll('form label');

        getClinicDetails(ClinicId)
            .then((data) => {
                var inputFieldId, inputFieldName, inputFieldAddress, inputFieldContactNo
                for (var i = 0; i < labels.length; i++) {
                    if (labels[i].textContent === 'Clinic ID') {
                        inputFieldId = labels[i].nextElementSibling;
                    }
                    else if (labels[i].textContent === 'New Name') {
                        inputFieldName = labels[i].nextElementSibling;
                    }
                    else if (labels[i].textContent === 'New Address') {
                        inputFieldAddress = labels[i].nextElementSibling;
                        break;
                    }
                    inputFieldContactNo = document.getElementById('UpdateContact');

                }
                console.log(inputFieldContactNo);

                if (inputFieldId) {
                    inputFieldId.value = ClinicId;
                    inputFieldId.disabled = true;
                }
                if (inputFieldName) {
                    inputFieldName.value = data.name;
                }
                if (inputFieldAddress) {
                    inputFieldAddress.value = data.address;
                }
                if (inputFieldContactNo) {
                    inputFieldContactNo.value = data.contactNo;
                }
            })
            .catch((error) => {
                console.error(error);
            });
    }
</script>

<script>
    document.getElementById('updateButton').addEventListener('click', function (e) {
        e.preventDefault();

        const id = document.querySelector('input[name="UpdateId"]').value;
        const name = document.querySelector('input[name="UpdateName"]').value;
        const address = document.querySelector('input[name="UpdateAddress"]').value;
        const contactNo = document.querySelector('input[name="UpdateContact"]').value;

        const formData = new FormData();
        formData.append('id', id);
        formData.append('name', name);
        formData.append('address', address);
        formData.append('contactNo', contactNo);

        const url = '/clinicsUpdate';

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


<script>
    document.getElementById('closePopupRemove').addEventListener('click', function (e) {
        e.preventDefault();

        const id = document.querySelector('input[name="UpdateId"]').value;

        const formData = new FormData();
        formData.append('id', id);

        const url = '/deleteClinic';

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
            .catch(error => {
                console.error(error);
            });
    });
</script>


<script>
    function showRemovePopup() {
        var myPopupRemove = document.getElementById('myPopupRemove');
        myPopupRemove.classList.add("show");
    }

    var popupButtonContainer = document.querySelector('.clinics.content');
    popupButtonContainer.addEventListener("click", function (event) {
        if (event.target.classList.contains('remove-button')) {
            showRemovePopup();
        }
    });

    window.addEventListener("click", function (event) {
        var myPopupRemove = document.getElementById('myPopupRemove');
        if (event.target == myPopupRemove) {
            myPopupRemove.classList.remove("show");
        }
    });
</script>

<script>
    // Function to handle clinic search
    function searchClinics() {
        var searchTerm = document.getElementById('clinicsSearchData').value.toLowerCase();
        var filteredData = data.filter(function(clinic) {
            return clinic.name.toLowerCase().includes(searchTerm);
        });

        // Display the filtered data
        displayTableData(filteredData);
        displayPagination(filteredData);
    }

    // Add event listener to the search button
    document.getElementById('ClinicSearch').addEventListener('click', function() {
        searchClinics();
    });

    // Add event listener to handle enter key press in the search input
    document.getElementById('clinicsSearchData').addEventListener('keypress', function(event) {
        if (event.key === 'Enter') {
            searchClinics();
        }
    });
</script>