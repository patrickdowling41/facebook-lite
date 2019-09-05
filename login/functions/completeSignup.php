<?php
session_start();
require('../../db_connect.php');

// if the user select skip, redirect to the home
if (strcmp($_POST['ad'], 'skip-ad') == 0)
{
    header('Location: ../index.php');
} 
// if user selected to input their information, update their user
else
{
    $email = $_SESSION['signupEmail'];
    // if either of them are unset, we don't want to alter the users location
    if (isset($_POST['country']) == true && isset($_POST['city']) == true)
    {
        echo 'test';
        $country = $_POST['country'];
        $city = $_POST['city'];
        // retrieves or creates a new location from the location table
        $locationID = getLocationID($conn, $city, $country);
        updateLocation($conn, $email, $locationID);
    }
    if (isset($_POST['status']))
    {
        updateStatus($conn, $email, $_POST['status']);
    }
    if (isset($_POST['visibility']))
    {
        updateVisibility($conn, $email, $_POST['visibility']);
    }
    if (isset($_POST['screenName']))
    {
        updateScreenName($conn, $email, $_POST['screenName']);
    }

    oci_close($conn);

    // logout is purely to clear the session so they don't keep the arbitrary signupEmail session value
    // will return directly to login page afterwards
    header('Location: logout.php');
}

function getLocationID($conn, $city, $country)
{
    $locationID = null;
    // will need to create a new location if it's not already in the location table, so this checks for existing location
    $checkLocationExistence = 'SELECT locationID
    FROM LOCATION
    WHERE city like :bv_city
    AND country like :bv_country';

    $stid = oci_parse($conn, $checkLocationExistence);

    oci_bind_by_name($stid, ":bv_city", $city);
    oci_bind_by_name($stid, ":bv_country", $country);
    oci_execute($stid);
    
    while (($row = oci_fetch_array($stid, OCI_ASSOC)) != false)
    {
        $locationID = $row['LOCATIONID'];
    }

    // locationID will only be set if there is a row in the previous while loop
    if ((isset($locationID) == false))
    {
        // create new location
        insertLocation($conn, $country, $city);
        $locationID = retrieveLocation($conn, $country, $city);
    }
    // update the user with the new location
    return $locationID;
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
}

function retrieveLocation($conn, $city, $country)
{
    $retrieveLocation = 'SELECT location_seq.currval as ID from dual';
    $stid = oci_parse($conn, $retrieveLocation);
    oci_execute($stid);

    while (($row = oci_fetch_array($stid, OCI_ASSOC)) != false)
    {
        return $row['ID'];
    }
    return null;
}

function updateLocation($conn, $email, $locationID)
{  
    $updateLocation = "UPDATE FACEBOOKUSER
    SET locationID = :bv_locationID
    where email like :bv_email";

    $stid = oci_parse($conn, $updateLocation);

    oci_bind_by_name($stid, ":bv_email", $email);
    oci_bind_by_name($stid, ":bv_locationID", $locationID);
    
    oci_execute($stid);
}

function updateStatus($conn, $email, $status)
{  
    $updateStatus = "UPDATE FACEBOOKUSER
    SET status = :bv_status
    where email like :bv_email";

    $stid = oci_parse($conn, $updateStatus);

    oci_bind_by_name($stid, ":bv_email", $email);
    oci_bind_by_name($stid, ":bv_status", $status);
    
    oci_execute($stid);
}

function updateVisibility($conn, $email, $visbility)
{  
    $updateVisibility = "UPDATE FACEBOOKUSER
    SET visibility = :bv_visibility
    where email like :bv_email";

    $stid = oci_parse($conn, $updateVisibility);

    oci_bind_by_name($stid, ":bv_email", $email);
    oci_bind_by_name($stid, ":bv_visibility", $visbility);
    
    oci_execute($stid);
}

function updateScreenName($conn, $email, $screenName)
{  
    $updateScreenName = "UPDATE FACEBOOKUSER
    SET screenName = :bv_screenName
    where email like :bv_email";

    $stid = oci_parse($conn, $updateScreenName);

    oci_bind_by_name($stid, ":bv_email", $email);
    oci_bind_by_name($stid, ":bv_screenName", $screenName);
    
    oci_execute($stid);
}
?>