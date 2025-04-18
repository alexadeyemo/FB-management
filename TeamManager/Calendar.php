<?php
$database = new SQLite3('../fb_managment_system.db');

$query = "SELECT  t1.team_name AS team1, t2.team_name AS team2, m.Match_Date 
          FROM match m
          JOIN team t1 ON m.TeamA_ID = t1.team_id
          JOIN team t2 ON m.TeamB_ID = t2.team_id
          WHERE m.Match_Date >= DATE('now') 
          ORDER BY m.Match_Date ASC";
$results = $database->query($query);

if (!$results) {
    die("Query failed: " . $database->lastErrorMsg());
}
?>

<!DOCTYPE html>s
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Match Calendar</title>
    <link rel="stylesheet" href="../styles/style.css">
    <!-- Link to Calendar API/ FullCalendar -->
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.17/index.global.min.js'></script>
</head>

<body>
    <?php include 'sidebar.php'; ?>
    <div class="content">
        <header>
            <h1>Match Calendar</h1>
        </header>
        <!-- calendar API -->
        <section id="calendar">
        </section>

        <!-- <section id="upcoming-matches-section">
            <h2>Upcoming Matches</h2>
            <table id="upcoming-match-table">
                <tr>
                    <th>Teams</th>
                    <th>Date</th>
                </tr>
                <?php while ($row = $results->fetchArray(SQLITE3_ASSOC)): ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['team1']) . " vs " . htmlspecialchars($row['team2']); ?></td>
                    <td><?php echo htmlspecialchars($row['Match_Date']); ?></td>
                </tr>
                <?php endwhile; ?>
            </table>
        </section> -->
    </div>
    <br>                
    <footer>
        <p>goikontech@gmail.com</p>
        <a href="#">Terms of use</a>
        <a href="#">Support</a>
        <a href="#">Policies</a>
    </footer>
</body>
</html>


<script>
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
</script>



<style>
#calendar{
    background-color: #a2b7c9;
    width: auto;
    height: auto;
    margin: 20px 70px;
    border: 2px solid black;
    padding: 50px;
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
    background-color: #2d4458;
}

/* Change the background color of today's date */
.fc-day-today {
    background-color:#61727a !important; /* background for today's date */
}

.fc-day:hover {
    background-color: #ab5757; /* background on hover */
    color:rgb(185, 181, 181);
    cursor: pointer;
}


#upcoming-matches-section{
    margin-left: 20px;
}

#upcoming-match-table{
    border: 2px solid black;
    border-collapse: separate;
}

#upcoming-match-table tr th{
    color: white;
    background-color:#2d4458;
    padding: 10px 20px;
}

#upcoming-match-table tr td{
    padding: 10px 20px;
    color:#535252;
}

</style>

