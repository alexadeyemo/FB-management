<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Match Calendar</title>
    <link rel="stylesheet" href="../styles/style.css">
    <script src="../TeamManager/js/script.js"></script> <!-- Link your JavaScript file -->

    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.17/index.global.min.js'></script> <!-- Link to Calendar API/ FullCalendar -->
</head>

<body>
    <?php include 'sidebar.php'; ?>
    <div class="content">
        <header>
            <h1>Match Calendar</h1>
        </header>

        <div id="todays-match-card">
        </div>

        <!-- calendar API -->
        <section id="calendar">
        </section>
    </div>
                   
    <footer>
        <p>goikontech@gmail.com</p>
        <a href="#">Terms of use</a>
        <a href="#">Support</a>
        <a href="#">Policies</a>
    </footer>
</body>
</html>


<style>
#calendar{
    background-color:rgb(232, 233, 236);
    width: auto;
    height: auto;
    margin: 50px 120px;
    border: 2px solid black;
    padding: 60px;
    position: relative;
}

/* the month/yr of the calendar */
.fc-toolbar h2 { 
    color:#363e4e; 
    padding-left: 10px;
}

 /* Color of the days of the week (Monday, Tuesday, etc.) */
.fc-day-header {
    font-weight: bold; 
    background-color: black !important;
    color: white;
}

/* Change the color of the dates */
.fc-day{
    background-color:rgb(66, 100, 130);
}

/* the background color of today's date */
.fc-day-today {
    background-color: #61727a !important; 
}

.fc-day:hover {
    background-color: #ab5757; /* background on hover */
    color:rgb(185, 181, 181);
    cursor: pointer;
}


/* todays match card */
#todays-match-card{ 
    background:#9d5353; 
    color: white; 
    padding: 15px; 
    margin: 50px 120px;
    text-align: center;
    box-shadow: 0 -2px 5px rgba(0,0,0,0.1);
}
</style>

