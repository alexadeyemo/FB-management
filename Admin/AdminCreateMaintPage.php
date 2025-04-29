<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Match Statistics</title>
    <link rel="stylesheet" href="style.css" />
</head>

<body>
    <?php
    include ("sidebar2.php");
    ?>
    <div> <h2 class="centered_header">Add New Match Statistics</h2></div>

    <div class="main">
        <form action="AdminCreateMaintRecord.php" method="post">
            <input type="text" id="mschedID" name="mschedID" placeholder="Maintenance Schedule ID (EG: MS006)" required>
            <input type="text" id="date" name="date" placeholder="Maintenance Schedule Date" required>
            <input type="text" id="status" name="status" placeholder="Maintenance Schedule Status" required>
            <input type="text" id="description" name="description" placeholder="Maintenance Schedule Description" required>
            <input type="number" id="fieldID" name="fieldID" placeholder="Field ID" required>

            <button type="submit">Add Maintenance Schedule</button>
        </form>
    </div>
</body>
</html>