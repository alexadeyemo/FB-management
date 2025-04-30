<?php
session_start();

if (!isset($_SESSION['email'])) {
    header("Location: ../index.php");
    exit();
}

$email = $_SESSION['email'];

$db = new SQLite3('../fb_managment_system.db');

$stmt = $db->prepare('
                    SELECT Field_name, Field_ID
                    FROM Field
                    INNER JOIN Users ON Field.FieldOwner_ID = Users.User_ID
                    WHERE Users.Email_Address = :email
                ');

$stmt->bindValue(':email', $email, SQLITE3_TEXT);
$fields_result = $stmt->execute();
            
if (!$fields_result) {
    echo "<script>
            alert('Error fetching data.');
            window.location.href = 'FieldMaintenance.php';
            </script>";
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Field Maintenance | Field Owner</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; padding: 20px; background-color: #f4f4f4; }
        .container { max-width: 600px; margin: 0 auto; background-color: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); }
        .form-group { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; font-weight: bold; }
        input, select, button { width: 100%; padding: 10px; box-sizing: border-box; font-size: 1em; border-radius: 5px; border: 1px solid #ddd; margin-bottom: 10px; }
        button { background-color: #0056b3; color: white; border: none; cursor: pointer; }
        button:hover { background-color: #0056b3; }
        .form-group input, .form-group select { font-size: 1em; }
        .form-group input[type="date"] { padding: 9px; }
    </style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="../styles/style.css">
</head>

<body>
    <?php include 'Sidebar.php'; ?>
    <div class="content">
        <header>
            <h1>Field Maintenance</h1>
        </header>

        <div class="container">
            <form action="SubmitMaintenance.php" method="POST">
                <label for="field_id">Select Field:</label>
                <select name="field_id" id="field_id" required>
                    <option value="">-- Select Field --</option>
                    <?php
                    while ($row = $fields_result->fetchArray(SQLITE3_ASSOC)) {
                        echo "<option value=\"" . htmlspecialchars($row['Field_ID']) . "\">" . htmlspecialchars($row['Field_name']) . "</option>";
                    }
                    ?>
                </select><br><br>

                <label for="sched_date">Schedule Date:</label>
                <input type="date" id="sched_date" name="sched_date" required><br><br>

                <label for="sched_desc">Schedule Description:</label>
                <textarea id="sched_desc" name="sched_desc" rows="4" cols="40" required></textarea><br><br>

                <button type="submit">Submit</button>
            </form>
        </div>
    </div>
    <?php include 'Footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>