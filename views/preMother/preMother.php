<?php
/** @var $this app\core\view */

use app\models\User;
use app\models\Appointments;
use app\models\Mother;

$this->title = 'preMother Dashboard';
?>
<link rel="stylesheet" href="./assets/styles/mother.css">


<?php
/** @var $model User **/
?>


<div class="popup" id="popup"></div>

<div class="content">
    <div class="first-column">
        <div class="DeliveryTimer"></div>
        <div class="quick-access">
            <div class="user-control addButtons">

                <a href="/preMotherTest"><button class="addButton">SOS Emergency</button></a>


            </div>
<!--            <div class="second-column">-->
            <div class="user-control addButtons">

                <button class="addButton">Report Symptoms</button>
                <button class="addButton">View Reports</button>
                <button class="addButton">View Schedules</button>

            </div>
            <div class="user-control addButtons">

                <button class="addButton">Nutrition Guidelines</button>
                <button class="addButton">Communicate to  Officers</button>
                <a href="/fetalkick"> <button class="addButton fetal-btn">Record Fetalkicks</button></a>
            </div>
<!--            </div>-->

        </div>

    </div>
    <div class="second-column">

        <div class="shadowBox">
            <div class="notification-bar">
                <div class="notifications">
                    <span style="font-size: 20px; font-weight: bold;">Notifications</span>
                </div>
                <div class="myBox">
                    <div class="notification emergency">
                        <div class="message-box">
                            <div class="title">Emergency Alert</div>
                            <div class="notification-content">
                                Pressed the Emergency Elarm by Kamala Wijethunga
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

                    <div class="notification warning">
                        <div class="message-box">
                            <div class="title">Emergency Allert</div>
                            <div class="notification-content">
                                Pressed the Emergency Elarm by Kamala Wijethunga
                            </div>
                        </div>
                    </div>

                    <div class="notification">
                        <div class="message-box">
                            <div class="title">Emergency Allert</div>
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
</div>

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