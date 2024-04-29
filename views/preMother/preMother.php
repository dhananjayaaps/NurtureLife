<?php
/** @var $this app\core\view */

use app\models\User;
use app\models\Appointments;
use app\models\Mother;

$this->title = 'preMother Dashboard';
?>
<link rel="stylesheet" href="./assets/styles/mother.css">
<link rel="stylesheet" href="./assets/styles/emergency_button.css">



<?php
/** @var $model User **/
?>


<div class="popup" id="popup"></div>


<!--<div class="content">-->
    <div class="first-column">
        <div class="mother_header">
            <h1>Prenatal Mother - Dashboard</h1>
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
        <div class="DeliveryTimer"></div>
        <div class="quick-access">

            <div class="user-control addButtons">

                <button class="addButton">Report Symptoms</button>
                <button class="addButton">View Reports</button>
                <button class="addButton">View Schedules</button>

            </div>
            <div class="user-control addButtons">

                <button class="addButton">Nutrition Guidelines</button>
                <button class="addButton">Communicate to  Officers</button>
                <a href="/fetalkick"> <button class="addButton " style="width: 205px">Record Fetalkicks</button></a>
            </div>

<!--            </div>-->

        </div>

    </div>
    <div class="second-column fixed-element">

        <div class="shadowBox">
            <div class="notification-bar">
                <div class="notifications">
                    <span style="font-size: 20px; font-weight: bold;">Notifications</span>
                </div>
                <div class="myBox">
                    <div class="notification emergency">
                        <div class="message-box">
                            <div class="title">Appointment Alert</div>
                            <div class="notification-content">
                                Midwife shceduled a new appointment. View it here
                            </div>
                        </div>
                    </div>

                    <div class="notification">
                        <div class="message-box">
                            <div class="title">Doctor Replied</div>
                            <div class="notification-content">
                                Your clinic doctor replied to your Symptom Report. View reply here
                            </div>
                        </div>
                    </div>

                    <div class="notification warning">
                        <div class="message-box">
                            <div class="title">Fetalkick recording activated</div>
                            <div class="notification-content">
                                You have completed 28 weeks of pregnancy. Now you can report Fetalkicks here
                            </div>
                        </div>
                    </div>

                    <div class="notification">
                        <div class="message-box">
                            <div class="title">Emergency Alert</div>
                            <div class="notification-content">
                                Pressed the Emergency Elarm by Kamala Wijethunga
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div>
            <div class="calendar-container">
                <div class="header">
                    <button class="prev-month">&lt;</button>
                    <h2 class="month-year">November 2023</h2>
                    <button class="next-month">&gt;</button>
                </div>
                <div class="calendar-grid">
                    <!-- Calendar dates will be inserted here dynamically with JavaScript -->
                </div>
            </div>

        </div>

    </div>
<!--</div>-->

<script>
    const DeliveryTimer = document.querySelector('.DeliveryTimer');
    let DeliveryDate1 = <?php echo (new Mother())->getDeliveryDate() ?>;
    let today1 = new Date();

    // Set the HTML string as innerHTML of DeliveryTimer
    var RemainingTime1 = new Date(DeliveryDate1) - today1;
    var remainingDays = Math.floor(RemainingTime1 / (1000 * 60 * 60 * 24));
    var remainingMonths = Math.floor(remainingDays / 30);
    DeliveryTimer.innerHTML = '<span style="font-weight: bold; color: blue;">' + remainingMonths + '</span> month and <span style="font-weight: bold; color: red;">' + (remainingDays % 30) + '</span> days until Delivery';


    if (RemainingTime1<1000*60*60*22){
        DeliveryTimer.innerHTML = '<span style="color: red;">Go to the hospital immediately</span>';
    }





</script>


