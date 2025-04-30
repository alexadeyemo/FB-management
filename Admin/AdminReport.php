<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reports | Admin</title>
    <link rel="stylesheet" href="style.css" />
</head>


<style>
.container {
    display: flex;
    align-items: flex-start;
    justify-content: center;
    gap: 0px;
    margin-top: 10px;

}

.buttons-column {
    display: flex;
    flex-direction: column;
    gap: 15px;
    margin-top: 100px;
}

.buttons-column button {
    padding: 10px 15px;
    font-size: 14px;
    background-color: #4CAF50;
    color: white;
    border: none;
    cursor: pointer;
}

.buttons-column button:hover {
    background-color: #45a049;
}

.table-wrapper {
    max-width: 100%;
    margin: 0;
}

</style>
<body>
    <?php
    include ("sidebar2.php");
    ?>
    <header>
        <h1>Reports</h1>
    </header>


    <?php
    include ("sidebar2.php");
    ?>

    <div class="container">
        <div class="buttons-column">
            <a href="AdminViewStatistics.php">
                <button>View Match Statistics</button>
            </a>
            <a href="AdminCreateStatPage.php">
                <button>Add Match Statistics</button>
            </a>
            <a href="AdminCreateMaintPage.php">
                <button>Add Maintenance Schedule</button>
            </a>
        </div>

        <div class="table-wrapper">
            <?php include("AdminViewMaintenance.php"); ?>
        </div>
    </div>



</body>
</html>

