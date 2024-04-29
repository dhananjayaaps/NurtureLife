<?php
/** @var $this app\core\view */

use app\core\Application;
use app\core\form\Form;
use app\models\Appointments;

/** @var $appointmentModel Appointments **/

$this->title = 'Manage Appointments';
?>

<style>
    .content {
        display: flex;
        flex-wrap: wrap;
        padding: 0;
        height: 90%;
        width: 100%;
        margin-top: 10px;
        flex-direction: row;
        justify-content: space-around;
    }

    a {
        text-decoration: none;
        color: white;
    }

    .shadowBox {
        height: 80vh;
    }

    .btn-cancel{
        background-color: brown;
        color: white;
        font-size: 16px;
        padding: 10px 20px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        position: relative;
    }
</style>

<link rel="stylesheet" href="./assets/styles/table.css">
<link rel="stylesheet" href="./assets/styles/form.css">

<h1>Manage My Appointments</h1>

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

<div class="doctors content">
    <div class="shadowBox">
        <div class="left-content">
            <table class="table-data">
                <thead>
                <tr>
                    <th><input type="checkbox" id="selectAll"></th>
                    <th>Appointment ID</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Patient Name</th>
                    <th>Appointment Type</th>
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
            <h2>New Appointment Details</h2>
            <br>
            <?php $form = Form::begin('', "post") ?>
            <div style="">
                <?php echo $form->field($appointmentModel, 'AppointmentId', 'Appointment Ids') ?>
            </div>
            <?php echo $form->dateField($appointmentModel, 'AppointDate', 'Appointment Date') ?>
            <?php echo $form->TimeField($appointmentModel, 'time', 'Appointment Time') ?>
            <?php echo $form->field($appointmentModel, 'AppointRemarks', 'Remarks') ?>

            <button type="submit" class="btn-submit">Update</button>
            <button type="button" class="btn-cancel" onclick="confirmDelete()">Cancel Appointments</button>

            <?php echo Form::end() ?>
        </div>
    </div>
</div>

<script>
    var data = <?php echo (new Appointments())->getAllAppointmentsForMidwife() ?>;
    var itemsPerPage = 3;
    var currentPage = 1;

    var selectedAppointmentIds = [];

    function displayTableData() {
        var startIndex = (currentPage - 1) * itemsPerPage;
        var endIndex = startIndex + itemsPerPage;
        var tableBody = document.getElementById('tableBody');
        tableBody.innerHTML = '';

        for (var i = startIndex; i < endIndex && i < data.length; i++) {
            var row = data[i];
            var newRow = document.createElement('tr');
            newRow.innerHTML = `
                <td><input type="checkbox" class="tickCheckbox" data-appointmentid="${row.AppointmentId}"></td>
                <td>${row.AppointmentId}</td>
                <td>${row.AppointDate}</td>
                <td>${row.time}</td>
                <td>${row.Name}</td>
                <td>${row.AppointType}</td>
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
            });
            pagination.appendChild(pageButton);
        }
    }

    document.addEventListener("DOMContentLoaded", function () {
        displayTableData();
        displayPagination();
        attachListeners();
    });

    function updateSelectedAppointments() {
        selectedAppointmentIds = [];
        var checkboxes = document.getElementsByClassName("tickCheckbox");
        for (var i = 0; i < checkboxes.length; i++) {
            if (checkboxes[i].checked) {
                selectedAppointmentIds.push(parseInt(checkboxes[i].getAttribute('data-appointmentid')));
            }
        }
        document.getElementsByName('AppointmentId')[0].value = selectedAppointmentIds.join(',');
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
            updateSelectedAppointments();
        });

        var checkboxes = document.getElementsByClassName("tickCheckbox");
        for (var i = 0; i < checkboxes.length; i++) {
            checkboxes[i].addEventListener('change', function () {
                updateSelectedAppointments();
            });
        }
    }

</script>