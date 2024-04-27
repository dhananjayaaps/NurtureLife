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
/** @var $modelUpdate Mother **/
/** @var $appointmentModel Appointments **/
//?>

<link rel="stylesheet" href="./assets/styles/table.css">
<link rel="stylesheet" href="./assets/styles/form.css">

<style>
    .content {
        display: flex;
        flex-wrap: wrap;
        padding: 0;
        height: 90%;
        width: 100%;
        margin-top: 10px;
    }

    a{
        text-decoration: none;
        color: white;
    }

    .shadowBox{
        height: 80vh;
    }
</style>
<h1>Midwife - Appointment Creating</h1>
<div class="doctors content">
    <div class="shadowBox">
        <div class="left-content">
            <div class="search-container">
                <input type="text" placeholder="Search Mothers...">
                <button type="submit">Search</button>
            </div>
            <table class="table-data">
                <thead>
                <tr>
                    <th><input type="checkbox" id="selectAll"></th>
                    <th>Mother ID</th>
                    <th>Name</th>
                    <th>Status</th>
                    <th>City</th>
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
    <div class="shadowBox">
        <div class="Right-content">
        <h2>Select the Appointment Details</h2>
            <br>
            <?php $form = Form::begin('', "post")?>
<!--            <label for="MotherIds"></label><input type="text" name="MotherIds" id="MotherIds" value="" class="form-control hidden">-->
            <div style="display: none">
                <?php echo $form->field($appointmentModel, 'MotherId', 'Mother Ids')?>
            </div>

            <?php
            $appointmentType = new Dropdown($appointmentModel, 'AppointType', 'Appoint Type');
            $appointmentType->setOptions([
                0 => 'Antenatal Clinic',
                1 => 'Postnatal Clinic',
                2 => 'Well baby Clinic',
                3 => 'Nutrition clinic',
                4 => 'Well women clinic',
                5 => 'Family planning clinic',
            ]);
            echo $appointmentType;
            ?>

            <?php echo $form->dateField($appointmentModel, 'AppointDate', 'Appoint Date')?>
            <?php echo $form->TimeField($appointmentModel, 'time', 'Appoint Time')?>
            <?php echo $form->field($appointmentModel, 'AppointRemarks', 'Remarks')?>

            <button type="submit" class="btn-submit">Submit</button>
            <?php echo Form::end()?>
        </div>
    </div>
</div>

<script>
    var data = <?php echo (new Appointments())->getMothersForMidwife()?>;
    var itemsPerPage = 3;
    var currentPage = 1;

    var selectedIdNumbers = document.getElementsByName('MotherId')[0].value.split(',').map(Number);

    function displayTableData() {
        var startIndex = (currentPage - 1) * itemsPerPage;
        var endIndex = startIndex + itemsPerPage;
        var tableBody = document.getElementById('tableBody');
        tableBody.innerHTML = '';

        for (var i = startIndex; i < endIndex && i < data.length; i++) {
            var row = data[i];
            console.log(row.MotherId)
            var newRow = document.createElement('tr');
            newRow.innerHTML = `
                <td><input type="checkbox" class="tickCheckbox" data-motherid="${row.MotherId}" ${selectedIdNumbers.includes(row.MotherId) ? 'checked' : ''}></td>
                <td>${row.MotherId}</td>
                <td>${row.Name}</td>
                <td>${row.Status}</td>
                <td>${row.City}</td>
                <td><button class="action-button"><a href="/motherProfile?id=${row.MotherId}">View Mother</a></button></td>
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
                attachListeners(); // Attach listeners after creating pagination buttons
            });
            pagination.appendChild(pageButton);
        }
    }

    function attachListeners() {
        var paginationButtons = document.querySelectorAll('.page-button');
        paginationButtons.forEach(function (button) {
            button.addEventListener('click', function () {
                currentPage = parseInt(this.textContent);
                updatePagination();
            });
        });

        document.getElementById("selectAll").addEventListener("change", function () {
            var checkboxes = document.getElementsByClassName("tickCheckbox");
            for (var i = 0; i < checkboxes.length; i++) {
                checkboxes[i].checked = this.checked;
            }
            updateSelectedMothers();
        });

        var checkboxes = document.getElementsByClassName("tickCheckbox");
        for (var i = 0; i < checkboxes.length; i++) {
            checkboxes[i].addEventListener('change', function () {
                updateSelectedMothers();
            });
        }
    }

    function updatePagination() {
        displayTableData();
        displayPagination();
        attachListeners(); // Reattach listeners after updating pagination
    }

    var selectedMothers = [];

    function updateSelectedMothers() {
        selectedMothers = [];
        var checkboxes = document.getElementsByClassName("tickCheckbox");
        for (var i = 0; i < checkboxes.length; i++) {
            if (checkboxes[i].checked) {
                selectedMothers.push(checkboxes[i].getAttribute('data-motherid'));
            }
        }
        document.getElementsByName('MotherId')[0].value = selectedMothers.join(',');
    }

    document.addEventListener("DOMContentLoaded", function () {
        displayTableData();
        displayPagination();
        attachListeners();
    });
</script>

