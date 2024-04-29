<?php
/** @var $this app\core\view */

use app\core\Application;
use app\models\LoginModel;
use app\models\Post;
use app\models\User;

$this->title = 'Volunteer';

/** @var $model Post **/
/** @var $user_model User **/
/** @var $modelUpdate Post **/
?>
<style>
    .volunteer_content{
        height: fit-content;
    }
</style>
<link rel="stylesheet" href="assets/css/styles.css">
<!--attend confirmation popup-->
<div id="myPopup" class="popup" style="position: fixed; left: 50%; top: 50%; transform: translate(-50%, -50%); width: 30%;height: fit-content; max-width: 600px; background-color: #fff; border-radius: 10px; box-shadow: 0 5px 15px rgba(0,0,0,0.3); padding: 20px; z-index: 1000;">
    <div class="popup-content">
        <h1 style="color: #003f88; text-align: center; margin-bottom: 30px;">Confirm Attendance</h1>
        <form action="">
            <div class="form-group" style="margin-bottom: 15px;">
                <label for="postIDValue" style="display: block; margin-bottom: 5px;">Post ID</label>
                <input type="text" id="postIDValue" name="UpdateId" value="" class="form-control" style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px;">
            </div>

            <div class="form-group" style="margin-bottom: 15px;">
                <label for="UpdateName" style="display: block; margin-bottom: 5px;">Topic</label>
                <input type="text" id="UpdateName" name="UpdateName" value="" class="form-control" style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px;">
            </div>

            <div class="form-group" style="margin-bottom: 15px;">
                <label for="UpdateAddress" style="display: block; margin-bottom: 5px;">Description</label>
                <input type="text" id="UpdateAddress" name="UpdateAddress" value="" class="form-control" style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px;">
            </div>

            <div class="form-group" style="margin-bottom: 15px;">
                <label for="requestValue" style="display: block; margin-bottom: 5px;">Request</label>
                <input type="text" id="requestValue" name="requestValue" value="" class="form-control" style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px;">
            </div>

            <p style="text-align: center; margin-top: 20px;">Please fill in all fields before submitting your request.</p>

            <div class="buttonRow" style="text-align: center; margin-top: 30px;">
                <button id="closePopup" class="btn-submit" style="padding: 10px 20px; border: none; background-color: #8b0000; color: white; border-radius: 5px; margin-right: 10px; cursor: pointer;">
                    Close
                </button>
                <button type="submit" id="updateButton" class="btn-submit" onclick="sendReq()" style="padding: 10px 20px; border: none; background-color: #4CAF50; color: white; border-radius: 5px; cursor: pointer;">
                    Request
                </button>
            </div>
        </form>
    </div>
</div>
<!--service seeker contact popup -->
<div id="myPopup2" class="popup" style="position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); width: 30%; background-color: white; border-radius: 10px; box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3); padding: 20px; z-index: 1000; height: fit-content">
    <div class="popup-content">
        <h1 style="color: #001f80; margin-bottom: 0.5em;">Contact Seeker</h1>
        <div class="notification-content">
            <h2></h2><br>
            <h2></h2><br>
            <h2></h2>
        </div>
        <div class="buttonRow" style="text-align: center; margin-top: 20px;">
            <button id="closePopup2" class="btn-submit" style="padding: 10px 20px; border: none; border-radius: 5px; background-color: #9c4668; color: white; cursor: pointer;">
                Close
            </button>
        </div>
    </div>
</div>

<!--posts container-->
<div class="shadowBox">
    <div class="notification-bar" style="height: 400px; border-radius: 20px">
        <div class="notifications">
            <span style="font-size: 20px; font-weight: bold;text-align: center">Posts from Mothers and Midwives in your area</span>
        </div>
        <div class="scrollable-container" style="max-height: 500px; overflow-y: auto">
            <?php
            $posts = json_decode($model->getPosts());
            foreach ($posts as $post) {
                if (($post->status === 0 || $post->status === 1) && $post->topic !== 'PHM') { // Check if status is 0 or 1 and topic is not PHM
                    ?>
                    <div class="myBox" id="myBox" style=" height: 250px">
                        <div class="notification emergency">
                            <div class="message-box" style="; height: fit-content">
                                <div class="title"><?=$post->user_name?> &#9900 <?=ucfirst($post->role_name)?></div>
                                <div class="notification-content">
                                    <h3><?=ucfirst($post->topic)?></h3>
                                    <b><?=$post->description?></b>
                                </div>
                                <div class="notification-footer">
                                    <div class="dates">
                                        <span class="created-date">Created: <?=$post->created_at?></span><br>
                                        <span class="updated-date">Last Updated: <?=$post->updated_at?></span>
                                    </div>
                                    <div class="status">
                                        Status: <?=($post->status==0)?'Pending':(($post->status==1)?'Attended':'Completed');?>
                                    </div>
                                    <div class="actions" style="display: flex; flex-direction: row; gap: 20px; margin: 10px">
                                        <button class="button" style="background-color: #159EEC" onclick="attendPopup(<?=$post->id?>)">Attend</button>
                                        <button class="button" style="background-color: #ffb366" onclick="contactPopup('<?=$post->user_name?>','<?=$post->contact_no?>','<?=$post->email?>')">Contact</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                }
            }
            ?>
        </div>
    </div>
</div>

<script>
    var myPopup = document.getElementById('myPopup');
    var myPopup2 = document.getElementById('myPopup2');
    var closeButton = document.getElementById('closePopup');
    var closeButton2 = document.getElementById('closePopup2');
    var popupButtonContainer = document.querySelector('.clinics.content');

    function attendPopup (data) {
        console.log(data);
        console.log(myPopup);
        // Get the parent div element with id "myPopup"

// Get all input elements within the popup
        var inputs = myPopup.querySelectorAll("input");
        getPostDetails(data)
            .then((dataValue) => {
                inputs[0].value=dataValue.id;
                inputs[1].value = dataValue.topic;

                inputs[2].value = dataValue.description;



            })
            .catch((error) => {
                console.error(error);
            });


        myPopup.classList.add("show");
    }

    closeButton.addEventListener("click", function () {
        myPopup.classList.remove("show");
    });
    closeButton2.addEventListener("click", function () {
        myPopup2.classList.remove("show");
    });

    window.addEventListener("click", function (event) {
        if (event.target === myPopup) {
            myPopup.classList.remove("show");

        }else if(event.target === myPopup2){
            myPopup2.classList.remove("show");
        }
    });


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


    function sendReq(){
        var req = myPopup.querySelectorAll("input#requestValue")[0].value;
        var postId = myPopup.querySelectorAll("input#postIDValue")[0].value;



        const formData = new FormData();
        formData.append('post_id', postId);
        formData.append('description', req);

        const url = '/createPostRequest';

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


    function contactPopup (name,phone,email) {

        if(phone!='') {
// Get all input elements within the popup
            var inputs = myPopup2.querySelectorAll("h2");
            inputs[0].innerHTML = name;
            inputs[1].innerHTML = phone;
            inputs[2].innerHTML = email;
        }else{
            var inputs = myPopup2.querySelectorAll("h2");
            inputs[0].innerHTML = "You are still not authorized to view contact details";
            inputs[1].innerHTML = "";
            inputs[2].innerHTML = "";
        }

        myPopup2.classList.add("show");
    }


</script>
