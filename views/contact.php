<?php
/** @var $this app\core\view */

use app\core\form\Form;
use app\models\Feedback;
use app\models\User;

$this->title = 'User FeedbackController';
?>

<?php
/** @var $model Feedback **/
?>

<style>
    .contact_main{
        display: flex;
        flex-direction: row;
        height: fit-content;
        /*border-style: solid;*/
        justify-content: space-between;
    }
    .contact_left, .contact_mid, .contact_right{
        display: flex;
        flex-direction: column;
        width: 35%;
        height: fit-content;
        margin: 5px;
        gap: 10px;
        /*border-style: solid;*/
        padding: 5px;
        box-shadow: rgba(50, 50, 93, 0.25) 0px 50px 100px -20px, rgba(0, 0, 0, 0.3) 0px 30px 60px -30px, rgba(10, 37, 64, 0.35) 0px -2px 6px 0px inset;
        border-radius: 20px;
    }
    .contact_mid{
        width: 30%;
    }
    .contact_left{
        padding-bottom: 20px;
    }
    .contact_right {
        padding: 5px 5px 5px 20px;
    }
    .head{
        /*border-style: solid;*/
        padding: 10px;
    }
    .body{
        /*border-style: solid;*/
    }
    .body img{
        width: 100%;
    }
    .contact_mid img{
        border-radius: 20px;
    }
    .row{
        display: flex;
        flex-direction: row;
        width: 98%;
        gap: 5px;
        margin: 5px 5px 10px 5px;
        /*border-style: solid;*/
        box-shadow: rgba(6, 24, 44, 0.4) 0px 0px 0px 2px, rgba(6, 24, 44, 0.65) 0px 4px 6px -1px, rgba(255, 255, 255, 0.08) 0px 1px 0px inset;
        border-radius: 20px;
    }
    .icon_container{
        width: 10%;
        /*border-style: solid;*/
        margin: 5px;
    }
    .icon_container img{
        width: 40px;
    }
    .detail{
        width: 90%;
        /*border-style: solid;*/
        margin: 5px;
        text-align: left;
    }
    .detail h3{
        margin: 10px 0 0 10px;
    }
    .detail a{
        text-decoration: none;
        color: black;
    }

</style>
<link rel="stylesheet" href="./assets/styles/Form.css">
<div class="contact_main">
    <div class="contact_left">
        <div class="head">
            <h1>Contact Us</h1>
        </div>
        <div class="body">
            <div class="row">
                <div class="icon_container">
                    <img src="./assets/images/icons/phone_icon.png" alt="phone">
                </div>
                <div class="detail">
                    <h3>077-977-3264</h3>
                </div>
            </div>
            <div class="row">
                <div class="icon_container">
                    <img src="./assets/images/icons/fax_icon.png" alt="phone">
                </div>
                <div class="detail">
                    <h3>011-283-4618</h3>
                </div>
            </div>
            <div class="row">
                <div class="icon_container">
                    <img src="./assets/images/icons/email_icon.png" alt="phone">
                </div>
                <div class="detail">
                    <h3>admin.nurturelife@gmail.com</h3>
                </div>
            </div>
            <div class="row">
                <div class="icon_container">
                    <img src="./assets/images/icons/facebook_icon.png" alt="phone">
                </div>
                <div class="detail">
                    <a href="https://www.facebook.com/UCSCTrolls" target="_blank"><h3>https://www.facebook.com/NurtureLife</h3></a>
                </div>
            </div>
            <div class="row">
                <div class="icon_container">
                    <img src="./assets/images/icons/x_icon.png" alt="phone">
                </div>
                <div class="detail">
                    <a href="https://x.com/MoH_SriLanka" target="_blank"><h3>https://www.x.com/NurtureLife</h3></a>
                </div>
            </div>
            <div class="row">
                <div class="icon_container">
                    <img src="./assets/images/icons/location_icon.png" alt="phone">
                </div>
                <div class="detail">
                    <a href="https://maps.app.goo.gl/QUgRr35vDCzK79qH7" target="_blank"><h3>Find Ministry of Health Sri Lanka</h3></a>
                </div>
            </div>
        </div>

    </div>
    <div class="contact_mid">
        <div class="head">
            <h1>We Nurture Life</h1>
        </div>
        <div class="body">
            <img src="./assets/images/contact_page_team.jpeg" alt="contact_page_midwife">
        </div>

    </div>
    <div class="contact_right">
        <div class="head">
            <h1>Send us your feedback</h1>
        </div>
        <div class="body">
            <?php $form = Form::begin('', "post")?>
            <?php echo $form->field($model, 'feedback', 'Message')?>
            <?php echo $form->field($model, 'email', 'Your Email')?>
            <button type="submit" class="btn-submit" style="margin-left: 50px">Submit</button>
            <?php echo Form::end()?>
            <div class="row" style="box-shadow: none; flex-direction: column">
                <h3>We Value Your Feedback!</h3>
                <p>Your insights and experiences are vital to us. They help us understand what we're doing well and where we can improve. Please take a moment to share your thoughts about our maternity care system.</p>
                <p>Please type your feedback in the box below and include your email address so we can follow up if necessary. Thank you for helping us enhance our service!</p>
                <h3>Your voice matters to us!</h3>
                <h4>&#9734 Team NurtureLife</h4>
            </div>
        </div>
    </div>

</div>

