<?php
/** @var $this app\core\view */

use app\core\form\Form;
use app\models\User;

$this->title = 'Verification Success';
?>

<style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        background-color: #f5f5f5;
    }

    .content{
        margin-left: 0;
        align-items: center;
        justify-content: space-around;
    }

    .wrapper{
        justify-content: space-around;
        width: 100%;
        height: 70vh;
    }

    .container {
        max-width: 800px;
        margin: 50px auto;
        background-color: #fff;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        align-items: center;
        padding: 30px;
    }

    .imageBox {
        text-align: center;
    }

    .imageBox img {
        max-width: 100%;
        height: auto;
        display: block;
        border-top-left-radius: 10px;
        border-top-right-radius: 10px;
    }
    h1 {
        text-align: center;
        color: #333;
        margin: 20px 0;
    }

    .tick {
        display: block;
        margin: 0 auto;
        width: 100px;
        height: 100px;
    }

</style>

<div class="container">
    <div class="imageBox">
        <img src="https://www.cidrap.umn.edu/sites/default/files/styles/article_detail/public/article/Pregnant%20woman%20with%20young%20child.jpg" alt="Image">
    </div>
    <div>
        <img class="tick" src="https://cdn.pixabay.com/photo/2017/02/12/21/29/false-2061132_960_720.png" alt="tick">
        <h1>Email not verified. Check the Email</h1>
    </div>
</div>


