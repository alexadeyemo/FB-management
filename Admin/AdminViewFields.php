<style>
.fields-container {
    width: 100%;
    display: flex;
    flex-direction: column;
    align-items: center;
    text-align: center;
}

.table-wrapper {
    width: 100%;
    margin-right: 350px;
}

table {
    width: 100%;
    border-collapse: collapse;
}

th, td {
    padding: 10px;
    border-bottom: 1px solid #ccc;
    text-align: left;
}

th {
    background-color: #153C57;
    color: white;
}

tr:hover {
    background-color: #f5f5f5;
}

.centered-header {
    text-align: center;
    margin-bottom: 0;
}


</style>


<div class="fields-container">
    <h2 class="centered-header">All Fields
        <a href="AdminCreateFieldPage.php">
            <button>Add New Field</button>
        </a>
    </h2>

    <div class="table-wrapper">
        <?php
        $db = new SQLite3('../fb_managment_system.db');
        $select_query = "SELECT * FROM Field";
        $result = $db->query($select_query);

        echo "<table>";
        echo "<tr> 
            <th>Field ID</th> <th>Field Name</th> <th>Field Owner ID</th> 
            <th>Field Capacity</th> <th>Address Line 1</th> <th>City</th> 
            <th>Country</th> <th>Postcode</th> <th>GLT</th> <th>VAR</th> 
            <th>Viewing Screens</th> <th>Press Box</th> <th>Charge Per Hour</th> 
            <th>Action</th>
        </tr>";

        while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
            echo "<tr>
                <td>{$row['Field_ID']}</td>
                <td>{$row['Field_name']}</td>
                <td>{$row['FieldOwner_ID']}</td>
                <td>{$row['Field_Capacity']}</td>
                <td>{$row['Address_Line1']}</td>
                <td>{$row['City']}</td>
                <td>{$row['Country']}</td>
                <td>{$row['Postcode']}</td>
                <td>{$row['GLT']}</td>
                <td>{$row['VAR']}</td>
                <td>{$row['View_Screens']}</td>
                <td>{$row['Press_Box']}</td>
                <td>{$row['Chg_Hour']}</td>
                <td><a href='deleteField.php?fieldID={$row['Field_ID']}'>Delete</a></td>
            </tr>";
        }

        echo "</table>";
        $db->close();
        ?>
    </div>
</div>
