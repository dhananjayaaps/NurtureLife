<link rel="stylesheet" href="./assets/styles/table.css">
<link rel="stylesheet" href="./assets/styles/admin.css">

<div id="myPopup" class="popup">
    <div class="popup-content">
        <h1 style="color:green;">Mother Diagnostic Card</h1>
        <label for="">Diagnosis</label>
        <textarea name="" id="" cols="30" rows="10" style="width: 100%; height: 80px;"></textarea>
        <label for="">Recomondations</label>
        <textarea name="" id="" cols="30" rows="10" style="width: 100%; height: 80px;"></textarea>
        <label for="">Tests to be done</label>
        <textarea name="" id="" cols="30" rows="10" style="width: 100%; height: 80px;"></textarea>
        <label for="">Prescription</label>
        <textarea name="" id="" cols="30" rows="10" style="width: 100%; height: 80px;"></textarea>
        <div class="buttonRow">
            <button id="closePopup" class="btn-submit">
                Save
            </button>
            <button id="closePopup" class="btn-submit" style="background-color: orange;">
                Prioratize
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
                Remove
            </button>
        </div>
    </div>
</div>

<div class="clinics content">
    <div class="shadowBox">
        <div class="left-content">
            <div class="search-container">
                <input type="text" placeholder="Search Mothers...">
                <button type="submit">Search</button>
            </div>
            <table class="table-data">
                <thead>
                <tr>
                    <th>Mother ID</th>
                    <th>Name</th>
                    <th>Delevery Date</th>
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
    <div class="right-content">
        <div class="shadowBox">
            <h2>Add a New Appoinment <br/><br/></h2>

            <form class="form-group" action="#" method="post">
                <label for="name">Mother ID:</label>
                <input type="number" id="name" name="name" placeholder="Enter Mother ID" class = 'form-control' required>
                <br><br>

                <label for="email">Date:</label>
                <input type="date" id="email" name="email" placeholder="today" class = 'form-control' required>
                <br><br>

                <input type="submit" class="btn-submit" value="Submit">
            </form>
        </div>
    </div>

</div>

<script>
    var data = [
        { MotherId: 1, name: 'K.K. Vimala', DileveryDate: "2024/02/06", GnDivision: "Maharagama"},
        { MotherId: 2, name: 'M.K Sumana', DileveryDate: "2024/02/06", GnDivision: "Maharagama"},
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
                    <td>${row.MotherId}</td>
                    <td>${row.name}</td>
                    <td>${row.DileveryDate}</td>
                    <td class="action-buttons">
                        <button id="showPopUp" class="action-button update-button">Add Note</button>
                        <button id="myPopUpRemove" class="action-button remove-button">Remove</button>
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

    // Event listener for the "Remove" button
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