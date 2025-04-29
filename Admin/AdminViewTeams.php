<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Teams</title>
    <link rel="stylesheet" href="style.css" />
</head>

<style>
.container{
    padding: 20px;
    margin-bottom: 20px;
    max-width: 500px;
    justify-content: center;
    text-align: center;
    margin-left: 0;
}
</style>
<body>
<?php
include("sidebar2.php");
?>
    <div class="container">
        <div class="col-1">
            <h2 class="centered-header">All Teams
                <a href="AdminCreateTeamPage.php">
                    <button style="margin-left:20px;">Add New Team</button>
                </a>
            </h2>
        </div>

        <div class="table-view-teams">
            <?php
            $db = new SQLite3('../fb_managment_system.db');
            $select_query = "SELECT * FROM Team";
            $result = $db->query($select_query);

            echo "<table>";
            echo "<tr> <th>Team ID</th> <th>Team Name</th> <th>City</th> <th>Manager ID</th> <th>Action</th> </tr>";

            while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
                $id = $row['Team_ID'];
                $teamName = $row['Team_name'];
                $city = $row['City'];
                $managerID = $row['Manager_ID'];

                echo "<tr>
                        <td>$id</td>
                        <td>$teamName</td>
                        <td>$city</td>
                        <td>$managerID</td>
                        <td> <a href='deleteTeam.php ? teamID=$id'> Delete </a> </td>
                    </tr>";
            }

            echo "</table>";
            $db->close();
            ?>
        </div>
    </div>
    

</body>
</html>

