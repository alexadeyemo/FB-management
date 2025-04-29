<?php
if (isset($_POST['msched_id']) && isset($_POST['msched_status'])) {
    $msched_id = $_POST['msched_id'];
    $msched_status = $_POST['msched_status'];


    $db = new SQLite3('../fb_managment_system.db');

    $stmt = $db->prepare('UPDATE Maintenance_Schedule SET MSched_Status = :status WHERE MSched_ID = :id');
    $stmt->bindValue(':status', $msched_status, SQLITE3_TEXT);
    $stmt->bindValue(':id', $msched_id, SQLITE3_TEXT);

    if ($stmt->execute()) {
        echo "<script>
            alert('Maintenance booking status changed successfully.');
            window.location.href = 'ViewMaintenanceSched.php';
            </script>";
        exit();
    } else {
        echo "Failed to update status.";
    }

    $db->close();
} else {
    echo "Missing maintenance id or status.";
}
?>
