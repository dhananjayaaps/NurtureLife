<?php
/** @var $this app\core\view */

use app\core\Application;
use app\core\form\Form;
use app\core\Model;
use app\models\Clinic;
use app\models\Post;
use app\models\Post_request;

$this->title = 'Midwife - Posts';
?>
<!---->
<?php
/** @var $model Post **/
/** @var $modelUpdate Post **/
/** @var $modelRequest Post_request **/
//?>
<style>
    .content{
        padding-left: 70px;
    }
</style>


<link rel="stylesheet" href="./assets/styles/Form.css">
<link rel="stylesheet" href="./assets/styles/table.css">
<link rel="stylesheet" href="./assets/styles/post.css">

<h1 style="margin-left: 100px">Midwife - Posts</h1>
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
                <label>New Topic</label>
                <input type="text" id="UpdateTopic" name="UpdateTopic" value=""  class="form-control ">
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

<div class="clinics content" style="display: flex; flex-direction: row; margin: 0 10px 10px 10px; ">
<!--    posts table-->
    <div class="shadowBox" style="max-width: 700px; height: fit-content;">
        <div class="left-content" style="margin-left: 20px">
            <div class="search-container">
                <input type="text" placeholder="Search Posts...">
                <button type="submit">Search</button>
            </div>
            <table class="posts_table">
                <thead>
                <tr>
                    <th>Post ID</th>
                    <th>Topic</th>
                    <th>Description</th>
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
<!--    create post form-->
    <div class="shadowBox" style="height: 445px">
        <div class="right-content" style="margin-top: 10px">
            <h2>Create a new post <br/><br/></h2>
            <?php $form = Form::begin('', "post")?>
            <?php echo $form->field($model, 'topic', 'Please give a topic to your requirement')?>
            <?php echo $form->field($model, 'description', 'Please describe your requirement')?>
            <button type="submit" class="btn-submit">Submit</button>
            <?php echo Form::end()?>
        </div>
    </div>
<!--    post request container-->
        <div class="notification-bar" style="height: 400px; border-radius: 20px; box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;">
            <div class="notifications">
                <span style="font-size: 20px; font-weight: bold;text-align: center">Post Replies</span>
            </div>
            <div class="scrollable-container" style="max-height: 500px; overflow-y: auto">
                <?php $post_requests= json_decode($modelRequest->getRequests());
                foreach ($post_requests as $post_request):?>
                    <div class="myBox" id="myBox" style=" height: 250px">
                        <div class="notification emergency">
                            <div class="message-box" style="; height: fit-content">
                                <div class="title"><?=$post_request->vol_name?> &#9900 Volunteer</div>
                                <div class="notification-content">
                                    <h3>Post</h3>
                                    <b><?=$post_request->topic." - ".$post_request->description?></b>
                                </div>
                                <div class="notification-content">
                                    <h3>Request</h3>
                                    <b><?=$post_request->req?></b>
                                </div>
                                <div class="notification-footer">
                                    <div class="dates">
                                        <span class="created-date">Created: <?=$post_request->req_created_at?></span><br>
                                    </div>
                                    <div class="status">
                                        Status: <?=($post_request->req_status==0)?'Waiting':(($post_request->req_status==1)?'Accepted':'Rejected');?>
                                    </div>
                                    <?php if($post_request->req_status==0):?>
                                    <div class="actions" style="display: flex; flex-direction: row; gap: 20px; margin: 10px">
                                        <button class="button" style="background-color: #159EEC" onclick="postReqUpdate(<?=$post_request->id?>,1,<?=$post_request->post_id?>)">Accept</button>
                                        <button class="button" style="background-color: #ffb366" onclick="postReqUpdate(<?=$post_request->id?>,2,<?=$post_request->post_id?>)">Reject</button>
                                    </div>
                                    <?php endif;?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach;?>
            </div>
        </div>


</div>


<script>
    var data = <?php echo $model->getPosts()?>;
    var itemsPerPage = 7;
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

            // Extract the first 3 words from the description
            var descriptionWords = row.description.split(' ');
            var truncatedDescription = descriptionWords.slice(0, 4).join(' ');
            newRow.innerHTML = `
        <td>${row.id}</td>
        <td>${row.topic}</td>
        <td>${truncatedDescription}...</td> <!-- Display the truncated description -->
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
                var inputFieldId, inputFieldName, inputFieldTopic;
                for (var i = 0; i < labels.length; i++) {
                    if (labels[i].textContent === 'Post ID') {
                        inputFieldId = labels[i].nextElementSibling;
                    }
                    else if (labels[i].textContent === 'New Topic') {
                        inputFieldTopic = labels[i].nextElementSibling;
                    }
                    else if (labels[i].textContent === 'New Description') {
                        inputFieldName = labels[i].nextElementSibling;
                    }
                }

                if (inputFieldId) {
                    inputFieldId.value = postID;
                    inputFieldId.disabled = true;
                }
                if (inputFieldTopic) {
                    inputFieldTopic.value = data.topic;
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
        const topic = document.querySelector('input[name="UpdateTopic"]').value;
        const description = document.querySelector('input[name="UpdateDescription"]').value;
        let status = document.querySelector('input[name="radio"]:checked');


console.log(id, description, status)

        const formData = new FormData();
        formData.append('id', id);
        formData.append('topic', topic);
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
                    // console.log(response.text())
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


<script>
    //post req update
    function postReqUpdate (id,status,post_id) {
var res=0;
        if(status==1){
            if (confirm("Do you agree to share your contact details with the volunteer and accept the request?")) {
               res=1;
            }
        }else if(status==2){
            if (confirm("Are you sure you want to Reject?")) {
                res=1;
            }
        }

if(res==1){
        const formData = new FormData();
        formData.append('id', id);
    formData.append('status', status);
    formData.append('post_id', post_id);

        const url = '/postRequestUpdate';

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
}
    }
</script>
