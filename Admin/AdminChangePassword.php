<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password | Admin</title>
    <link rel="stylesheet" href="style.css" />
</head>

<body>

<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    die("You need to be logged in to change password!");
}
?>

<a href="Settings.php">
    <button style="margin-left:10px; background-color: red;">Go back</button>
</a>
<form method="POST" action="AdminProcessChangePassword.php">
    <label>New Password:</label>
    <input type="passwword" name="newPassword" required>
    <button type="submit">Change Password</button>
</form>

</body>
</html>