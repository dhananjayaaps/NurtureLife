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

