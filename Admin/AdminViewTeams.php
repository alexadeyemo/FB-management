<style>
.teams-container {
    width: 100%;
    display: flex;
    flex-direction: column;
    align-items: center;
    text-align: center;
}

.table-wrapper {
    width: 100%;
}

.centered-header{
    margin-bottom: 0;
}
table {
    width: 100%;
    border-collapse: collapse;
}

th, td {
    padding: 10px;
    text-align: left;
    border-bottom: 1px solid #ccc;
}

th {
    background-color: #153C57;
    color: white;
}

tr:hover {
    background-color: #f5f5f5;
}
</style>


<div class="teams-container">
    <h2 class="centered-header">
        All Teams
        <a href="AdminCreateTeamPage.php">
            <button style="margin-left:20px;">Add New Team</button>
        </a>
    </h2>

    <div class="table-wrapper">
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
                    <td><a href='deleteTeam.php?teamID=$id'>Delete</a></td>
                </tr>";
        }

        echo "</table>";
        $db->close();
        ?>
    </div>
</div>
