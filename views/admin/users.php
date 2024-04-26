<?php
/** @var $this app\core\view */

use app\core\Application;
use app\core\form\Form;
use app\models\Clinic;
use app\models\Doctor;
use app\models\User;

$this->title = 'Users';
?>

<?php
/** @var $model User * */
/** @var $modelUpdate User * */
//?>


<link rel="stylesheet" href="./assets/styles/Form.css">
<link rel="stylesheet" href="./assets/styles/table.css">

<h1>Admin - User Management</h1>
<!--user update popup-->
<div id="myPopup" class="popup">
    <div class="popup-content">
        <h1 style="color: rgb(0, 15, 128);">Update User Details<br/><br/></h1>
        <form action="">

            <div class="form-group">

                <label>User ID</label>
                <input type="text" id="UserId" name="UserId" value="" class="form-control " disabled>

                <label>User Name</label>
                <input type="text" id="UserName" name="UserName" value="" class="form-control " disabled>

                <div style="display: flex;gap: 5px; margin: 10px">
                    <label>Status</label>
                    <div class="checkbox-wrapper-35">
                        <input value="private" name="status" id="switch" type="checkbox" class="switch">
                        <label for="switch">
                            <span class="switch-x-text"></span>
                            <span class="switch-x-toggletext">
                              <span class="switch-x-unchecked"><span class="switch-x-hiddenlabel">Unchecked: </span>Inactive</span>
                              <span class="switch-x-checked"><span class="switch-x-hiddenlabel">Checked: </span>Active</span>
                            </span>
                        </label>
                    </div>
                </div>

                <div style="display: flex;gap: 5px; margin: 10px>
                    <label for="role_id">Role</label>
                    <select id="role_id" name="role">
                        <option value="1" >User</option>
                        <option value="2">Admin</option>
                        <option value="3">Doctor</option>
                        <option value="4">Prenatal Mother</option>
                        <option value="5" >Postnatal Mother</option>
                        <option value="6">Midwife</option>
                    </select>
                </div>

            </div>

            <div class="buttonRow">
                <button id="closePopup" class="btn-submit" style="background-color: brown;">
                    Close
                </button>
                <button type="submit" id="updateButton" class="btn-submit">
                    Update
                </button>
            </div>
        </form>

    </div>
    <br>
</div>


<div class="content">
    <div class="left-content">
        <div class="shadowBox">
            <div class="left-content" style="margin: 0">
                <div class="search-container">
                    <input type="text" placeholder="Search User...">
                    <button type="submit">Search</button>
                </div>
                <table class="table-data">
                    <thead>
                    <tr>
                        <th>User ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Contact No</th>
                        <th>role</th>
                        <th>Status</th>
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
</div>

<script>
    var data = <?php echo $model->getUsers()?>;

    var itemsPerPage = 10;
    var currentPage = 1;

    function displayTableData() {
        var startIndex = (currentPage - 1) * itemsPerPage;
        var endIndex = startIndex + itemsPerPage;
        var tableBody = document.getElementById('tableBody');
        tableBody.innerHTML = '';

        for (var i = startIndex; i < endIndex && i < data.length; i++) {
            var row = data[i];
            var statusText = row.status === 1 ? "Active" : "Inactive";
            var roleMap = {
                1: "user",
                2: "admin",
                3: "doctor",
                4: "prenatal mother",
                5: "postnatal mother",
                6: "midwife"
            };
            var role = roleMap[row.role_id];
            var newRow = document.createElement('tr');
            newRow.innerHTML = `
            <td>${row.user_id}</td>
            <td>${row.name}</td>
            <td>${row.email}</td>
            <td>${row.contact_no}</td>
            <td>${role}</td>
            <td>${statusText}</td>
            <td class="action-buttons">
            <button id="showPopUp" onclick="UpdatePopUp('${row.user_id}', '${row.name}', '${statusText}', '${role}')" class="action-button update-button">Update</button>
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

    function UpdatePopUp(user_id, name, status, role) {
console.log(role)
        const UserId = document.getElementById('UserId');
        const UserName = document.getElementById('UserName');
        const Status = document.getElementById('switch');
        const Role = document.getElementById('role_id');
        const options=Role.options;

        for(var i=0;i<options.length;i++){
            if(options[i].textContent.toLowerCase()==role){
                // console.log(options[i].textContent)

                options.selectedIndex=i;
                console.log(options.selectedIndex)
            }
        }


        UserId.value = user_id;
        UserName.value = name;
        Status.checked = status === "Active" ? true : false;
        // Role.value = role;

        getUserDetails(user_id)
            .then((data) => {
                UserId.value = data.user_id;
                UserName.value = data.name;
                Status.checked = data.status === 1 ? true : false;
                Role.value = data.role;
            })
            .catch((error) => {
                console.error(error);
            });
    }
</script>

<script>
    document.getElementById('updateButton').addEventListener('click', function (e) {
        console.log("fgh")
        e.preventDefault();
        const id = document.querySelector('input[name="UserId"]').value;
        let status = document.querySelector('input[name="status"]').checked;
        const role = document.getElementById("role_id").value;
        if (status) {
            status = 1;
        } else {
            status = 0;
        }
        console.log(id, status, role)
        const formData = new FormData();
        formData.append('id', id);
        formData.append('status', status);
        formData.append('role_id', role);
        const url = '/userUpdate';

        fetch(url, {
            method: 'POST',
            body: formData,
        })
            .then(response => {
                // console.log(response.json())
                if (response.ok) {
                    // console.log(response.json())
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