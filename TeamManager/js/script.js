// Calendar API
document.addEventListener('DOMContentLoaded', function () {
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        height: 'auto',
        events: '../TeamManager/GetMatches.php', // Path to PHP endpoint
        eventColor: ' #f2f0b4',
        eventTextColor: ' #000000'
    });

    calendar.render();
});


// get today's match 
document.addEventListener('DOMContentLoaded', function () {
    fetch('../TeamManager/GetTodaysMatch.php')
        .then(res => res.json())
        .then(data => {
            const card = document.getElementById('todays-match-card');

            if (data.error || data.message) return; // no match today

            const matchDate = new Date(data.Match_Date);
            // needs to be looked at for the time
            const time = matchDate.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' }); 
            const length = 

            card.innerHTML = `
                <h2>📅 Today’s Match</h2>
                <h3><strong>${data.TeamA}</strong> vs <strong>${data.TeamB}</strong></h3>
                <br>
                <p>🕒 Time: ${time}</p>
                <p>⏳ Match Length: ${data.Match_Length} minutes</p>
            `;
            card.style.display = 'block';
        })
        .catch(err => console.error('Error fetching today’s match:', err));
});





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
