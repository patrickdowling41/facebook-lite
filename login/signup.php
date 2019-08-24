<?php require('../db_connect.php');

session_start();

$firstname = $_POST['firstname'];
$surname = $_POST['surname'];
$email = $_POST['email'];
$passwordHash = hash("sha256", $_POST['password']);
$birthDay = $_POST['day'];
$birthMonth = $_POST['month'];
$birthYear = $_POST['year'];
$gender = $_POST['gender'];

switch ($birthMonth)
{
    case 1:
        $month='JAN';
        break;

    case 2:
        $month='FEB';
        break;

    case 3:
        $month='MAR';
        break;

    case 4:
        $month='APR';
        break;

    case 5:
        $month='MAY';
        break;

    case 6:
        $month='JUN';
        break;

    case 7:
        $month='JUL';
        break;

    case 8:
        $month='AUG';
        break;

    case 9:
        $month='SEP';
        break;

    case 10:
        $month='OCT';
        break;

    case 11:
        $month='NOV';
        break;

    case 12:
        $month='DEC';
        break;
}

$dateOfBirth=$birthDay.'-'.$month.'-'.$birthYear;

$query = 'INSERT into FacebookUser 
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
    ":bv_email",
    ":bv_firstName",
    ":bv_surname",
    ":bv_screenName",
    ":bv_dateOfBirth",
    ":bv_gender"
    ":bv_visibility"
    ":bv_passwordHash"
)';

$screenName= $firstname.$surname;
$defaultVisibility = "private";

$stid = oci_parse($conn, $query);

echo '<p>'.$email.'</p>';
echo '<p>'.$firstname.'</p>';
echo '<p>'.$surname.'</p>';
echo '<p>'.$screenName.'</p>';
echo '<p>'.$dateOfBirth.'</p>';
echo '<p>'.$gender.'</p>';
echo '<p>'.$defaultVisibility.'</p>';
echo '<p>'.$passwordHash.'</p>';


oci_bind_by_name($stid, ":bv_email", $email);
oci_bind_by_name($stid, ":bv_firstName", $firstname);
oci_bind_by_name($stid, ":bv_surname", $surname);
oci_bind_by_name($stid, ":bv_screenName", $screenName);
oci_bind_by_name($stid, ":bv_dateOfBirth", $dateOfBirth);
oci_bind_by_name($stid, ":bv_gender", $gender);
oci_bind_by_name($stid, ":bv_visibility", $defaultVisibility);
oci_bind_by_name($stid, ":bv_passwordHash", $passwordHash);

oci_execute($stid);

?>
