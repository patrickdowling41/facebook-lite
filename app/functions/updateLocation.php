<?php

require('../../db_connect.php');
session_start();

$email = $_SESSION['email'];
$city = $_POST['location-city'];
$country = $_POST['location-country'];

if (isset($city) && isset($country))
{
    $checkLocationExistence = 'SELECT locationID
    FROM LOCATION
    WHERE city like :bv_city
    AND country like :bv_country';

    $stid = oci_parse($conn, $checkLocationExistence);

    oci_bind_by_name($stid, ":bv_city", $city);
    oci_bind_by_name($stid, ":bv_country", $country);
    oci_execute($stid);

    $locationID=NULL;
    
    while (($row = oci_fetch_array($stid, OCI_ASSOC)) != false)
    {
        $locationID = $row['LOCATIONID'];
    }

    $locationID = insertLocation($conn, $country, $city);
    
    updateUser($conn, $locationID, $email);
}

function insertLocation($conn, $country, $city)
{
    $insertLocation = 'INSERT INTO LOCATION
    (
        city,
        country
    )
    values
    (
        :bv_city,
        :bv_country
    )';

    $stid = oci_parse($conn, $insertLocation);
    oci_bind_by_name($stid, ":bv_city", $city);
    oci_bind_by_name($stid, ":bv_country", $country);
    oci_execute($stid);
    
    $retrieveLocation = 'SELECT locationID
    FROM LOCATION
    WHERE city = :bv_city
    AND country = :bv_country';
    $stid = oci_parse($conn, $retrieveLocation);
    oci_bind_by_name($stid, ":bv_city", $city);
    oci_bind_by_name($stid, ":bv_country", $country);
    oci_execute($stid);

    while (($row = oci_fetch_array($stid, OCI_ASSOC)) != false)
    {
        return $row['LOCATIONID'];
    }

}

function updateUser($conn, $locationID, $email)
{
    echo "test";
    $updateUser = "UPDATE FACEBOOKUSER
    SET locationID = :bv_locationID
    WHERE email like :bv_email";

    $stid = oci_parse($conn, $updateUser);

    oci_bind_by_name($stid, ":bv_email", $email);
    oci_bind_by_name($stid, ":bv_locationID", $locationID);
    
    oci_execute($stid);
}

// header('Location: ../settings.php');
oci_close($conn);
?>