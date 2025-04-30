<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users | Admin</title>
    <link rel="stylesheet" href="style.css" />
</head>

<style>
.usersadmin-row {
    display: flex;
    justify-content: center; 
    margin-top: 30px;
    margin-left: 0;
    margin-right: 90px;
    gap: 0px;
}

.usersadmin-col {
    display: flex;
    flex-direction: column;
    border-radius: 10px;
}

.col-1 button {
    background-color: rgb(53, 83, 138);
    color: white;
    padding: 30px 50px;
    border-radius: 4px;
    cursor: pointer;
    font-size: 20px;
    margin-top: 10px;
    text-align: center;
    width: 260px;
}

.usersadmin-col button:hover {
    background-color: #4566a0;
}

.usersadmin-col a {
    text-decoration: none;
}
.col-1{
    margin-top: 180px;
}

</style>

<body>
<div class="content">
    <header>
        <h1>Users</h1>
    </header>
    
    <?php
        include("sidebar2.php");    
    ?>
    
    <div class="usersadmin-row">
        <div class="usersadmin-col col-1">
            <a href="AdminCreateUserPage.php">
                <button>Add New User</button>
            </a>

            <a href="AdminViewUsers.php">
                <button>View All Users</button>
            </a>
        </div>

        <div class="usersadmin-col">
            <?php include("AdminManageUserRole.php"); ?>
        </div>
    </div>

    
</div>
</body>
</html>