<script>
    document.addEventListener("DOMContentLoaded", function() {
        const prevMonthBtn = document.querySelector(".prev-month");
        const nextMonthBtn = document.querySelector(".next-month");
        const monthYearText = document.querySelector(".month-year");
        const calendarGrid = document.querySelector(".calendar-grid");
        const popup1 = document.getElementById("popup");


        const months = [
            "January", "February", "March", "April", "May", "June",
            "July", "August", "September", "October", "November", "December"
        ];

        const weekdays = ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"];
        let sampleAppointments = <?php echo (new Appointments())->getAppointmentsByMotherId() ?>;

        const currentDate = new Date();
        let currentMonth = currentDate.getMonth();
        let currentYear = currentDate.getFullYear();
        let currentDay = currentDate.getDate();

        function renderCalendar() {
            // Clear previous calendar
            calendarGrid.innerHTML = "";

            // Set month and year text
            monthYearText.textContent = months[currentMonth] + " " + currentYear;

            // Generate weekday labels
            weekdays.forEach(day => {
                const weekdayLabel = document.createElement("div");
                weekdayLabel.classList.add("weekday-label");
                weekdayLabel.textContent = day;
                calendarGrid.appendChild(weekdayLabel);
            });

            // Calculate total days in the current month
            const totalDays = new Date(currentYear, currentMonth + 1, 0).getDate();

            // Calculate the starting day of the month
            const firstDayIndex = new Date(currentYear, currentMonth, 1).getDay();

            // Create grid cells for days
            for (let i = 0; i < firstDayIndex; i++) {
                const calendarDay = document.createElement("div");
                calendarDay.classList.add("calendar-day");
                calendarGrid.appendChild(calendarDay);
            }

            for (let i = 1; i <= totalDays; i++) {
                const calendarDay = document.createElement("div");
                calendarDay.classList.add("calendar-day");
                calendarDay.textContent = i;
                calendarDay.setAttribute("data-day", i); // Set data attribute for the day
                calendarDay.addEventListener("click", handleDayClick); // Add click event listener

                // Check if the day has an appointment in the current month
                const appointments = getAppointmentsByMonth(currentYear, currentMonth + 1); // Note: month is 0-indexed
                const appointmentDates = appointments.map(appointment => new Date(appointment.Date).getDate());
                if (appointmentDates.includes(i)) {
                    calendarDay.classList.add("appointment-day");
                }

                calendarGrid.appendChild(calendarDay);

                // Highlight today's date
                if (currentMonth === currentDate.getMonth() && currentYear === currentDate.getFullYear() && i === currentDay) {
                    calendarDay.classList.add("today");
                }
            }
        }

        function handleDayClick(event) {
            const selectedDay = event.target.dataset.day;
            const selectedDate = new Date(currentYear, currentMonth, selectedDay);
            console.log(selectedDate);
            // Here you would retrieve appointments from the database for the selected date
            // For demonstration purposes, let's assume we have a function getAppointmentDetails(date) that returns appointment details for the given date
            const appointmentDetails = getAppointmentDetails(selectedDate);

            // Open a popup window to display the appointment details
            const popupContent = "Appointment details for " + months[currentMonth] + " " + selectedDay + ", " + currentYear + ":";
            //alert(popupContent);
            popup1.innerHTML = `
                <div class="popup-content">

                    <h2>Appointment Details</h2>
                    <p>${popupContent}</p>
                    <p>${appointmentDetails}</p>
                    <span class="close" id="close-popup">&times;</span>
                </div>
                `;
            popup1.style.display = "block";


        }
        // Event listener for close popup button
        document.addEventListener("click", function(event) {
            if (event.target && event.target.id === "close-popup") {
                document.getElementById("popup").style.display = "none";
            }
        });

        function getAppointmentsByMonth(year, month) {
            // Here you would retrieve appointments from the database for the specified month
            // For demonstration purposes, let's return sample appointments
            // const sampleAppointments = [
            //     { Type: 6, Date: "2024-02-28", Remarks: "not special" },
            //     { Type: 5, Date: "2024-04-25", Remarks: "no" }
            // ];

            // Filter appointments for the specified month
            return sampleAppointments.filter(appointment => {
                const appointmentDate = new Date(appointment.Date);
                return appointmentDate.getFullYear() === year && appointmentDate.getMonth() + 1 === month;
            });
        }

        function getAppointmentDetails(selectedDate) {
            // Create a date object for the selected day
            // const selectedDate = new Date(currentYear, currentMonth, selectedDay);

            // Filter sampleAppointments by the selected date
            const appointment = sampleAppointments.find(appointment => {
                // Create a date object for the appointment date
                const appointmentDate = new Date(appointment.Date);

                // Compare dates (ignoring time)
                return appointmentDate.toDateString() === selectedDate.toDateString();
            });
            console.log(appointment);
            console.log(sampleAppointments);
            // Check if an appointment is found for the selected date
            if (appointment) {
                // Build appointment details string
                const appointmentDetails = `Type: ${appointment.Type}, Remarks: ${appointment.Remarks}`;
                return appointmentDetails;
            } else {
                return "No appointment for this day";
            }
        }



        function prevMonth() {
            currentMonth--;
            if (currentMonth < 0) {
                currentMonth = 11;
                currentYear--;
            }
            renderCalendar();
        }

        function nextMonth() {
            currentMonth++;
            if (currentMonth > 11) {
                currentMonth = 0;
                currentYear++;
            }
            renderCalendar();
        }

        // Event listeners
        prevMonthBtn.addEventListener("click", prevMonth);
        nextMonthBtn.addEventListener("click", nextMonth);

        // Initial render
        renderCalendar();
    });

</script>

<style>
    .user-control button {
        background-color: #1F2B6C;
        color: #FFFFFF;
        padding: 30px 30px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        margin-bottom: 5px;
    }
    .quick-access {
        margin-left: 25%;
    }
    element.style {
        width: -webkit-fill-available;
    }
</style>