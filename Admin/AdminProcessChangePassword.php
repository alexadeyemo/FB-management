<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    die("Unauthorised Access");
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $newPassword = $_POST['newPassword'];

    $hashedPassword = $newPassword;
    
    $db = new SQLite3('../fb_managment_system.db');

    $stmt = $db->prepare ("UPDATE Users SET Password = :password WHERE User_ID = :userID");
    $stmt->bindValue(':password', $hashedPassword, SQLITE3_TEXT);
    $stmt->bindValue(':userID', $_SESSION['user_id'], SQLITE3_TEXT);
    
    if ($stmt->execute()) {
        echo "Password Updated";
    } else {
        echo"Failed To Update Password";
    }
    $db->close();
}
?>