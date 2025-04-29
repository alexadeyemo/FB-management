<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Statistics</title>
    <link rel="stylesheet" href="style.css"/>
</head>

<style>
.admin-view-stats{
    margin-right: 300px;
    margin-left: 0;
}
</style>

<body>
<?php include("sidebar2.php");?>
<div class="content">
    <h2 class="centered-header" style="text-align: center;">All Statistics
    <a href="AdminReport.php">
        <button style="background-color: #c41818; margin-left:15px;"> < Return to page </button>
    </a>
    </h2>

    <div class="admin-view-stats">
        <?php
        $db = new SQLite3('../fb_managment_system.db');
        $select_query = "SELECT * FROM Match_Stats";
        $result = $db->query($select_query);

        echo "<table>";
        echo "<tr> <th>Match ID</th> <th>Team ID</th> <th>Goals</th> <th>Yellow Cards</th> <th>Red Cards</th> <th>Penalties</th> <th>Free Kicks</th> <th>Corners</th> <th>Fouls</th> <th>Action</th> </tr>";

        while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
            $id = $row['Match_ID'];
            $teamID = $row['Team_ID'];
            $goals = $row['Goals'];
            $ycards = $row['Yellow_Cards'];
            $rcards = $row['Red_Cards'];
            $pens = $row['Penalties'];
            $freekicks = $row['FreeKicks'];
            $corners = $row['Corners'];
            $fouls = $row['Fouls'];

            echo "<tr>
                    <td>$id</td>
                    <td>$teamID</td>
                    <td>$goals</td>
                    <td>$ycards</td>
                    <td>$rcards</td>
                    <td>$pens</td>
                    <td>$freekicks</td>
                    <td>$corners</td>
                    <td>$fouls</td>
                    <td> <a href='deleteStat.php ? matchID=$id'> Delete </a> </td>
                </tr>";
        }

        echo "</table>";
        $db->close();
        ?>
    </div>
</div>
</body>
</html>

