<?php

include ("sidebar2.php");

$userIDParam=isset($_GET['MSchedID']) ? $_GET['MSchedID'] :'';

$db = new SQLite3('../fb_managment_system.db');

$stmt = $db->prepare("DELETE FROM Maintenance_Schedule WHERE MSched_ID = :MSchedID");
$stmt->bindValue(':MSchedID', $userIDParam, SQLITE3_TEXT);
if ($stmt->execute()) {
    echo "Maintenance Schedule Deleted";
} else {
    echo "Failed To Delete Maintenance Schedule";
}
$db->close();
?>