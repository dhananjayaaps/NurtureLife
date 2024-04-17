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

<!---->
<!--<div id="myPopup" class="popup">-->
<!--    <div class="popup-content">-->
<!--        <h1 style="color: rgb(0, 15, 128);">Update Clinic Details<br/><br/></h1>-->
<!--        <form action="">-->
<!---->
<!--            <div class="form-group">-->
<!---->
<!--                <label>Doctor ID</label>-->
<!--                <input type="text" id="DoctorId" name="DoctorId" value=""  class="form-control ">-->
<!--                <div class="invalid-feedback">-->
<!---->
<!--                </div>-->
<!---->
<!--                <label>Doctor Name</label>-->
<!--                <input type="text" id="DoctorName" name="DoctorName" value=""  class="form-control ">-->
<!--                <div class="invalid-feedback">-->
<!---->
<!--                </div>-->
<!---->
<!--                <label>Select new Clinic for transfer</label>-->
<!--                <input type="text" id="UpdateId" name="UpdateId" value=""  class="form-control ">-->
<!--                <div class="invalid-feedback">-->
<!---->
<!--                </div>-->
<!--            </div>-->
<!---->
<!--        </form>-->
<!--        <div class="buttonRow">-->
<!--            <button type="submit" id="updateButton" class="btn-submit">-->
<!--                Update-->
<!--            </button>-->
<!--            <button id="closePopup" class="btn-submit" style="background-color: brown;">-->
<!--                Close-->
<!--            </button>-->
<!--        </div>-->
<!--    </div>-->
<!--    <br>-->
<!--</div>-->
<!---->
<!---->
<!--<div id="myPopupRemove" class="popup">-->
<!--    <div class="popup-content">-->
<!--        Do You Really Need to Remove This? That can't be undone-->
<!--        <div class="buttonRow" style="display: flex; flex-direction: row; gap: 10px;">-->
<!--            <button id="closePopup" class="btn-submit">-->
<!--                Close-->
<!--            </button>-->
<!--            <button id="closePopupRemove" class="btn-submit" style="background-color: brown;">-->
<!--                Remove-->
<!--            </button>-->
<!--        </div>-->
<!--    </div>-->
<!--</div>-->

<style>
    .content {
        padding: 0;
        height: 90%;
        justify-content: space-around;
        width: 100%;
        margin-top: 10px;
    }
</style>

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
<!--                    <th>Delivery Date</th>-->
<!--                    <th>Midwife</th>-->
<!--                    <th>Address</th>-->
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
    <div class="shadowBox">
        <div class="Right-content">
        <h2>Select the Appointment Details</h2>
            <br>
            <?php $form = Form::begin('', "post")?>
            <?php echo $form->field($appointmentModel, 'MotherId', 'Mother ID')?>

            <?php
            $maritalStatusField = new Dropdown($appointmentModel, 'AppointType', 'Appoint Type');
            $maritalStatusField->setOptions([
                0 => 'Antenatal Clinic',
                1 => 'Postnatal Clinic',
                2 => 'Well baby Clinic',
                3 => 'Nutrition clinic',
                4 => 'Well women clinic',
                5 => 'Family planning clinic',
            ]);
            echo $maritalStatusField;
            ?>

            <?php echo $form->dateField($appointmentModel, 'AppointDate', 'Appoint Date')?>
            <?php echo $form->field($appointmentModel, 'AppointRemarks', 'Remarks')?>

            <button type="submit" class="btn-submit">Submit</button>
            <?php echo Form::end()?>
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
            <td><input type="checkbox" class="tickCheckbox"></td>
            <td>${row.MotherId}</td>
            <td>${row.Name}</td>
            <td>${row.Status}</td>
<!--            <td>${row.DeliveryDate}</td>-->
<!--            <td>${row.PHM_id}</td>-->
            <td>Colombo</td>
<!--            <td>Maharagama</td>-->
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
    document.getElementById("selectAll").addEventListener("change", function () {
        var checkboxes = document.getElementsByClassName("tickCheckbox");
        for (var i = 0; i < checkboxes.length; i++) {
            checkboxes[i].checked = this.checked;
        }
    });

    function getSelectedMotherIDs() {
        var selectedMotherIDs = [];
        var checkboxes = document.getElementsByClassName("tickCheckbox");
        for (var i = 0; i < checkboxes.length; i++) {
            if (checkboxes[i].checked) {
                var motherID = checkboxes[i].getAttribute("data-motherid");
                selectedMotherIDs.push(motherID);
            }
        }
        return selectedMotherIDs;
    }
</script>