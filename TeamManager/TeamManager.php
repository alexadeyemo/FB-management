<!-- Dashboard for Team Manager -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | Team Manager</title>
    <link rel="stylesheet" href="../styles/style.css">
    <script src="../TeamManager/js/script.js"></script> <!-- Link your JavaScript file -->

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> <!--Link to Chart.js API- pie chart -->
</head>


<body>
    <?php include 'sidebar.php'; ?>

    <div class="content">
        <header>
            <h1>Team Dashboard</h1>
        </header>

        <div class="dashboard-chart">
            <canvas id="team-stats-chart"></canvas>
        </div>

        <!-- <div id="todays-match-card">
        </div> -->
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
.dashboard-chart{
    margin: 20px;
    background-color: #153C57;
    border-radius: 8px;
    padding: 20px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

#team-stats-chart{
    width: 400px !important;
    height: 400px !important;
}

/* todays match card */
#todays-match-card{
    display: none; 
    background:rgb(157, 83, 83); 
    color: white; 
    padding: 15px; 
    margin: 50px 120px;
    text-align: center;
    box-shadow: 0 -2px 5px rgba(0,0,0,0.1);
    width: 20%;
}
</style>
