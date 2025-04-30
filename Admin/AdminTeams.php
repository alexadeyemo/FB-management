<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teams | Admin</title>
</head>


<style> 
.content {
    margin-left: 250px;
    padding: 20px;
    width: calc(100% - 250px);
    flex: 1;
    padding-bottom: 60px; 
}

.sidebar {
    width: 250px;
    background-color: #153C57;
    color: white;
    position: fixed;
    top: 0;
    left: 0;
    bottom: 0;
    padding-top: 20px;
    padding-left: 10px;
    z-index: 100;
}

button {
    padding: 10px 20px;
    font-size: 16px;
    background-color: #4CAF50;
    color: white;
    border: none;
    cursor: pointer;
    margin-bottom: 20px; 
}

button:hover {
    background-color: #45a049;
}

.tb {
    display: flex;
    justify-content: center;
    margin-left: 0;
    margin-right: 250px;
}
</style>

<body>
<div class="content">
    <header>
        <h1>Teams</h1>
    </header>

    <?php
    include("sidebar2.php");
    ?>

    <div class="tb">
        <?php include("AdminViewTeams.php"); ?>
    </div>
</div>
</body>
</html>
