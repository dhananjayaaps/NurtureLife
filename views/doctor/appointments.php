<?php
/** @var $this app\core\view */

use app\core\Application;
use app\core\form\DropDown;
use app\core\form\Form;
use app\models\Appointments;
use app\models\Mother;

$this->title = 'Manage Appointments';
?>

<?php
/** @var $model Mother **/
//?>

<link rel="stylesheet" href="./assets/styles/table.css">
<link rel="stylesheet" href="./assets/styles/form.css">

<style>
    .shadowBox{
        flex: 40%;
        margin: 0;
        justify-content: flex-start;
    }

    a{
        text-decoration: none;
        color: white;
    }
</style>

<div class="content">
    <div class="shadowBox" style="height: 80vh">
            <div class="search-container">
                <input type="text" placeholder="Search Mothers...">
                <button type="submit">Search</button>
            </div>
            <table class="table-data">
                <thead>
                <tr>
                    <th>Mother ID</th>
                    <th>Name</th>
                    <th>Status</th>
                    <th>Delivery Date</th>
                    <th>PHM ID</th>
                    <th>GN Division</th>
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

<script>
    var data = <?php echo $model->getMothers()?>;

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
            <td>${row.Name}</td>
            <td>${row.Status}</td>
            <td>${row.DeliveryDate}</td>
            <td>${row.PHM_id}</td>
            <td>Colombo</td>
            <button class="action-button" onclick=""><a href="/motherProfile">View Mother</a></button>
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


