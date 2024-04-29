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

<div class="sub_topic">
    <a href="/posts">
        <button class="post_button"> # POSTS </button>
    </a>
</div>
<div class="volunteer_body">
    <!--<div class="mid">-->
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
    <!--</div>-->
    <!--<div class="mid">-->
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
    <!--</div>-->

    <!--<div class="lower">-->
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
    <!--</div>-->
</div>
