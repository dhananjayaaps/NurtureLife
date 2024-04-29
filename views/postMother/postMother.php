<?php
/** @var $this app\core\view */

use app\models\User;

$this->title = 'Login';
?>

<?php
/** @var $model User **/
?>
<link rel="stylesheet" href="./assets/styles/emergency_button.css">
<style>
    .content{
        display: flex;
        flex-direction: column;
        align-items: center;
        /*height: 100vh;*/
        /*background-color: #4ef07c;*/
        justify-content: flex-start;
        margin-left: 215px;
        height: fit-content;
        width: 98vw;
    }
    .content h1{
        font-family: Arial, Helvetica, sans-serif;
        font-size: 30px;
        margin: 10px 0 10px 10px;
    }
    .mother_header{
        display: flex;
        flex-direction: row;
        justify-content: space-around;
        gap: 20px;
        padding: 10px;
    }
    .mother_content{
        display: grid;
        grid-template-columns: 1fr 1fr 1fr;
        /*border-style: solid;*/
        /*background-color: #f2b9cf;*/
        margin: 0 10px 10px 10px;
        width: 97%;
    }
    @media (max-width: 750px){
        .mother_content{
            grid-template-columns: 1fr;
        }
    }
    @media (min-width: 751px) and (max-width: 999px){
        .mother_content{
            grid-template-columns: 1fr 1fr;
        }
    }
    @media (min-width: 1000px){
        .mother_content{
            grid-template-columns: 1fr 1fr 1fr;
        }
    }
    .reading_topic{
        /*width: 33%;*/
        width: 380px;
        border-radius: 20px;
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
        display: flex;
        flex-direction: row;
        margin: 5px;
    }
    .image_container{
        width: 45%;
    }
    .link_container{
        padding: 5px;
        width: 60%;
    }
    .image_container img{
        margin-left: auto;
        margin-right: auto;
        width: 150px;
        border-radius: 20px;
    }
    .reading_topic p{
        font-family: Arial, Helvetica, sans-serif;
    }
    .dl_container{
        width: 380px;
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
        margin: 2px 10px 2px 2px;
        display: flex;
        flex-direction: row;
        background-color: white;
        border-radius: 20px;
    }
    .dl_image_container{
        width: 40%;
        margin: 2px;
    }
    .dl_image_container img{
        margin-left: auto;
        margin-right: auto;
        border-radius: 20px;
        width: 165px;
    }
    .dl_link_container{
        padding: 40px 10px 10px 10px;
        margin: 2px;
        font-family: Arial, Helvetica, sans-serif;
        text-align: center;
        font-size: 18px;
        font-weight: bold;
    }
</style>
<div class="mother_header">
    <h1>Postnatal Mother - Dashboard</h1>
</div>

