<?php
/** @var $this app\core\view */

use app\core\Application;
use app\core\form\Form;
use app\core\Model;
use app\models\Admin;

$this->title = 'Admins';
?>
<!---->
<?php
/** @var $model Admin **/
/** @var $modelUpdate Admin **/
//?>


<link rel="stylesheet" href="./assets/styles/Form.css">
<link rel="stylesheet" href="./assets/styles/table.css">


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

<div class="clinics content">
    <div class="shadowBox">
        <div class="left-content">
            <div class="search-container">
                <input type="text" placeholder="Search Admin...">
                <button type="submit">Search</button>
            </div>
            <table class="table-data">
                <thead>
                <tr>
                    <th>Admin ID</th>
                    <th>Name</th>
                    <th>NIC</th>
                    <th>Contact</th>
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
    <div class="right-content">
        <div class="shadowBox">
            <h2>Add a New Admin <br/><br/></h2>
            <?php $form = Form::begin('', "post")?>
            <?php echo $form->field($model, 'nic', 'NIC Number')?>
            <button type="submit" class="btn-submit">Submit</button>
            <?php echo Form::end()?>
        </div>
    </div>

</div>


<script>
    var data = <?php echo $model->getAdmins()?>;
    var itemsPerPage = 8;
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
                    <td>${row.admin_id}</td>
                    <td>${row.name}</td>
                    <td>${row.nic}</td>
                    <td>${row.contact}</td>
                    <td class="action-buttons">
                    <button class="action-button remove-button" data-admin-id=${row.admin_id};">Remove</button>
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
        if (event.target === myPopup) {
            myPopup.classList.remove("show");
        }
    });
</script>


<script>
    document.getElementById('closePopupRemove').addEventListener('click', function (e) {
        e.preventDefault();

        const id = document.getElementById('selectedRow').innerHTML;

        const formData = new FormData();
        formData.append('id', id);

        const url = '/deleteAdmin';

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
    function UpdatePopUp(id) {
        showRemovePopup(id);
    }

    function showRemovePopup(id) {
        var myPopupRemove = document.getElementById('myPopupRemove');
        myPopupRemove.classList.add("show");
        document.getElementById('selectedRow').innerHTML = id;
    }
</script>