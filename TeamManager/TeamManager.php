<!-- Dashboard for Team Manager -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | Team Manager</title>
    <link rel="stylesheet" href="../styles/style.css">
    <script src="../TeamManager/js/script.js"></script>
    <!--link to Chart.js API- pie chart -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> 
</head>


<body>
    <?php include 'sidebar.php'; ?>

    <div class="content">
        <header>
            <h1>Team Dashboard</h1>
        </header>

        <div class="card-section">
            <div class="row">
                <div class="upper-left-card">
                    <div class="dashboard-chart card">
                        <h2>Team Statistics</h2>
                        <canvas id="team-stats-chart"></canvas>
                    </div>
                </div>

                <div class="upper-right-card">
                    <div class="card">gatah</div>
                </div>
            </div>

            <div class="row">
                <h2>Upcoming Matches</h2>
            </div>
        </div>

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
.card-section {
    position: relative;
    width: 100%;
    padding: 10px;
    box-sizing: border-box;
}

.card {
    background-color:rgb(171, 198, 216);
    border-radius: 8px;
    padding: 20px;
    margin-bottom: 20px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    min-height: 400px;
}

.row{
    display: flex;
}

.upper-left-card {
    padding: 10px;
    margin: 10px;
    min-width: 40%;
}

.upper-right-card {
    padding: 10px;
    margin: 10px;
    min-width: 50%;
}

/* Second row appears after scrolling */
.lower-left-card {
    padding: 10px;
    margin: 10px;
    min-width: 40%;
}

.lower-right-card {
   padding: 10px;
   margin: 10px;
   min-width: 50%;
}


.dashboard-chart{
    border-radius: 8px;
    padding: 40px;
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




<script>
// get team match stats
document.addEventListener('DOMContentLoaded', function () {
    fetch('../TeamManager/GetTeamStats.php')
        .then(response => response.json())
        .then(data => {
            if (data.error) {
                console.error('Error fetching stats:', data.error);
                return;
            }

            const ctx = document.getElementById('team-stats-chart').getContext('2d');
            const chart = new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: [
                        'Goals',
                        'Yellow Cards',
                        'Red Cards',
                        'Penalties',
                        'Freekicks',
                        'Corners'
                    ],
                    datasets: [{
                        data: [
                            data.Goals,
                            data.YellowCards,
                            data.RedCards,
                            data.Penalties,
                            data.Freekicks,
                            data.Corners
                        ],
                        backgroundColor: [
                            '#00bfff',
                            '#f0e130',
                            '#ff4c4c',
                            '#4caf50',
                            '#ff9800',
                            '#9c27b0'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'top',
                        }
                    }
                }
            });
        })
        .catch(err => {
            console.error('Fetch error:', err);
        });
});
</script>