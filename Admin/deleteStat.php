<?php

include ("sidebar2.php");

$userIDParam=isset($_GET['matchID']) ? $_GET['matchID'] :'';

$db = new SQLite3('../fb_managment_system.db');

$stmt = $db->prepare("DELETE FROM Match_Stats WHERE Match_ID = :matchID");
$stmt->bindValue(':matchID', $userIDParam, SQLITE3_INTEGER);
if ($stmt->execute()) {
    echo "Statistic Deleted";
} else {
    echo "Failed To Delete Statistic";
}
$db->close();
?>