<?php
// Routes to login page if user is not logged in.
if (strcmp($_SESSION['loggedIn'], "yes") !== 0)
{
    header("Location: ../login");
}
?>