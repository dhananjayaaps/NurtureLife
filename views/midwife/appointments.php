<?php
/** @var $this app\core\view */

use app\core\Application;
use app\core\form\DropDown;
use app\core\form\Form;
use app\models\Appointments;
use app\models\Mother;

$this->title = 'Cancel Appointments';
?>

<style>
    .content{
        justify-content: flex-start;
        display: flex;
        flex-direction: column;
    }
</style>

<link rel="stylesheet" href="./assets/styles/table.css">
<link rel="stylesheet" href="./assets/styles/form.css">

<h1>Midwife - Cancel Appointments</h1>

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
            <div class="search-container">
                <input type="text" placeholder="Search Appointments...">
                <button type="submit">Search</button>
            </div>
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
</div>

<script>
    var data = <?php echo (new Appointments())->getAllAppointmentsForMidwife() ?>;
    var itemsPerPage = 3;
    var currentPage = 1;

    var selectedIdNumbers = [];

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
                <td><button class="action-button" onclick="cancelAppointment(${row.AppointmentId})">Cancel</button></td>
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
    });

    function cancelAppointment(appointmentId) {
        // Implement cancellation logic here
        //use deleteAppointments method in the Appointments model to delete the appointment
        //pass the appointmentId as an array to the deleteAppointments method
        alert("Appointment with ID " + appointmentId + " is canceled.");
        // You can add further logic here, like updating the UI or sending a request to the server to cancel the appointment.
    }

    var selectedAppointmentIds = [];

    function updateSelectedAppointments() {
        selectedAppointmentIds = [];
        var checkboxes = document.getElementsByClassName("tickCheckbox");
        for (var i = 0; i < checkboxes.length; i++) {
            if (checkboxes[i].checked) {
                selectedAppointmentIds.push(parseInt(checkboxes[i].getAttribute('data-appointmentid')));
            }
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
            updateSelectedAppointments();
        });

        var checkboxes = document.getElementsByClassName("tickCheckbox");
        for (var i = 0; i < checkboxes.length; i++) {
            checkboxes[i].addEventListener('change', function () {
                updateSelectedAppointments();
            });
        }
    }

    document.addEventListener("DOMContentLoaded", function () {
        displayTableData();
        displayPagination();
        attachListeners();
    });

    function cancelAppointment(appointmentId) {
        var popup = document.getElementById('myPopupRemove');
        var selectedRow = document.getElementById('selectedRow');
        selectedRow.innerHTML = "Appointment ID: " + appointmentId;
        popup.style.display = "block";

        var closePopup = document.getElementById('closePopup');
        closePopup.addEventListener('click', function () {
            popup.style.display = "none";
        });

        var closePopupRemove = document.getElementById('closePopupRemove');
        closePopupRemove.addEventListener('click', function () {
            popup.style.display = "none";
            // Implement cancellation logic here
            const formData = new FormData();
            formData.append('AppointmentId', appointmentId);
            fetch('/cancel-appointment', {
                method: 'POST',
                body: formData
            }).then(response => response.json()).then(data => {
                if (data.success) {
                    <?php Application::$app->session->setFlash('success', 'Cancelled successfully');?>
                    window.location.reload();
                } else {
                    <?php Application::$app->session->setFlash('error', 'Fail to Cancel Appointment');?>
                }
            });
            alert("Appointment with ID " + appointmentId + " is canceled.");

        });
    }

</script>
