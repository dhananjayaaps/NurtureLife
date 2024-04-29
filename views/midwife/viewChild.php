
<?php
/** @var $model Child **/
/** @var $modelUpdate Child **/

use app\models\Child;

//?>

<!--<h1>Midwife - Child</h1>-->
<div id="myPopup" class="popup">
    <div class="popup-content">
        <h1 style="color: rgb(0, 15, 128);">Update Child Details<br/><br/></h1>
        <form action="">

            <div class="form-group">
                <label>Child  New Name</label>
                <input type="text" id="UpdateName" name="UpdateName" value=""  class="form-control ">
                <div class="invalid-feedback">
                </div>
            </div>

            <div class="form-group">
                <label>Gender</label>
                <input type="text" id="UpdateGender" name="UpdateGender" value=""  class="form-control ">
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

<div class="doctors content">
    <div class="shadowBox">
        <div class="left-content">
            <div class="search-container">
                <input type="text" placeholder="Search Child...">
                <button type="submit">Search</button>
            </div>
            <table class="table-data">
                <thead>
                <tr>
                    <th>Child Name</th>
                    <th>Gender</th>
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
</div>

<script>
    // console.log("hi")
    var data = <?php echo $model->getChilds()?>;
    var itemsPerPage = 10;
    var currentPage = 1;

    function displayTableData() {
        var startIndex = (currentPage - 1) * itemsPerPage;
        var endIndex = startIndex + itemsPerPage;
        var tableBody = document.getElementById('tableBody');
        tableBody.innerHTML = '';

        for (var i = startIndex; i < endIndex && i < data.length; i++) {
            var row = data[i];
            var newRow = document.createElement('tr');
            if(row.Gender==="1"){
                row.Gender="male"
            }else{
                row.Gender="female"
            }
            newRow.innerHTML = `
            <td>${row.ChildName}</td>
            <td>${row.Gender}</td>
            <td class="action-buttons">
            <button id="showPopUp" onclick="UpdatePopUp('${row.MOH_ID}', '${row.Name}')" class="action-button update-button">Update</button>
             <button type="submit" class="btn-submit"><a href="/childProfile">View Profile</a></button>
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
    function getChildDetails(child_id) {
        const url = `/getChildDetails?id=${child_id}`;

        return fetch(url)
            .then((response) => {
                if (response.ok) {
                    return response.json();
                } else {
                    throw new Error('Failed to fetch data');
                }
            });
    }

    function UpdatePopUp(child_id){

        var labels = document.querySelectorAll('form label');

        getChildDetails(child_id)
            .then((data) => {
                var inputFieldCname, inputFieldGender
                for (var i = 0; i < labels.length; i++) {
                    if (labels[i].textContent === 'Child New Name') {
                        inputFieldCname = labels[i].nextElementSibling;
                    }
                    else if (labels[i].textContent === 'New Gender') {
                        inputFieldGender = labels[i].nextElementSibling;
                        break;
                    }
                }

                if (inputFieldCname) {
                    inputFieldCname.value = data.Child_Name;
                }

                if (inputFieldGender) {
                    inputFieldGender.value = data.Gender;

            })
            .catch((error) => {
                console.error(error);
            });
    }
</script>

<script>
    document.getElementById('updateButton').addEventListener('click', function (e) {
        e.preventDefault();

        const Child_Name = document.querySelector('input[name="UpdateName"]').value;
        const Gender = document.querySelector('input[name="UpdateGender"]').value;

        const formData = new FormData();
        formData.append('Child_Name', Child_Name);
        formData.append('Gender', Gender);

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
