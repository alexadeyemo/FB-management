<?php

include("sidebar2.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $match_id = $_POST['match_id'];
    $team_id = $_POST['team_id'];
    $goals = $_POST['goals'];
    $yellow_cards = $_POST['yellow_cards'];
    $red_cards = $_POST['red_cards'];
    $penalties = $_POST['penalties'];
    $freekicks = $_POST['freekicks'];
    $corners = $_POST['corners'];
    $fouls = $_POST['fouls'];

    $db = new SQLite3('../fb_managment_system.db');

    $db->exec("CREATE TABLE IF NOT EXISTS Match_Stats (
        Match_ID INTEGER PRIMARY KEY NOT NULL,
        Team_ID INTEGER PRIMARY KEY NOT NULL,
        Goals INTEGER NOT NULL,
        Yellow_Cards INTEGER NOT NULL,
        Red_Cards INTEGER NOT NULL,
        Penalties INTEGER NOT NULL,
        FreeKicks INTEGER NOT NULL,
        Corners INTEGER NOT NULL,
        Fouls INTEGER NOT NULL,
        FOREIGN KEY (Team_ID) REFERENCES Team(Team_ID)
        );");

        $stmt = $db->prepare("INSERT INTO Match_Stats (Match_ID, Team_ID, Goals, Yellow_Cards, Red_Cards, Penalties, FreeKicks, Corners, Fouls)
                            VALUES (:match_id, :team_id, :goals, :yellow_cards, :red_cards, :penalties, :freekicks, :corners, :fouls)");
        
        $stmt -> bindValue(':match_id', $match_id, SQLITE3_INTEGER);
        $stmt -> bindValue(':team_id', $team_id, SQLITE3_INTEGER);
        $stmt -> bindValue(':goals', $goals, SQLITE3_INTEGER);
        $stmt -> bindValue(':yellow_cards', $yellow_cards, SQLITE3_INTEGER);
        $stmt -> bindValue(':red_cards', $red_cards, SQLITE3_INTEGER);
        $stmt -> bindValue(':penalties', $penalties, SQLITE3_INTEGER);
        $stmt -> bindValue(':freekicks', $freekicks, SQLITE3_INTEGER);
        $stmt -> bindValue(':corners', $corners, SQLITE3_INTEGER);
        $stmt -> bindValue(':fouls', $fouls, SQLITE3_INTEGER);

        if ($stmt->execute()) {
            echo "Stats Added Successfully";
        } else {
            echo "Failed To Add New Stats";
        }

        $db->close();
}
?>