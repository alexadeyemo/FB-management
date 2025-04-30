<?php
  session_start();

  if (!isset($_SESSION['email'])) {
      header("Location: ../index.php");
      exit();
  }

  $email = $_SESSION['email'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | Field Owner</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="../styles/style.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>
    <?php include 'Sidebar.php'; ?>

       
    <div class="content">
        <header>
            <h1>Field Owner Dashboard</h1>
        </header>

        <div class="dashboard">
            <main class="main-content">

              <div class="widgets">

                <!-- Booking Analytics -->
                <div class="widget">
                    <h3>📊 Booking Analytics</h3>
                    <?php
                      $db = new SQLite3('../fb_managment_system.db');

                      $stmt = $db->prepare('
                          SELECT Field.Field_name, COUNT(Field_Booking.Booking_ID) AS booking_count
                          FROM Field
                          INNER JOIN Users ON Field.FieldOwner_ID = Users.User_ID
                          LEFT JOIN Field_Booking ON Field.Field_ID = Field_Booking.Field_ID
                          WHERE Users.Email_Address = :email AND Field_Booking.Booking_Status = "Confirmed"
                          GROUP BY Field.Field_ID
                      ');
                      
                      $stmt->bindValue(':email', $email, SQLITE3_TEXT);
                      $result = $stmt->execute();

                      $fieldNames = [];
                      $bookingCounts = [];
                      
                      while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
                          $fieldNames[] = $row['Field_name'];
                          $bookingCounts[] = $row['booking_count'];
                      }
                      
                      $db->close();
                    ?>
                    <canvas id="bookingChart" width="600" height="400"></canvas>

                    <script>
                        const ctx = document.getElementById('bookingChart').getContext('2d');

                        const chart = new Chart(ctx, {
                            type: 'bar',
                            data: {
                                labels: <?php echo json_encode($fieldNames); ?>,
                                datasets: [{
                                    label: 'Number of Bookings',
                                    data: <?php echo json_encode($bookingCounts); ?>,
                                    backgroundColor: 'rgba(0, 123, 255, 0.6)',
                                    borderColor: 'rgba(0, 123, 255, 1)',
                                    borderWidth: 1
                                }]
                            },
                            options: {
                                responsive: true,
                                scales: {
                                    y: {
                                        beginAtZero: true,
                                        stepSize: 1
                                    }
                                }
                            }
                        });
                    </script>
                </div>

                <!-- Recent Bookings -->
                <div class="widget">
                    <h3>📝 Recent Pending Booking Requests</h3>
                    
                    <?php
                      $db = new SQLite3('../fb_managment_system.db');

                      $query = $db->prepare('
                          SELECT 
                              Field_Booking.Booking_ID,
                              Field.Field_name,
                              Field_Booking.Booking_Date,
                              Field_Booking.Booking_Time
                          FROM Field_Booking
                          INNER JOIN Field ON Field_Booking.Field_ID = Field.Field_ID
                          WHERE Field_Booking.Booking_Status = "Pending"
                          ORDER BY Field_Booking.Booking_Date ASC, Field_Booking.Booking_Time ASC
                          LIMIT 5
                      ');

                      $result = $query->execute();
                      echo "<ul>";

                      $hasResults = false;
                      while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
                          $hasResults = true;
                          echo "<li>";
                          echo "<b>Booking ID: </b>" . htmlspecialchars($row['Booking_ID']) . " | ";
                          echo "<b>Field: </b>" . htmlspecialchars($row['Field_name']) . " | ";
                          echo "<b>Date: </b>" . htmlspecialchars($row['Booking_Date']) . " | ";
                          echo "<b>Time: </b>" . htmlspecialchars($row['Booking_Time']);
                          echo "</li>";
                      }

                      if (!$hasResults) {
                          echo "<li>No pending bookings found.</li>";
                      }

                      echo "</ul>";

                      $db->close();
                    ?>

                    <a href="Bookings.php"><button>View Bookings</button></a>
                </div>

                <!-- Match Schedule -->
                <div class="widget">
                    <h3>🏆 Match Schedule</h3>

                    <?php
                      $database = new SQLite3('../fb_managment_system.db');

                      $teamQuery = $database->prepare('
                          SELECT Team_ID, Team_Name, Match.TeamA_ID, Match.TeamB_ID, Field_Booking.Booking_ID
                          FROM Team
                          INNER JOIN Match ON (Team.Team_ID = Match.TeamA_ID OR Team.Team_ID = Match.TeamB_ID)
                          INNER JOIN Field_Booking ON Match.Booking_ID = Field_Booking.Booking_ID
                          INNER JOIN Field ON Field_Booking.Field_ID = Field.Field_ID
                          INNER JOIN Users ON Field.FieldOwner_ID = Users.User_ID                                  
                          WHERE Users.Email_Address = :email
                          ');
                      $teamQuery->bindValue(':email', $email, SQLITE3_TEXT);
                      $teamResult = $teamQuery->execute();

                      $teamData = $teamResult->fetchArray(SQLITE3_ASSOC);
                      $team_id = $teamData['Team_ID'] ?? 0;
                      $team_name = $teamData['Team_Name'] ?? 'Unknown Team';

                      $countQuery = $database->prepare('
                          SELECT COUNT(*) as match_count 
                          FROM Match 
                          WHERE (TeamA_ID = :team_id OR TeamB_ID = :team_id)
                          AND DATE(Match_Date) >= DATE("now")');
                      $countQuery->bindValue(':team_id', (int)$team_id, SQLITE3_INTEGER);
                      $countResult = $countQuery->execute();
                      $matchCount = $countResult->fetchArray(SQLITE3_ASSOC)['match_count'] ?? 0;

                      $matchQuery = $database->prepare('
                          SELECT 
                              t1.Team_Name AS team1, 
                              t2.Team_Name AS team2, 
                              m.Match_Date,
                              CASE 
                                  WHEN m.TeamA_ID = :team_id THEN "Home" 
                                  ELSE "Away" 
                              END AS match_type
                          FROM Match m
                          INNER JOIN Team t1 ON m.TeamA_ID = t1.Team_ID
                          INNER JOIN Team t2 ON m.TeamB_ID = t2.Team_ID
                          WHERE (m.TeamA_ID = :team_id OR m.TeamB_ID = :team_id)
                          AND DATE(m.Match_Date) >= DATE("now")
                          ORDER BY m.Match_Date ASC');
                      $matchQuery->bindValue(':team_id', (int)$team_id, SQLITE3_INTEGER);
                      $results = $matchQuery->execute();
                      ?>

                    <?php if ($matchCount == 0): ?>
                      <div class="no-matches">
                          <p>No upcoming matches scheduled on your fields.</p>
                      </div>
                  <?php else: ?>
                      <table>
                          <tr>
                              <th>Matchup</th>
                              <th>Date</th>
                              <th>Type</th>
                          </tr>
                          <?php while ($row = $results->fetchArray(SQLITE3_ASSOC)): 
                              $isHome = $row['match_type'] == 'Home';
                              $yourTeam = $isHome ? $row['team1'] : $row['team2'];
                              $opponent = $isHome ? $row['team2'] : $row['team1'];
                              $rowClass = $isHome ? 'home-match' : 'away-match';
                          ?>
                          <tr class="<?= $rowClass ?>">
                              <td><?= htmlspecialchars($yourTeam) ?> vs <?= htmlspecialchars($opponent) ?></td>
                              <td><?= htmlspecialchars($row['Match_Date']) ?></td>
                              <td><span class="match-type"><?= htmlspecialchars($row['match_type']) ?></span></td>
                          </tr>
                          <?php endwhile; ?>
                      </table>
                  <?php endif; ?>
                  <a href="MatchSchedule.php"><button>View Schedule</button></a>
                </div>

              </div>
            </main>
        </div>
    </div>
    <?php include 'Footer.php'; ?>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>