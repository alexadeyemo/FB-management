<?php
$db = new SQLite3('../fb_managment_system.db');

// *****NEEDS ADAPTING
$query = "SELECT
        SUM(Goals) AS Goals,
        SUM(Yellow_Cards) AS YellowCards,
        SUM(Red_Cards) AS RedCards,
        SUM(Penalties) AS Penalties,
        SUM(Freekicks) AS Freekicks,
        SUM(Corners) AS Corners
        FROM Match_Stats";

$results = $db->querySingle($query, true);

echo json_encode($results);
?>


