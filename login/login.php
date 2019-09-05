<?php require('../db_connect.php');
session_start();

// returns if username or password aren't set
if (!(isset($_POST['login-email'])) || !(isset($_POST['login-password'])))
{
    header("Location: index.php");
}

$email = $_POST['login-email'];
$passwordHash = hash("sha256", $_POST['login-password']);

// compares user inputted email to all user emails in database
$findUser = 
'SELECT email, passwordHash
from FACEBOOKUSER 
where LOWER(email) like LOWER(:bv_email)';

$stid = oci_parse($conn, $findUser);
oci_bind_by_name($stid, ":bv_email", $email);
oci_execute($stid);

while (($row = oci_fetch_array($stid, OCI_ASSOC)) != false)
{
    // compares the password hash the user inputted to the password hash in the database
    if (strcmp($row['PASSWORDHASH'], $passwordHash) === 0)
    {
        $_SESSION["email"] = $email;
        $_SESSION["loggedIn"] = "yes";
    }
}

if ($_SESSION["loggedIn"] === "yes")
{
    // redirects to the app once logged in correctly.
    header("Location: ../app/index.php");
}
else
{
    // loads a login form to allow login from a seperate menu to indicate login was previously unsuccessful
    include_once('Location: index.php');
}

oci_close($conn);
