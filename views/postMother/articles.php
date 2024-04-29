<?php
/** @var $this app\core\view */

use app\models\User;

$this->title = 'Postnatal Mother';
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
    <h1>Postnatal Mother - Reading Materials</h1>
</div>
<div class="mother_content">
    <div class="reading_topic">
        <div class="image_container">
            <img src="./assets/images/pregnant_chat.jpeg" alt="pregnant_chat">
        </div>
        <div class="link_container">
            <p>
                People say really rude and inappropriate things to pregnant women,
                especially in regards to their physical appearance. Read more...
            </p><br>
            <a href="http://bayareahomebirth.org/blog/how-to-talk-to-pregnant-people" target="_blank" rel="noopener noreferrer">
                10 Dos and Don'ts when talking to pregnant people
            </a>
        </div>
    </div>
    <div class="reading_topic">
        <div class="image_container">
            <img src="./assets/images/delivery_assist.jpeg" alt="pregnant_chat">
        </div>
        <div class="link_container">
            <p>
                A childbirth companion has been found to improve the whole birth experience. Read more...
            </p><br>
            <a href="https://www.ncbi.nlm.nih.gov/books/NBK304186/" target="_blank" rel="noopener noreferrer">
                support during labour and childbirth
            </a>
        </div>
    </div>
    <div class="reading_topic">
        <div class="image_container">
            <img src="./assets/images/transport_pregnant.jpeg" alt="pregnant_chat">
        </div>
        <div class="link_container">
            <p>
                The transport of pregnant women to an appropriate health facility plays
                a pivotal role in preventing maternal deaths. Read more...
            </p><br>
            <a href="https://bmcpregnancychildbirth.biomedcentral.com/articles/10.1186/s12884-016-1113-7" target="_blank" rel="noopener noreferrer">
                Transport of pregnant women and obstetric emergencies
            </a>
        </div>
    </div>
    <div class="reading_topic">
        <div class="image_container">
            <img src="./assets/images/respect.jpeg" alt="pregnant_chat">
        </div>
        <div class="link_container">
            <p>
                Providing respectful, non-discriminatory care that honors the preferences
                and needs of mothers is fundamental.Read more...
            </p><br>
            <a href="https://www.who.int/docs/default-source/mca-documents/nbh/brief-postnatal-care-for-mothers-and-newborns-highlights-from-the-who-2013-guidelines.pdf" target="_blank" rel="noopener noreferrer">
                Respectful maternity care
            </a>
        </div>
    </div>
    <div class="reading_topic">
        <div class="image_container">
            <img src="./assets/images/food.jpeg" alt="pregnant_chat">
        </div>
        <div class="link_container">
            <p>
                Grab these nutritious foods whenever vising a mother. Read more...
            </p><br>
            <a href="https://www.healthline.com/nutrition/13-foods-to-eat-when-pregnant" target="_blank" rel="noopener noreferrer">
                13 nutritious foods to eat when pregnant
            </a>
        </div>
    </div>
    <div class="reading_topic">
        <div class="image_container">
            <img src="./assets/images/mental.jpeg" alt="pregnant_chat">
        </div>
        <div class="link_container">
            <p>
                Knowing how to ensure mental wellbeing is a vital part in maternal care. Read more...
            </p><br>
            <a href="https://www.pregnancybirthbaby.org.au/mental-wellbeing-during-pregnancy#:~:text=Try%20not%20to%20make%20major,relaxed%20and%20good%20about%20yourself." target="_blank" rel="noopener noreferrer">
                Mental wellbeing during pregnancy
            </a>
        </div>
    </div>
    <div class="dl_container">
        <div class="dl_image_container">
            <img src="./assets/images/download_1.png" alt="downloadable content" width="163px">
        </div>
        <div class="dl_link_container">
            <p>Child Health Development Record Book</p><br>
            <a href="https://drive.google.com/file/d/1jb2U1AR94UlEZA68tjMoym4rNfQVsGbT/view?usp=sharing" target="_blank" rel="noopener noreferrer">
                <img src="./assets/images/icons/download_icon.jpeg" alt="download_icon" width="200">
            </a>
        </div>
    </div>
    <div class="dl_container">
        <div class="dl_image_container">
            <img src="./assets/images/download_2.png" alt="downloadable content" width="185px">
        </div>
        <div class="dl_link_container">
            <p>Maternal Care Package:<br>A Guide to Field Healthcare Workers</p><br>
            <a href="https://drive.google.com/file/d/140LA-T3ib2QbEYdkqFREa9-jiAyJsl-T/view?usp=sharing" target="_blank" rel="noopener noreferrer">
                <img src="./assets/images/icons/download_icon.jpeg" alt="download_icon" width="200">
            </a>
        </div>
    </div>
    <div class="dl_container">
        <div class="dl_image_container">
            <img src="./assets/images/download_3.png" alt="downloadable content"width="170px">
        </div>
        <div class="dl_link_container">
            <p>National Guidelines on<br>Post-Abortion Care</p><br>
            <a href="https://drive.google.com/file/d/1Dr-xoX9H3m5Tg0OgcjB_KhANQAfsbPRw/view?usp=drive_link" target="_blank" rel="noopener noreferrer">
                <img src="./assets/images/icons/download_icon.jpeg" alt="download_icon" width="200">
            </a>
        </div>
    </div>
    <div class="reading_topic">
        <div class="image_container">
            <img src="./assets/images/respect.jpeg" alt="pregnant_chat">
        </div>
        <div class="link_container">
            <p>
                Providing respectful, non-discriminatory care that honors the preferences
                and needs of mothers is fundamental.Read more...
            </p><br>
            <a href="https://www.who.int/docs/default-source/mca-documents/nbh/brief-postnatal-care-for-mothers-and-newborns-highlights-from-the-who-2013-guidelines.pdf" target="_blank" rel="noopener noreferrer">
                Respectful maternity care
            </a>
        </div>
    </div>
    <div class="reading_topic">
        <div class="image_container">
            <img src="./assets/images/food.jpeg" alt="pregnant_chat">
        </div>
        <div class="link_container">
            <p>
                Grab these nutritious foods whenever vising a mother. Read more...
            </p><br>
            <a href="https://www.healthline.com/nutrition/13-foods-to-eat-when-pregnant" target="_blank" rel="noopener noreferrer">
                13 nutritious foods to eat when pregnant
            </a>
        </div>
    </div>
    <div class="reading_topic">
        <div class="image_container">
            <img src="./assets/images/mental.jpeg" alt="pregnant_chat">
        </div>
        <div class="link_container">
            <p>
                Knowing how to ensure mental wellbeing is a vital part in maternal care. Read more...
            </p><br>
            <a href="https://www.pregnancybirthbaby.org.au/mental-wellbeing-during-pregnancy#:~:text=Try%20not%20to%20make%20major,relaxed%20and%20good%20about%20yourself." target="_blank" rel="noopener noreferrer">
                Mental wellbeing during pregnancy
            </a>
        </div>
    </div>
    <div class="reading_topic">
        <div class="image_container">
            <img src="./assets/images/pregnant_chat.jpeg" alt="pregnant_chat">
        </div>
        <div class="link_container">
            <p>
                People say really rude and inappropriate things to pregnant women,
                especially in regards to their physical appearance. Read more...
            </p><br>
            <a href="http://bayareahomebirth.org/blog/how-to-talk-to-pregnant-people" target="_blank" rel="noopener noreferrer">
                10 Dos and Don'ts when talking to pregnant people
            </a>
        </div>
    </div>
    <div class="reading_topic">
        <div class="image_container">
            <img src="./assets/images/delivery_assist.jpeg" alt="pregnant_chat">
        </div>
        <div class="link_container">
            <p>
                A childbirth companion has been found to improve the whole birth experience. Read more...
            </p><br>
            <a href="https://www.ncbi.nlm.nih.gov/books/NBK304186/" target="_blank" rel="noopener noreferrer">
                support during labour and childbirth
            </a>
        </div>
    </div>
    <div class="reading_topic">
        <div class="image_container">
            <img src="./assets/images/transport_pregnant.jpeg" alt="pregnant_chat">
        </div>
        <div class="link_container">
            <p>
                The transport of pregnant women to an appropriate health facility plays
                a pivotal role in preventing maternal deaths. Read more...
            </p><br>
            <a href="https://bmcpregnancychildbirth.biomedcentral.com/articles/10.1186/s12884-016-1113-7" target="_blank" rel="noopener noreferrer">
                Transport of pregnant women and obstetric emergencies
            </a>
        </div>
    </div>
</div>