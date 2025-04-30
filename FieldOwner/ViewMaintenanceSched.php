<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bookings | Field Owner</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="../styles/style.css">
</head>

<body>
    <?php include 'Sidebar.php'; ?>
    <div class="content">
        <header>
            <h1>Maintenance Schedule</h1>
        </header>
    

        <section class="col">
            <div class="bg-image h-100" style="background-color: #f5f7fa;">
                <div class="mask d-flex align-items-center h-100">
                <div class="container">
                    <div class="row justify-content-center">
                    <div class="col">
                        <div class="card">
                        <div class="card-body p-0">
                            <div class="table-responsive table-scroll field-table" data-mdb-perfect-scrollbar="true" style="position: relative;">

                            <?php
                                session_start();

                                if (!isset($_SESSION['email'])) {
                                    header("Location: ../index.php");
                                    exit();
                                }

                                $email = $_SESSION['email'];

                                $db = new SQLite3('../fb_managment_system.db');

                                $stmt = $db->prepare('
                                    SELECT
                                    Maintenance_Schedule.Field_ID,
                                    Maintenance_Schedule.MSched_ID,
                                    Field.Field_name AS field_name,
                                    Maintenance_Schedule.MSched_Date,
                                    Maintenance_Schedule.MSched_Status,
                                    Maintenance_Schedule.MSched_Desc
                                    FROM Maintenance_Schedule
                                    INNER JOIN Field ON Maintenance_Schedule.Field_ID = Field.Field_ID
                                    INNER JOIN Users ON Field.FieldOwner_ID = Users.User_ID                                  
                                    WHERE Users.Email_Address = :email
                                ');

                                $stmt->bindValue(':email', $email, SQLITE3_TEXT);
                                $result = $stmt->execute();

                                

                                if (!$result) {
                                    echo "Error fetching data.";
                                } else {
                                    
                                    echo "<table class='table table-striped mb-0'>
                                <thead style='background-color: #002d72;'>
                                    <tr>
                                        <th scope='col'>ID</th>
                                        <th scope='col'>Field</th>
                                        <th scope='col'>Date</th>
                                        <th scope='col'>Description</th>
                                        <th scope='col'>Status</th>
                                    </tr>
                                </thead>";

                                    while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
                                        echo "<tr>
                                                <td>" . htmlspecialchars($row['MSched_ID']) . "</td>
                                                <td>" . htmlspecialchars($row['field_name']) . "</td>
                                                <td>" . htmlspecialchars($row['MSched_Date']) . "</td>
                                                <td>" . htmlspecialchars($row['MSched_Desc']) . "</td>
                                                <td>
                                                    <form method='POST' action='UpdateMaintenanceStatus.php' style='display: inline-block;'>
                                                        <input type='hidden' name='msched_id' value='" . htmlspecialchars($row['MSched_ID']) . "'>
                                                        <select name='msched_status' required>
                                                            <option value='Scheduled' " . ($row['MSched_Status'] == 'Scheduled' ? 'selected' : '') . ">Scheduled</option>
                                                            <option value='Ongoing' " . ($row['MSched_Status'] == 'Ongoing' ? 'selected' : '') . ">Ongoing</option>
                                                            <option value='Completed' " . ($row['MSched_Status'] == 'Completed' ? 'selected' : '') . ">Completed</option>
                                                        </select>
                                                        <button type='submit' class='btn btn-sm btn-primary'>Update</button>
                                                    </form>
                                                </td>
                                            </tr>";
                                    }

                                    echo "</table>";
                                }

                                $db->close();
                            ?>


                            </table>
                            </div>
                        </div>
                        </div>
                    </div>
                    </div>
                </div>
                </div>
            </div>
        </section>
    </div>
    <?php include 'Footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>