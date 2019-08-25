<?php require('../db_connect.php');
session_start();

if (!(isset($_POST['login-email'])) || !(isset($_POST['login-password'])))
{
    header("Location: index.php");
}

$email = $_POST['login-email'];
$passwordHash = hash("sha256", $_POST['login-password']);

$findUser = 
'SELECT email, passwordHash
from FACEBOOKUSER 
where LOWER(email) like LOWER(:bv_email)';

$stid = oci_parse($conn, $findUser);
oci_bind_by_name($stid, ":bv_email", $email);
oci_execute($stid);

// There will either be 1 or no rows
while (($row = oci_fetch_array($stid, OCI_ASSOC)) != false)
{
    if (strcmp($row['PASSWORDHASH'], $passwordHash) === 0)
    {
        /* used as an identifier that the user is now logged in when redirected back to the login home
        * user emails are stored as a cookie for 30 days */
        setcookie("userEmail", $email, time() + (86400 * 30), "/");
        $_SESSION["loggedIn"] = "yes";
    }
}

// redirect back to index whether login was successful or not
header("Location: index.php");
