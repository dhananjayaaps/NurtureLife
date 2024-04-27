<?php
/** @var $this app\core\view */

use app\core\Application;
use app\core\form\Form;
use app\core\Model;
use app\models\Clinic;
use app\models\Post;
use app\models\Post_request;
use app\models\RoleRequest;

$this->title = 'Prenatal Mother-Posts';
?>
<!---->
<?php
/** @var $model RoleRequest **/
//?>


<link rel="stylesheet" href="./assets/styles/Form.css">
<link rel="stylesheet" href="./assets/styles/table.css">
<link rel="stylesheet" href="./assets/styles/post.css">

<h1>Request Roles</h1>

<div class="clinics content" style="display: flex; flex-direction: row; margin: 0 10px 10px 60px; ">
    <!--    create post form-->
    <div class="shadowBox" style="height: 445px">
        <div class="right-content" style="margin-top: 10px">
            <h2>Request user role from system administrator<br/><br/></h2>
            <?php $form = Form::begin('', "post")?>
            <?php echo $form->field($model, 'name', 'Please provide your full name')?>
            <?php echo $form->field($model, 'SLMC_no', 'Your SLMC registration number')?>
            <?php echo $form->field($model, 'requested_role', 'Role you are requesting')?>
            <button type="submit" class="btn-submit">Send</button>
            <?php echo Form::end()?>
        </div>
    </div>


</div>


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
                    else if (labels[i].textContent === 'New Message') {
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

