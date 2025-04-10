<?php
header('Content-Type: application/json'); // Set the content type to JSON

// Connect to the SQLite database
$database = new SQLite3('../fb_managment_system.db');

// Define the team ID for which you want to fetch today's match
$team_id = 1; // Change this to the desired team ID

// Get today's match for the specified team
$query = "SELECT m.Match_Date, m.Match_Length, t1.team_name AS TeamA, t2.team_name AS TeamB
          FROM Match m
          JOIN Team t1 ON m.TeamA_ID = t1.Team_ID
          JOIN Team t2 ON m.TeamB_ID = t2.Team_ID
          WHERE date(m.Match_Date) = date('now')
            AND (m.TeamA_ID = :team_id OR m.TeamB_ID = :team_id)
          LIMIT 1";

$matchStmt = $database->prepare($query);
$matchStmt->bindValue(':team_id', $team_id, SQLITE3_INTEGER);
$result = $matchStmt->execute()->fetchArray(SQLITE3_ASSOC);

if ($result) {
    echo json_encode($result); // Return the match details as JSON
} else {
    echo json_encode(['message' => 'No match today']); // Return a message if no match is found
}
?>
