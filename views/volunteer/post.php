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
<div class="shadowBox">
    <div class="notification-bar" style="max-width: 450px">
        <div class="notifications">
            <span style="font-size: 20px; font-weight: bold;">Posts</span>
        </div>
        <div class="scrollable-container" style="max-height: 300px; overflow-y: auto">
            <?php $posts= json_decode($model->getPosts());
            foreach ($posts as $post):?>
                <div class="myBox" id="myBox">
                    <div class="notification emergency">
                        <div class="message-box">
                            <div class="title"><?=$post->user_name?> &#9900 <?=ucfirst($post->role_name)?></div>
                            <div class="notification-content">
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
                                    <button class="button" style="background-color: #159EEC">Attend</button>
                                    <button class="button" style="background-color: #ffb366">Contact</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach;?>
        </div>
    </div>
</div>