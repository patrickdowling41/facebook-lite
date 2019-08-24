<?php require('db_connect.php');

session_start();

// Check to ensure birthday is not null
if ((isset($_POST[$birthDay]) == false || isset($_POST[$birthMonth]) == false || isset($_POST[$birthYear]) == false))
{
    header("Location: ../index.php");
}

$firstname = $_POST['firstname'];
$surname = $_POST['surname'];
$email = $_POST['email'];
$passwordHash = hash("sha256", $_POST['password']);
$birthDay = $_POST['day'];
$birthMonth = $_POST['month'];
$birthYear = $_POST['year'];
$gender = $_POST['gender'];

$query = `INSERT into FacebookUser 
(
    email,
    firstName,
    surname,
    screenName,
    dateOfBirth,
    gender,
    visibility,
    passwordHash
)
values
(
    '$email',
    '$firstname',
    '$surname',
    '$firstname.$surname',
    '$dateOfBirth',
    '$gender',
    'private',
    '$passwordHash'
)`;

$stid = oci_parse($conn, $query);
oci_execute($stid);

?>
