<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reports | Admin</title>
    <link rel="stylesheet" href="style.css" />
</head>

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

    <div>
        <a href="AdminViewStatistics.php">
            <button>View Match Statistics</button>
        </a>
    </div>

    <div>
        <a href="AdminCreateStatPage.php">
            <button>Add Match Statistics</button>
        </a>
    </div>

    <div>
        <a href="AdminCreateMaintPage.php">
            <button>Add Match Maintenance Schedule</button>
        </a>
    </div>

    <div>
        <?php include ("AdminViewMaintenance.php"); ?>
    </div>
</div>

</body>
</html>

