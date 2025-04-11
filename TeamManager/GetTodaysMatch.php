<?php
header('Content-Type: application/json');
session_start();

if (!isset($_SESSION['email'])) {
    header("Location: ../index.php");
    exit();
}

$email = $_SESSION['email'];

$database = new SQLite3('../fb_managment_system.db');

$stmt = $database->prepare('SELECT 
    t1.Team_Name AS team1, t2.Team_Name AS team2, m.Match_Date
    FROM Match m
    INNER JOIN Team t1 ON m.TeamA_ID = t1.Team_ID
    INNER JOIN Team t2 ON m.TeamB_ID = t2.Team_ID
    INNER JOIN Users u ON (t1.Manager_ID = u.User_ID OR t2.Manager_ID = u.User_ID)
    WHERE m.Match_Date >= DATE("now") AND u.Email_Address = :email
    LIMIT 1');

$stmt->bindValue(':email', $email, SQLITE3_TEXT);
$results = $stmt->execute();

if ($results) {
    echo json_encode($results); 
} else {
    echo json_encode(['message' => 'No match today']); 
}
?>



// $team_id = 1; // Change this to the desired team ID

// // Get today's match for the specified team
// $query = "SELECT m.Match_Date, m.Match_Length, t1.team_name AS TeamA, t2.team_name AS TeamB
//           FROM Match m
//           JOIN Team t1 ON m.TeamA_ID = t1.Team_ID
//           JOIN Team t2 ON m.TeamB_ID = t2.Team_ID
//           WHERE date(m.Match_Date) = date('now')
//             AND (m.TeamA_ID = :team_id OR m.TeamB_ID = :team_id)
//           LIMIT 1";

// $matchStmt = $database->prepare($query);
// $matchStmt->bindValue(':team_id', $team_id, SQLITE3_INTEGER);
// $result = $matchStmt->execute()->fetchArray(SQLITE3_ASSOC);