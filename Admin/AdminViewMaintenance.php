<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Maintenance</title>
    <link rel="stylesheet" href="style.css"/>
</head>

<style>
.admin-view-maint{
    margin-right: 300px;
    margin-left: 0;
}
</style>

<body>
<?php include("sidebar2.php");?>
<div class="content">
        <h2 class="centered-header">Current Maintenance Schedule</h2>

    <div class="admin-view-maint">
        <?php
        $db = new SQLite3('../fb_managment_system.db');
        $select_query = "SELECT * FROM Maintenance_Schedule";
        $result = $db->query($select_query);

        echo "<table>";
        echo "<tr> <th>Maintenance Schedule ID</th> <th>Maintenance Schedule Date</th> <th>Maintenance Schedule Status</th> <th>Maintenance Schedule Description</th> <th>Field ID</th> <th>Action</th> </tr>";

        while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
            $id = $row['MSched_ID'];
            $date = $row['MSched_Date'];
            $status = $row['MSched_Status'];
            $desc = $row['MSched_Desc'];
            $fieldID = $row['Field_ID'];

            echo "<tr>
                    <td>$id</td>
                    <td>$date</td>
                    <td>$status</td>
                    <td>$desc</td>
                    <td>$fieldID</td>
                    <td> <a href='deleteMaintenance.php ? MSchedID=$id'> Delete </a> </td>
                </tr>";
        }

        echo "</table>";
        $db->close();
        ?>
    </div>
</div>
</body>
</html>

