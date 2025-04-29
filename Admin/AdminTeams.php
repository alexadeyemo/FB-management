<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teams</title>
</head>


<style> 
.content {
    width: 80%;
    margin: 0 auto;
    text-align: center;

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

.content div {
    margin-top: 20px;
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

    <div>
        <?php include("AdminViewTeams.php"); ?>
    </div>
</div>
</body>
</html>
