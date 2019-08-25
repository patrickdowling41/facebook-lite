<!DOCTYPE html>
<html lang="en">
<head>

<?php require('../db_connect.php'); 
session_start();

if (strcmp($_SESSION['loggedIn'], "yes") !== 0)
{
    header("Location: ../login");
}

?>

</head>

<body>

    <a class="logout-button" href="../login/logout.php">Log Out</a>

</body>
