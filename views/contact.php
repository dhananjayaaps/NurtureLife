<?php
/** @var $this app\core\view */

use app\core\form\Form;
use app\models\Feedback;
use app\models\User;

$this->title = 'User Feedback';
?>

<?php
/** @var $model Feedback **/
?>

<style>
    .contact_main{
        display: flex;
        flex-direction: row;
        height: fit-content;
        background-color: #159EEC;
        margin-left: 100px;
    }
    .contact_left{
        display: flex;
        flex-direction: column;
    }
    .contact_right{

    }
</style>
<div class="contact_main">
    <div class="contact_left">
        <div class="head">
            <h1>Contact Us</h1>
        </div>
        <div class="body">

        </div>

    </div>
    <div class="contact_right">
        <div class="head">
            <h1>Send us your feedback</h1>
        </div>
        <div class="body">

        </div>
    </div>

</div>

