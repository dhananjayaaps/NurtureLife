<h1>Doctor - Clinics</h1>
<div id="myPopup" class="popup">
    <div class="popup-content">
        <h1 style="color: rgb(0, 15, 128);">Add Midwives Divisions<br/><br/></h1>
        <label for="name">Add Midwives Divisions</label>
        <input type="number" id="name" name="name" class="form-control" required>
        <button id="#" class="btn-submit">
            Add
        </button>
        <br><br>
        <div class="data-list">
            <div class="data-item">
                Division 1 (A.S.D. Achala)
                <button class="remove-button" onclick="removeDataItem(this)">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="data-item">
                Division 2 (H.K.D. Sewwandi)
                <button class="remove-button" onclick="removeDataItem(this)">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="data-item">
                Division 3 (S.U. Rathnayake)
                <button class="remove-button" onclick="removeDataItem(this)">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>
        <br>
        <div class="buttonRow">
            <button id="closePopup" class="btn-submit">
                Update
            </button>
            <button id="closePopup" class="btn-submit" style="background-color: brown;">
                Close
            </button>
        </div>
    </div>
</div>

<div id="myPopupRemove" class="popup">
    <div class="popup-content">
        Do You Really Need to Remove This? That can't be undone
        <div class="buttonRow" style="display: flex; flex-direction: row; gap: 10px;">
            <button id="closePopup" class="btn-submit">
                Close
            </button>
            <button id="closePopupRemove" class="btn-submit" style="background-color: brown;">
                Delete
            </button>
        </div>
    </div>
</div>

<div class="clinics content">
    <div class="shadowBox" style="height: fit-content">
        <div class="left-content">
            <div class="search-container">
                <input type="text" placeholder="Search Clinic...">
                <button type="submit">Search</button>
            </div>
            <style>
                table th,
                table td {
                    padding-right: 30px;
                    border-right: 10px solid transparent;
                }
            </style>
            <table class="table-data" >
                <thead>
                <tr>
                    <th>Week</th>
                    <th>Clinic ID</th>
                    <th>Mothers</th>
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
    </button>
    <div class="right-content" style="width:100%">
        <div class="shadowBox">
            <style>
                table th,
                table td {
                    padding-right: 30px;
                    border-right: 10px solid transparent;
                }
            </style>
            <table class="table-data" >
                <thead>
                <tr>
                    <th>Division ID</th>
                    <th>Name</th>
                    <th>Mothers</th>
                    <th>Midwife</th>
                </tr>
                </thead>
                <tbody id="tableBody2">
                <!-- Displayed rows will be added here -->
                </tbody>
            </table>
            <div class="pagination" id="pagination2">
                <!-- Pagination buttons will be added here -->
            </div>
        </div>
    </div>
</div>
</div>

<script>
    var data = [
        { Week: 1, ClinicDate: "Monday", NoOfMothers: 112},
        { Week: 1, ClinicDate: "Tuesday", NoOfMothers: 113},
        { Week: 1, ClinicDate: "Wednesday", NoOfMothers: 114},
        { Week: 1, ClinicDate: "Thursday", NoOfMothers: 116},
        { Week: 1, ClinicDate: "Friday", NoOfMothers: 115},
        { Week: 2, ClinicDate: "Monday", NoOfMothers: 112},
        { Week: 2, ClinicDate: "Tuesday", NoOfMothers: 113},
        { Week: 2, ClinicDate: "Wednesday", NoOfMothers: 114},
        { Week: 2, ClinicDate: "Thursday", NoOfMothers: 116},
        { Week: 2, ClinicDate: "Friday", NoOfMothers: 115},
    ];

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
            newRow.innerHTML = `
                <td>${row.Week}</td>
                <td>${row.ClinicDate}</td>
                <td>${row.NoOfMothers}</td>
                <td class="action-buttons">
                    <button id="showPopUp" class="action-button update-button">Update</button>
                </td>
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
    var data2 = [
        { DivisionId: 1, Name: "Maharagama", NoOfMothers: 112, Midwife: "A.S.D. Achala"},
        { DivisionId: 1, Name: "Gagodaila", NoOfMothers: 112, Midwife: "A.S.D. Achala"},
        { DivisionId: 1, Name: "Arawwala", NoOfMothers: 112, Midwife: "A.S.D. Achala"},
        { DivisionId: 2, Name: "Maharagama", NoOfMothers: 112, Midwife: "H.K.D. Sewwandi)"},
        { DivisionId: 2, Name: "Maharagama", NoOfMothers: 112, Midwife: "H.K.D. Sewwandi"},
        { DivisionId: 2, Name: "Nugegoda", NoOfMothers: 112, Midwife: "H.K.D. Sewwandi"},
        { DivisionId: 3, Name: "Kottawa", NoOfMothers: 112, Midwife: "A.S.D. Achala"},
        { DivisionId: 3, Name: "Pitakotuwa", NoOfMothers: 112, Midwife: "A.S.D. Achala"},
        { DivisionId: 3, Name: "Homagama", NoOfMothers: 112, Midwife: "A.S.D. Achala"},
        { DivisionId: 4, Name: "Makubura", NoOfMothers: 112, Midwife: "V. Devini"},
    ];

    var itemsPerPage = 10;
    var currentPage = 1;

    function displayTableData() {
        var startIndex = (currentPage - 1) * itemsPerPage;
        var endIndex = startIndex + itemsPerPage;
        var tableBody = document.getElementById('tableBody2');
        tableBody.innerHTML = '';

        for (var i = startIndex; i < endIndex && i < data.length; i++) {
            var row = data2[i];
            var newRow = document.createElement('tr');
            newRow.innerHTML = `
                <td>${row.DivisionId}</td>
                <td>${row.Name}</td>
                <td>${row.NoOfMothers}</td>
                <td>${row.Midwife}</td>
            `;
            tableBody.appendChild(newRow);
        }
    }

    function displayPagination() {
        var totalPages = Math.ceil(data.length / itemsPerPage);
        var pagination = document.getElementById('pagination2');
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
        if (event.target == myPopup) {
            myPopup.classList.remove("show");
        }
    });
</script>

<script>
    // Function to handle the removal confirmation popup
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

    var closeButtonRemove = document.getElementById('closePopupRemove');
    closeButtonRemove.addEventListener("click", function () {
        var myPopupRemove = document.getElementById('myPopupRemove');
        myPopupRemove.classList.remove("show");
    });

    window.addEventListener("click", function (event) {
        var myPopupRemove = document.getElementById('myPopupRemove');
        if (event.target == myPopupRemove) {
            myPopupRemove.classList.remove("show");
        }
    });
</script>