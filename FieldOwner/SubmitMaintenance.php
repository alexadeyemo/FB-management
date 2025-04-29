<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $field_id = $_POST['field_id'];
    $sched_date = $_POST['sched_date'];
    $sched_desc = $_POST['sched_desc'];
    $sched_status = 'Scheduled';

    if (!$field_id || !$sched_date || !$sched_desc) {
        echo "All fields are required.";
        exit();
    }

    $db = new SQLite3('../fb_managment_system.db');

    $stmt = $db->prepare('
        INSERT INTO Maintenance_Schedule (Field_ID, MSched_Date, MSched_Desc, MSched_Status)
        VALUES (:field_id, :sched_date, :sched_desc, :sched_status)
    ');
    $stmt->bindValue(':field_id', $field_id, SQLITE3_TEXT);
    $stmt->bindValue(':sched_date', $sched_date, SQLITE3_TEXT);
    $stmt->bindValue(':sched_desc', $sched_desc, SQLITE3_TEXT);
    $stmt->bindValue(':sched_status', $sched_status, SQLITE3_TEXT);

    if ($stmt->execute()) {
        echo "<script>
            alert('Maintenance scheduled successfully!');
            window.location.href = 'FieldMaintenance.php';
        </script>";
    } else {
        echo "Failed to add schedule.";
    }

    $db->close();
} else {
    echo "Invalid request.";
}
?>
