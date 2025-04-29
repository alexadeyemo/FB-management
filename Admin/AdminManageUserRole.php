<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<title>Manage User Roles | Admin</title>
<link rel="stylesheet" href="style.css" />
</head>
  
<style>
#role-container {
    background-color: #001A70; 
    border-radius: 60% / 40%;
    color: white;
    width: 400px;
    padding: 90px 40px;
    text-align: center;
    font-family: Arial, sans-serif; 
    margin: 0;
}

#role-container h2 {
    margin-bottom: 20px;
}

#role-container select,
#role-container input[type="text"] {
    width: 80%;
    padding: 10px;
    margin-bottom: 15px;
    border: none;
    border-radius: 4px;
}

#role-container button {
    padding: 8px 16px;
    border: none;
    border-radius: 4px;
    background-color:#059805;
    color: white;
    cursor: pointer;
}

#role-container button:hover {
    background-color:rgb(59, 210, 59);
}

label{
    color: black;
}

</style>

<body>
    <?php
    include("sidebar2.php");
    $db = new SQLite3('../fb_managment_system.db');
    $results = $db->query("SELECT User_ID, First_name, Last_name FROM Users");
    ?>

    <div id="role-container">
        <h2>Manage User Roles</h2>
        <form action="updateRole.php" method="post">
            <label for="user">User:</label><br>
            <select name="UserID" id="user">
                <?php
                while ($row = $results->fetchArray(SQLITE3_ASSOC)) {
                    echo "<option value='" . $row['User_ID'] . "'>" . $row['User_ID'] . " - " . $row['First_name'] . " " . $row['Last_name'] . "</option>";
                }
                $db->close();
                ?>
                </select><br>

                <label for="newRole">New Role:</label><br>
                <input type="text" name="newRole" id="newRole" placeholder="Enter New Role"><br>

                <button type="submit">Confirm</button>
        </form>
    </div>
</body>
</html>