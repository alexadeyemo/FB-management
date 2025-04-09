// Calendar API
document.addEventListener('DOMContentLoaded', function () {
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        height: 'auto',
        events: '../TeamManager/GetMatches.php', // Path to your PHP endpoint
        eventColor: ' #f2f0b4',
        eventTextColor: ' #000000'
    });
    calendar.render();
});
