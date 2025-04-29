<?php

include ("sidebar2.php");

if ($_SERVER ["REQUEST_METHOD"] == "POST") {
    $mschedID = $_POST['mschedID'];
    $date = $_POST['date'];
    $status = $_POST['status'];
    $description = $_POST['description'];
    $fieldID = $_POST['fieldID'];

    $db = new SQLite3('../fb_managment_system.db');

    $db->exec("CREATE TABLE IF NOT EXISTS Maintenance_Schedule(
        MSched_ID TEXT PRIMARY KEY,
        MSched_Date TEXT NOT NULL,
        MSched_Status TEXT NOT NULL,
        MSched_Desc TEXT NOT NULL,
        Field_ID TEXT NOT NULL,
        FOREIGN KEY (Field_ID) REFERENCES Field(Field_ID)
        );");

$stmt = $db->prepare("INSERT OR REPLACE INTO Maintenance_Schedule (MSched_ID, MSched_Date, MSched_Status, MSched_Desc, Field_ID)
VALUES (:mschedID, :date, :status, :description, :fieldID)");
$stmt->bindValue(':mschedID', $mschedID, SQLITE3_TEXT);
$stmt->bindValue(':date', $date, SQLITE3_TEXT);
$stmt->bindValue(':status', $status, SQLITE3_TEXT);
$stmt->bindValue(':description', $description, SQLITE3_TEXT);
$stmt->bindValue(':fieldID', $fieldID, SQLITE3_TEXT);


if ($stmt->execute()) {
    echo"Maintenance Schedule Added Successfully";
} else{
    echo"Failed To Add New Maintenance Schedule";
}

$db->close();
}
?>