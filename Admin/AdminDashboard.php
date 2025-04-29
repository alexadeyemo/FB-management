<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard | Admin</title>
    <link rel="stylesheet" href="style.css" />
</head>

<style>
.container{
    background-color: rgb(235, 184, 184);
    border-radius: 8px;
    padding: 20px;
    margin-bottom: 20px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    max-width: 500px;
    justify-content: center;
    font-size: 1.5rem;
    text-align: center;
    margin-left: 80px;
    margin-top: 50px;
}

.active_users{
    font-weight: bold;
    margin-bottom: 20px;
}
</style>
<body>
<div class="content">
    <header>
        <h1>Dashboard</h1>
    </header>
    <?php
        include("sidebar2.php");    
    ?>

    <div class="container">
        <div class="active_users">
            <?php
            $db = new SQLite3('../fb_managment_system.db');
            $query = "SELECT COUNT (*) as total_users FROM Users";
            $result = $db->querySingle($query, true);
            
            if ($result) {
                echo "Active Users: " . $result['total_users'];
            } else {
                echo "error";
            }
            $db->close();
            ?>
        </div>

        <div>
            <?php
            $db2 =  new SQLite3('../fb_managment_system.db');
            $query2 = "SELECT COUNT (*) as total_teams FROM Team";
            $result2 = $db2->querySingle($query2, true);

            if ($result2) {
                echo "Total Teams: " . $result2['total_teams'];
            } else {
                echo "error";
            }
            $db2->close();
            ?>
        </div>
    </div>

</div>