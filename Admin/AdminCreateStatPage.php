<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Match Statistics</title>
    <link rel="stylesheet" href="style.css" />
</head>

<body>
    <?php
    include ("sidebar2.php");
    ?>
    <div> <h2 class="centered_header">Add New Match Statistics</h2></div>

    <div class="main">
        <form action="AdminCreateStatRecord.php" method="post">
            <input type="number" id="match_id" name="match_id" placeholder="Match ID" required>
            <input type="number" id="team_id" name="team_id" placeholder="Team ID" required>
            <input type="number" id="goals" name="goals" placeholder="Goals" required>
            <input type="number" id="yellow_cards" name="yellow_cards" placeholder="Yellow Cards" required>
            <input type="number" id="red_cards" name="red_cards" placeholder="Red Cards" required>
            <input type="number" id="penalties" name="penalties" placeholder="Penalties" required>
            <input type="number" id="freekicks" name="freekicks" placeholder="Free Kicks" required>
            <input type="number" id="corners" name="corners" placeholder="Corners" required>
            <input type="number" id="fouls" name="fouls" placeholder="Fouls" required>

            <button type="submit">Add Statistics</button>
        </form>
    </div>
</body>
</html>