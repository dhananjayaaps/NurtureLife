
<?php
/** @var $model Child **/
/** @var $modelUpdate viewChild **/

use app\models\Child;

//?>

<h1>Midwife - Child</h1>
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
                    <th>Mother Name</th>
                    <th>Registration No</th>
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
    console.log("hi")
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
            newRow.innerHTML = `
            <td>${row.ChildName}</td>
            <td>${row.MotherName}</td>
            <td>${row.RegistrationNo}</td>
            <td>${row.Gender}</td>
            <td class="action-buttons">
            <button id="showPopUp" onclick="UpdatePopUp('${row.MOH_ID}', '${row.Name}')" class="action-button update-button">Update</button>
            <button class="action-button remove-button" onclick="UpdatePopUp('${row.MOH_ID}', '${row.Name}')">Remove</button>
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
