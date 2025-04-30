<style>
.admin-view-maint {
    display: flex;
    justify-content: center;
    margin-right: 150px;
    margin-top: 0;
}

.admin-view-maint table {
    border-collapse: collapse;
    width: 100%;
    max-width: 1200px;
    text-align: center;
}

.admin-view-maint th,
.admin-view-maint td {
    padding: 10px;
    border: 1px solid #ccc;
}

</style>

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

