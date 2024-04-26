<?php
/** @var $this app\core\view */

use app\core\Application;
use app\core\form\Form;
use app\models\Clinic;
use app\models\Doctor;

$this->title = 'Doctors';
?>

<?php
/** @var $model Doctor **/
/** @var $modelUpdate Doctor **/
//?>



<link rel="stylesheet" href="./assets/styles/Form.css">
<link rel="stylesheet" href="./assets/styles/table.css">

<h1>Admin - Doctors</h1>
<div id="myPopup" class="popup">
    <div class="popup-content">
        <h1 style="color: rgb(0, 15, 128);">Update Doctor Details<br/><br/></h1>
        <form action="">

            <div class="form-group">

                <label>Doctor ID</label>
                <input type="text" id="DoctorId" name="DoctorId" value=""  class="form-control ">
                <div class="invalid-feedback">

                </div>

                <label>Doctor Name</label>
                <input type="text" id="DoctorName" name="DoctorName" value=""  class="form-control ">
                <div class="invalid-feedback">

                </div>

                <label for="UpdateId">Select new Clinic for transfer</label>
                <select id="UpdateId" name="UpdateId" class="js-select2 custom-select" required>
                    <option value="" selected disabled>Select Clinic</option>
                    <?php foreach ((new Clinic())->getClinicsList() as $clinic): ?>
                        <option value="<?php echo $clinic['id'] ?>"><?php echo $clinic['name'] ?></option>
                    <?php endforeach; ?>
                </select>


                <style>
                    .js-select2 {
                        width: 110%;
                        height: 130%;
                        padding: 0;
                    }
                </style>

                <div class="invalid-feedback">
                </div>

            </div>

        </form>
        <div class="buttonRow">
            <button id="closePopup" class="btn-submit" style="background-color: brown;">
                Close
            </button>
            <button type="submit" id="updateButton" class="btn-submit">
                Update
            </button>
        </div>
    </div>
    <br>
</div>


<div id="myPopupRemove" class="popup">
    <div class="popup-content">
        Please confirm before removing this Doctor. This action can't be undone.
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

<div class="content">
    <div class="left-content">
        <div class="shadowBox">
            <div class="left-content">
                <div class="search-container">
                    <input type="text" placeholder="Search Doctor...">
                    <button type="submit">Search</button>
                </div>
                <table class="table-data">
                    <thead>
                    <tr>
                        <th>Doctor ID</th>
                        <th>Name</th>
                        <th>SLMC ID</th>
                        <th>Clinic</th>
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
    <div class="right-content">
        <div class="shadowBox">
            <h2>Add a New Doctor <br/><br/></h2>
            <?php $form = Form::begin('', "post")?>
            <?php echo $form->field($model, 'nic', 'NIC')?>
            <?php echo $form->field($model, 'SLMC_no', 'SLMC ID')?>
            <div class="form-group">
                <label for="clinic_id">Clinic</label>
                <br>
                <select id="clinic_id" name="clinic_id" class="js-select2 custom-select" required>
                    <option value="" selected disabled>Select Clinic</option>
                    <?php foreach ((new Clinic())->getClinicsList() as $clinic): ?>
                        <option value="<?php echo $clinic['id'] ?>"><?php echo $clinic['name'] ?></option>
                    <?php endforeach; ?>
                </select>

                <style>
                    .js-select2 {
                        width: 110%;
                        height: 130%;
                        padding: 0;
                    }
                </style>
                <div class="invalid-feedback"></div>
            </div>

            <script>
                // Initialize Select2
                $(document).ready(function () {
                    $('.js-select2').select2();
                });
            </script>

            <button type="submit" class="btn-submit">Submit</button>
            <?php echo Form::end()?>
        </div>
    </div>
</div>

<script>
    var data = <?php echo $model->getDoctors()?>;

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
            <td>${row.MOH_ID}</td>
            <td>${row.Name}</td>
            <td>${row.SLMC_no}</td>
            <td>${row.clinic_id}</td>
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

<script>
       var myPopup = document.getElementById('myPopup');
       var closeButton = document.getElementById('closePopup');
       var popupButtonContainer = document.querySelector('.content');

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

   function UpdatePopUp(MOH_ID, Name){

       var labels = document.querySelectorAll('form label');

       const DocId = document.getElementById('DoctorId');
       const DocName = document.getElementById('DoctorName');

       DocId.value = MOH_ID;
       DocName.value = Name;
       DocId.disabled = true;
       DocName.disabled = true;

       var inputFieldId = getElementById('UpdateId');

       if (inputFieldId) {
           inputFieldId.value = DocId;
           inputFieldId.disabled = true;
       }

       getDoctorDetails(MOH_Id)
           .then((data) => {
               var inputFieldId = getElementById('UpdateId');

               if (inputFieldId) {
                   inputFieldId.value = DocId;
                   inputFieldId.disabled = true;
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

       const Clinic_id = document.getElementById('UpdateId').value;
       const MOH_id = document.querySelector('input[name="DoctorId"]').value;

       const formData = new FormData();
       formData.append('clinic_id', Clinic_id);
       formData.append('MOH_id', MOH_id);

       const url = '/doctorUpdate';

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

       const MOH_id = document.querySelector('input[name="DoctorId"]').value;

       const formData = new FormData();
       formData.append('MOH_id', MOH_id);

       const url = '/deleteDoctor';

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

   var popupButtonContainer = document.querySelector('.content');
   popupButtonContainer.addEventListener("click", function (event) {
       if (event.target.classList.contains('remove-button')) {
           showRemovePopup();
       }
   });

   window.addEventListener("click", function (event) {
       var myPopupRemove = document.getElementById('myPopupRemove');
       if (event.target === myPopupRemove) {
           myPopupRemove.classList.remove("show");
       }
   });
</script>