<?php
    /** @var $this app\core\view */

    use app\core\Application;
    use app\core\form\Form;
    use app\core\Model;
    use app\models\Clinic;
    use app\models\Post;

    $this->title = 'Posts';
    ?>
    <!---->
    <?php
    /** @var $model Post **/
    /** @var $modelUpdate Post **/
    //?>


    <link rel="stylesheet" href="./assets/styles/Form.css">
    <link rel="stylesheet" href="./assets/styles/table.css">
    <link rel="stylesheet" href="./assets/styles/post.css">
<h1>Postnatal Mother - Posts</h1>
    <!--post update popup-->
    <div id="myPopup" class="popup">
        <div class="popup-content">
            <h1 style="color: rgb(0, 15, 128);">Update Post<br/><br/></h1>
            <form action="">
                <div class="form-group">
                    <label>Post ID</label>
                    <input type="text" id="UpdateId" name="UpdateId" value=""  class="form-control " disabled>
                    <div class="invalid-feedback">
                    </div>
                </div>

                <div class="form-group">
                    <label>New Description</label>
                    <input type="text" id="UpdateDescription" name="UpdateDescription" value=""  class="form-control ">
                    <div class="invalid-feedback">
                    </div>
                </div>

                <div class="form-group">
                    <div style="display: flex;gap: 5px"><label>Status</label>
                        <div class="radio-inputs">
                            <label class="radio">
                                <input type="radio" name="radio" value="0"  checked="">
                                <span class="name">Pending</span>
                            </label>
                            <label class="radio">
                                <input type="radio" name="radio" value="1">
                                <span class="name">Attended</span>
                            </label>

                            <label class="radio">
                                <input type="radio" name="radio" value="2">
                                <span class="name">Completed</span>
                            </label>
                        </div>
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

    <!--post delete popup-->
    <div id="myPopupRemove" class="popup">
        <div class="selectedRow" id="selectedRow" style="display: none"></div>
        <div class="popup-content">
            Please confirm before deleting this post. This action cannot be undone.
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

    <div class="clinics content" style="display: flex; flex-direction: row">
        <div class="shadowBox" style="max-width: 700px; height: fit-content">
            <div class="left-content">
                <div class="search-container">
                    <input type="text" placeholder="Search Posts...">
                    <button type="submit">Search</button>
                </div>
                <table class="posts_table">
                    <thead>
                    <tr>
                        <th>Post ID</th>
                        <th>Description</th>
                        <th>Created At</th>
                        <th>Last Updated At</th>
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
        <div class="shadowBox" style="height: fit-content">
            <div class="right-content" style="margin-top: 10px">
                <h2>Create a new post <br/><br/></h2>
                <?php $form = Form::begin('', "post")?>
                <?php echo $form->field($model, 'description', 'Please describe your requirement')?>
                <button type="submit" class="btn-submit">Submit</button>
                <?php echo Form::end()?>
            </div>
        </div>

    </div>


    <script>
        var data = <?php echo $model->getPosts()?>;
        var itemsPerPage = 8;
        var currentPage = 1;

        function displayTableData() {
            var startIndex = (currentPage - 1) * itemsPerPage;
            var endIndex = startIndex + itemsPerPage;
            var tableBody = document.getElementById('tableBody');
            tableBody.innerHTML = '';

            for (var i = startIndex; i < endIndex && i < data.length; i++) {
                var row = data[i];
                var statusTextMap = {
                    0: "pending",
                    1: "attended",
                    2: "completed"
                };
                var statusText = statusTextMap[row.status];
                var newRow = document.createElement('tr');
                newRow.innerHTML = `
                    <td>${row.id}</td>
                    <td>${row.description}</td>
                    <td>${row.created_at}</td>
                    <td>${row.updated_at}</td>
                    <td>${statusText}</td>
                    <td class="action-buttons">
                    <button id="showPopUp" onclick="UpdatePopUp(${row.id})" class="action-button update-button">Update</button>
                    <button class="action-button remove-button" onclick="UpdatePopUp(${row.id})">Delete</button>
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
        function getPostDetails(id) {
            const url = `/getPostDetails?id=${id}`;

            return fetch(url)
                .then((response) => {
                    if (response.ok) {
                        return response.json();
                    } else {
                        throw new Error('Failed to fetch data');
                    }
                });
        }

        function UpdatePopUp(postID){

            var labels = document.querySelectorAll('form label');
            const Status = document.getElementsByName('radio');

            getPostDetails(postID)
                .then((data) => {
                    var inputFieldId, inputFieldName, inputFieldAddress;
                    for (var i = 0; i < labels.length; i++) {
                        if (labels[i].textContent === 'Post ID') {
                            inputFieldId = labels[i].nextElementSibling;
                        }
                        else if (labels[i].textContent === 'New Description') {
                            inputFieldName = labels[i].nextElementSibling;
                        }
                    }

                    if (inputFieldId) {
                        inputFieldId.value = postID;
                        inputFieldId.disabled = true;
                    }
                    if (inputFieldName) {
                        inputFieldName.value = data.description;
                    }
                    for(var i=0;i<Status.length;i++){
                        if(Status[i].value == data.status){
                            Status[i].checked = true;
                        }
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

            const id = document.querySelector('input[name="UpdateId"]').value;
            const description = document.querySelector('input[name="UpdateDescription"]').value;
            let status = document.querySelector('input[name="radio"]:checked');


            console.log(id, description, status)

            const formData = new FormData();
            formData.append('id', id);
            formData.append('description', description);
            formData.append('status', status.value);

            const url = '/postsUpdate';

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
                                    console.log("found");
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

            const id = document.querySelector('input[name="UpdateId"]').value;

            const formData = new FormData();
            formData.append('id', id);

            const url = '/postDelete';

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
            if (event.target === myPopupRemove) {
                myPopupRemove.classList.remove("show");
            }
        });
    </script>