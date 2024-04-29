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
    <!--    emergency button-->
    <div class="btn-conteiner">
        <a class="btn-content" href="#">
            <span class="btn-title">EMERGENCY</span>
            <span class="icon-arrow">
          <svg width="66px" height="43px" viewBox="0 0 66 43" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
            <g id="arrow" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
              <path id="arrow-icon-one" d="M40.1543933,3.89485454 L43.9763149,0.139296592 C44.1708311,-0.0518420739 44.4826329,-0.0518571125 44.6771675,0.139262789 L65.6916134,20.7848311 C66.0855801,21.1718824 66.0911863,21.8050225 65.704135,22.1989893 C65.7000188,22.2031791 65.6958657,22.2073326 65.6916762,22.2114492 L44.677098,42.8607841 C44.4825957,43.0519059 44.1708242,43.0519358 43.9762853,42.8608513 L40.1545186,39.1069479 C39.9575152,38.9134427 39.9546793,38.5968729 40.1481845,38.3998695 C40.1502893,38.3977268 40.1524132,38.395603 40.1545562,38.3934985 L56.9937789,21.8567812 C57.1908028,21.6632968 57.193672,21.3467273 57.0001876,21.1497035 C56.9980647,21.1475418 56.9959223,21.1453995 56.9937605,21.1432767 L40.1545208,4.60825197 C39.9574869,4.41477773 39.9546013,4.09820839 40.1480756,3.90117456 C40.1501626,3.89904911 40.1522686,3.89694235 40.1543933,3.89485454 Z" fill="#FFFFFF"></path>
              <path id="arrow-icon-two" d="M20.1543933,3.89485454 L23.9763149,0.139296592 C24.1708311,-0.0518420739 24.4826329,-0.0518571125 24.6771675,0.139262789 L45.6916134,20.7848311 C46.0855801,21.1718824 46.0911863,21.8050225 45.704135,22.1989893 C45.7000188,22.2031791 45.6958657,22.2073326 45.6916762,22.2114492 L24.677098,42.8607841 C24.4825957,43.0519059 24.1708242,43.0519358 23.9762853,42.8608513 L20.1545186,39.1069479 C19.9575152,38.9134427 19.9546793,38.5968729 20.1481845,38.3998695 C20.1502893,38.3977268 20.1524132,38.395603 20.1545562,38.3934985 L36.9937789,21.8567812 C37.1908028,21.6632968 37.193672,21.3467273 37.0001876,21.1497035 C36.9980647,21.1475418 36.9959223,21.1453995 36.9937605,21.1432767 L20.1545208,4.60825197 C19.9574869,4.41477773 19.9546013,4.09820839 20.1480756,3.90117456 C20.1501626,3.89904911 20.1522686,3.89694235 20.1543933,3.89485454 Z" fill="#FFFFFF"></path>
              <path id="arrow-icon-three" d="M0.154393339,3.89485454 L3.97631488,0.139296592 C4.17083111,-0.0518420739 4.48263286,-0.0518571125 4.67716753,0.139262789 L25.6916134,20.7848311 C26.0855801,21.1718824 26.0911863,21.8050225 25.704135,22.1989893 C25.7000188,22.2031791 25.6958657,22.2073326 25.6916762,22.2114492 L4.67709797,42.8607841 C4.48259567,43.0519059 4.17082418,43.0519358 3.97628526,42.8608513 L0.154518591,39.1069479 C-0.0424848215,38.9134427 -0.0453206733,38.5968729 0.148184538,38.3998695 C0.150289256,38.3977268 0.152413239,38.395603 0.154556228,38.3934985 L16.9937789,21.8567812 C17.1908028,21.6632968 17.193672,21.3467273 17.0001876,21.1497035 C16.9980647,21.1475418 16.9959223,21.1453995 16.9937605,21.1432767 L0.15452076,4.60825197 C-0.0425130651,4.41477773 -0.0453986756,4.09820839 0.148075568,3.90117456 C0.150162624,3.89904911 0.152268631,3.89694235 0.154393339,3.89485454 Z" fill="#FFFFFF"></path>
            </g>
          </svg>
        </span>
        </a>
    </div>
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